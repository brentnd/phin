<?php

return [
    'env' => 'production',
    'debug' => true,
    'url' => 'http://localhost',
    'timezone' => 'America/New_York',
    'site' => [
        'name' => 'Phin',
    ],
    'view' => [
        'paths' => [
            realpath(base_path('resources/views')),
        ],
        'compiled' => realpath(base_path('resources/compiled')),
    ],
    'analytics' => [
        // Add Google Analytics Tracking ID here to enable (only on production)
        'trackingId' => '',
    ],
];
