<?php

return [
    'env' => env('SITE_ENV', 'production'),
    'debug' => env('SITE_DEBUG', false),
    'url' => env('SITE_URL', 'http://localhost'),
    'timezone' => 'America/New_York',
    'site' => [
        'name' => env('SITE_NAME'),
    ],
    'view' => [
        'paths' => [
            realpath(base_path('resources/views')),
        ],
        'compiled' => realpath(base_path('framework/compiled')),
    ],
    'analytics' => [
        'trackingId' => env('ANALYTICS_ID'),
    ],
];
