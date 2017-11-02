<?php
return [
    'account' => [
        'client_id' => env('PAYPAL_CLIENT_ID', ''),
        'client_secret' => env('PAYPAL_CLIENT_SECRET', ''),
    ],
    'http' => [
        'timeout' => 30,
        'retry' => 1,
    ],
    'log' => [
        'enabled' =>  true,
        'filename' =>  storage_path('logs/paypal.log'),
        'level' => 'FINE',
    ],
    'mode' => 'sandbox', // Change to 'live' when going production
];

?>
