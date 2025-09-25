<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Reservation;
use App\Models\Session;
use App\Services\MidtransService;

class MidtransCallbackController extends Controller
{
    protected $midtransService;
    
    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }
    
    /**
     * Handle notification callback from Midtrans
     */
    public function handleCallback(Request $request)
    {
        Log::info('Midtrans callback received: ' . json_encode($request->all()));
        
        try {
            $notification = $request->all();
            $orderId = $notification['order_id'] ?? null;
            $transactionStatus = $notification['transaction_status'] ?? null;
            $fraudStatus = $notification['fraud_status'] ?? null;
            
            if (!$orderId || !$transactionStatus) {
                return response()->json(['status' => 'error', 'message' => 'Invalid parameters']);
            }
            
            // Verify transaction with Midtrans to ensure the request is legitimate
            $statusResponse = $this->midtransService->checkTransactionStatus($orderId);
            
            if (!$statusResponse['success']) {
                return response()->json(['status' => 'error', 'message' => 'Failed to verify transaction']);
            }
            
            // Find reservation by payment_order_id
            $reservation = Reservation::where('payment_order_id', $orderId)->first();
            
            if (!$reservation) {
                return response()->json(['status' => 'error', 'message' => 'Reservation not found']);
            }
            
            // Process based on transaction status
            if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
                if ($reservation->payment_status != 'paid') {
                    $reservation->payment_status = 'paid';
                    $reservation->payment_date = now();
                    $reservation->save();
                    
                    Log::info('Payment completed for Reservation #' . $reservation->id);
                }
            } else if ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
                if ($reservation->payment_status == 'pending') {
                    $reservation->payment_status = 'failed';
                    $reservation->save();
                    
                    // Restore session passenger count if payment failed
                    $session = Session::find($reservation->session_id);
                    if ($session) {
                        $session->passenger_count += $reservation->count;
                        $session->save();
                        
                        Log::info('Session passenger count restored for Session #' . $session->id);
                    }
                    
                    Log::info('Payment failed for Reservation #' . $reservation->id);
                }
            }
            
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::error('Midtrans callback error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}