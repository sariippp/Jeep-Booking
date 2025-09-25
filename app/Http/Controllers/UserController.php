<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\MidtransService;
use Midtrans\Snap;
use Midtrans\Config;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactForm;

class UserController extends Controller
{
    protected $midtransService;
    
    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }
    
    //BOOKING
    public function index() 
    {
        return view('booking.form');
    }

    public function getSessions(Request $request)
    {
        $date = $request->input('date');
        $sessions = Session::where('date', $date)
                         ->where('passenger_count', '>', 0)
                         ->orderBy('session_time', 'asc')
                         ->get();

        return response()->json($sessions);
    }

    public function checkSession(Request $request)
    {
        $session = Session::find($request->session_id);
        
        if (!$session) {
            return response()->json([
                'status' => 'error',
                'message' => 'Sesi tidak ditemukan'
            ]);
        }

        if ($session->passenger_count >= $request->count) {
            return response()->json([
                'status' => 'success',
                'remaining' => $session->passenger_count
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Kuota tidak mencukupi'
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'session_id' => 'required|exists:sessions,id',
            'name' => 'required|string',
            'email' => 'required|email',
            'telp' => 'required',
            'city' => 'required',
            'count' => 'required|numeric|min:1'
        ]);

        try {
            DB::beginTransaction();

            $session = Session::find($request->session_id);
            if (!$session || $session->passenger_count < $request->count) {
                throw new \Exception('Kuota sesi tidak mencukupi');
            }

            $pricePerPerson = 45000; 
            $totalPrice = $pricePerPerson * $request->count;

            $expiresAt = Carbon::now()->addMinutes(15);
            
            $reservation = Reservation::create([
                'session_id' => $validated['session_id'],
                'name' => $validated['name'],
                'email' => $validated['email'],
                'telp' => $validated['telp'],
                'city' => $validated['city'],
                'count' => $validated['count'],
                'price' => $totalPrice,
                'payment_status' => 'pending',
                'expires_at' => $expiresAt
            ]);

            $session->passenger_count -= $request->count;
            $session->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'reservation_id' => $reservation->id,
                'total_price' => $totalPrice,
                'session_time' => $session->date . ' ' . $session->session_time,
                'expires_at' => $expiresAt->timestamp * 1000 
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error in store reservation: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function confirmation($id)
    {
        $reservation = Reservation::with('session')->findOrFail($id);
        
        if ($reservation->payment_status === 'pending' && $reservation->payment_order_id) {
            $statusResponse = $this->midtransService->checkTransactionStatus($reservation->payment_order_id);
            
            if ($statusResponse['success']) {
                $transactionStatus = $statusResponse['data']->transaction_status;
                
                if ($transactionStatus === 'settlement' || $transactionStatus === 'capture') {
                    $reservation->payment_status = 'paid';
                    $reservation->payment_date = now();
                    $reservation->save();
                } else if ($transactionStatus === 'expire' || $transactionStatus === 'cancel' || $transactionStatus === 'deny') {
                    $reservation->payment_status = 'failed';
                    $reservation->save();

                    $session = Session::find($reservation->session_id);
                    if ($session) {
                        $session->passenger_count += $reservation->count;
                        $session->save();
                    }
                }
            }
        }
        
        return view('booking.confirmation', compact('reservation'));
    }

    public function payWithQRIS(Request $request)
{
    try {
        // Configure Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Find reservation
        $reservation = Reservation::find($request->reservation_id);
        
        if (!$reservation) {
            return response()->json(['success' => false, 'message' => 'Reservation not found']);
        }

        // Generate unique order ID
        $orderId = 'RES-' . $reservation->id . '-' . time();
        
        // Update reservation with payment_order_id
        $reservation->payment_order_id = $orderId;
        $reservation->save();

        // Prepare transaction details
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $request->amount,
            ],
            'customer_details' => [
                'first_name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ],
            'payment_type' => 'qris',
            'qris' => [
                'acquirer' => 'gopay'
            ]
        ];

        // Get Snap Token
        $snapToken = Snap::getSnapToken($params);

        return response()->json([
            'success' => true,
            'snap_token' => $snapToken,
            'order_id' => $orderId
        ]);

    } catch (\Exception $e) {
        \Log::error('QRIS Payment Error: ' . $e->getMessage());
        
        return response()->json([
            'success' => false,
            'message' => 'Payment processing failed: ' . $e->getMessage()
        ]);
    }
}
    
    public function checkPaymentStatus(Request $request)
    {
        try {
            $orderId = $request->order_id;
            
            if (!$orderId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order ID tidak ditemukan'
                ], 400);
            }
            
            $statusResponse = $this->midtransService->checkTransactionStatus($orderId);
            
            if (!$statusResponse['success']) {
                return response()->json([
                    'success' => false,
                    'message' => $statusResponse['message']
                ], 500);
            }
            
            $transactionStatus = $statusResponse['data']->transaction_status;
            $reservation = Reservation::where('payment_order_id', $orderId)->first();
            
            if ($reservation) {
                if ($transactionStatus === 'settlement' || $transactionStatus === 'capture') {
                    $reservation->payment_status = 'paid';
                    $reservation->payment_date = now();
                    $reservation->save();
                } else if ($transactionStatus === 'expire' || $transactionStatus === 'cancel' || $transactionStatus === 'deny') {
                    $reservation->payment_status = 'failed';
                    $reservation->save();

                    $session = Session::find($reservation->session_id);
                    if ($session) {
                        $session->passenger_count += $reservation->count;
                        $session->save();
                    }
                }
            }
            
            return response()->json([
                'success' => true,
                'status' => $transactionStatus,
                'reservation_id' => $reservation ? $reservation->id : null
            ]);
        } catch (\Exception $e) {
            Log::error('Payment Status Check Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}