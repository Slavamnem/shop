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
    ],
    'mailgun' => [
        'from-email' => 'vzelinskiy@stud.onu.edu.ua',
        'api-key' => env('MAILGUN_API_KEY', '9da1a302b83a027ad4ca7575fc14129c-f696beb4-eae61afe'),
        'domain' => env('MAILGUN_DOMAIN', 'sandboxde06fcca8afb407cbfc34954a3241b2e.mailgun.org')
    ]
];
