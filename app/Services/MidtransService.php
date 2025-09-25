<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;

class MidtransService
{
    public function __construct()
    {
        // Set your Midtrans server key
        Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment
        Config::$isProduction = config('midtrans.is_production');
        // Set sanitization on (default)
        Config::$isSanitized = config('midtrans.is_sanitized');
        // Set 3DS transaction for credit card to true
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function createQrisTransaction($params)
    {
        try {
            $transaction_details = [
                'order_id' => $params['order_id'],
                'gross_amount' => $params['amount'],
            ];

            $customer_details = [
                'first_name' => $params['name'],
                'email' => $params['email'],
                'phone' => $params['phone'],
            ];

            $transaction_data = [
                'transaction_details' => $transaction_details,
                'customer_details' => $customer_details,
                'payment_type' => 'qris',
                'qris' => [
                    'acquirer' => 'gopay'
                ]
            ];

            Log::info('Midtrans Transaction Data:', $transaction_data);

            // Create transaction with QRIS payment method
            $snapToken = Snap::createTransaction($transaction_data);

            return [
                'success' => true,
                'data' => $snapToken,
                'message' => 'QRIS transaction created successfully'
            ];
        } catch (\Exception $e) {
            Log::error('Midtrans Error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
    

    public function checkTransactionStatus($orderId)
{
    try {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production', false);
        
        $status = Transaction::status($orderId);
        
        return [
            'success' => true,
            'data' => $status
        ];
    } catch (\Exception $e) {
        return [
            'success' => false,
            'message' => $e->getMessage()
        ];
    }
}
}