<?php

return [
    'name' => 'Foundation',
    'frontend' => [
        'url' => env('FRONTEND_URL', 'http://localhost:8080'),
        'email_verify_url' => env('EMAIL_VERIFY_URL', '/verify-email')
    ]
];
