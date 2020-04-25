<?php

return [
    'login' => env('P2P_LOGIN'),

    'secretKey' => env('P2P_SECRET_KEY'),

    'url' => env('P2P_URL'),

    'locale' => env('P2P_LOCALE', 'es_CO'),

    'currency' => env('P2P_CURRENCY', 'USD'),

    'allowPartial' => env('P2P_ALLOW_PARTIAL', false),

    'expiration' => env('P2P_EXPIRATION', '+2 days'),

    'ipAddress' => env('P2P_IP_ADDRESS', '127.0.0.1'),

    'userAgent' => env('P2P_USER_AGENT', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Safari/537.36'),

    'returnUrl' => env('P2P_RETURN_URL', 'http://127.0.0.1:8000/invoices/return'),

    'cancelUrl' => env('P2P_CANCEL_URL', 'http://127.0.0.1:8000/invoices/')
];
