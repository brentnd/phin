<?php

return [
    'env' => 'production',
    'debug' => false,
    'url' => 'http://localhost',
    'timezone' => 'America/New_York',
    'site' => [
        'name' => 'Phin',
    ],
    'view' => [
        'paths' => [
            realpath(base_path('resources/views')),
        ],
        'compiled' => realpath(storage_path()),
    ],
];
