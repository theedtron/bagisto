<?php

return [
    'sandbox' => env('MPESA_SANDBOX', true),
    
    'consumer_key' => env('MPESA_CONSUMER_KEY'),
    'consumer_secret' => env('MPESA_CONSUMER_SECRET'),
    
    'shortcode' => env('MPESA_SHORTCODE'),
    'passkey' => env('MPESA_PASSKEY'),
    
    'initiator_username' => env('MPESA_INITIATOR_USERNAME'),
    'initiator_password' => env('MPESA_INITIATOR_PASSWORD'),
    
    'callback_url' => env('MPESA_CALLBACK_URL')
];