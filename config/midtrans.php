<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Midtrans Configuration
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials and configuration for Midtrans
    | payment gateway.
    |
    */

    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'server_key' => env('MIDTRANS_SERVER_KEY'),
    'client_key' => env('MIDTRANS_CLIENT_KEY'),
    'merchant_id' => env('MIDTRANS_MERCHANT_ID', ''),
    'notification_url' => env('MIDTRANS_NOTIFICATION_URL', 'api/midtrans/callback'),
    'finish_redirect_url' => env('MIDTRANS_FINISH_REDIRECT_URL', '/booking/confirmation/'),
    'unfinish_redirect_url' => env('MIDTRANS_UNFINISH_REDIRECT_URL', '/booking/confirmation/'),
    'error_redirect_url' => env('MIDTRANS_ERROR_REDIRECT_URL', '/booking/confirmation/'),
];

