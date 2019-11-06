<?php

return [
    'nova-poshta' => [
        'api-url' => env('NOVA_POSHTA_URL'),
        'api-key' => env('NOVA_POSHTA_API_KEY')
    ],
    'justin' => [
        'api-url'      => env('JUSTIN_URL'),
        'api-login'    => env('JUSTIN_LOGIN'),
        'api-password' => env('JUSTIN_PASSWORD')
    ],
    'exchange-url' => 'https://api.exchangerate-api.com/v4/latest/',
    'new-york-times' => [
        'base-url' => 'https://api.nytimes.com/',
        'api-key' => 'sk1sKccGKG1TIZBrae2fkZDHO63b2rlT'
    ],
    'dropbox' => [
        'app-key' => env('DROPBOX_APP_KEY'),
        'app-secret' => env('DROPBOX_APP_SECRET'),
        'access-token' => env('DROPBOX_ACCESS_TOKEN'),
    ]
];
