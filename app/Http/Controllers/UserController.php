<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\MidtransService;
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

            // Check session availability
            $session = Session::find($request->session_id);
            if (!$session || $session->passenger_count < $request->count) {
                throw new \Exception('Kuota sesi tidak mencukupi');
            }

            // Calculate price (assuming price per person is stored somewhere)
            $pricePerPerson = 45000; // Set your price here
            $totalPrice = $pricePerPerson * $request->count;

            // Create reservation with 15 minutes expiry
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

            // Update session passenger count
            $session->passenger_count -= $request->count;
            $session->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'reservation_id' => $reservation->id,
                'total_price' => $totalPrice,
                'session_time' => $session->date . ' ' . $session->session_time,
                'expires_at' => $expiresAt->timestamp * 1000 // Convert to milliseconds for JS
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
        
        // Check payment status if it's still pending
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
                    
                    // Restore session passenger count if payment failed
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
            // Check if reservation exists
            $reservation = Reservation::find($request->reservation_id);
            if (!$reservation) {
                return response()->json([
                    'success' => false,
                    'message' => 'Reservasi tidak ditemukan'
                ], 404);
            }
            
            // If payment is expired, return error
            if ($reservation->expires_at && now()->gt($reservation->expires_at)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Waktu pembayaran telah habis',
                    'expired' => true
                ], 400);
            }
            
            $orderId = 'ORDER-' . $reservation->id . '-' . time();
            
            $params = [
                'order_id' => $orderId,
                'amount' => (int) $request->amount,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone
            ];
            
            $response = $this->midtransService->createQrisTransaction($params);
            
            if ($response['success']) {
                // Update reservation with order ID
                $reservation->payment_order_id = $orderId;
                $reservation->save();
                
                // Get QRIS image URL from the actions array
                $qrisImageUrl = null;
                if (isset($response['data']->actions)) {
                    foreach ($response['data']->actions as $action) {
                        if ($action->name === 'generate-qr-code' || $action->name === 'qr-code') {
                            $qrisImageUrl = $action->url;
                            break;
                        }
                    }
                }
                
                if (!$qrisImageUrl) {
                    Log::error('QRIS URL not found in response: ' . json_encode($response));
                    return response()->json([
                        'success' => false,
                        'message' => 'QRIS URL tidak ditemukan dalam respons'
                    ], 500);
                }
                
                return response()->json([
                    'success' => true,
                    'qris_url' => $qrisImageUrl,
                    'expiry_time' => $reservation->expires_at->timestamp * 1000, // Convert to milliseconds for JS
                    'order_id' => $orderId
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $response['message']
                ], 500);
            }
        } catch (\Exception $e) {
            Log::error('QRIS Payment Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
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
                // Update reservation status based on transaction status
                if ($transactionStatus === 'settlement' || $transactionStatus === 'capture') {
                    $reservation->payment_status = 'paid';
                    $reservation->payment_date = now();
                    $reservation->save();
                } else if ($transactionStatus === 'expire' || $transactionStatus === 'cancel' || $transactionStatus === 'deny') {
                    $reservation->payment_status = 'failed';
                    $reservation->save();
                    
                    // Restore session passenger count if payment failed
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