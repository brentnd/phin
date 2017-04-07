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
        'compiled' => realpath(base_path('resources/compiled')),
    ],
    'analytics' => [
        'trackingId' => env('ANALYTICS_ID'),
    ],
    'providers' => [
        /*
         * Core, required service providers
         */
        Phin\Providers\ExceptionHandlerServiceProvider::class,
        Illuminate\Routing\RoutingServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,
        Illuminate\Events\EventServiceProvider::class,

        /*
         * Extra, optional service providers
         */
    ],
    'aliases' => [
        'Route' => Illuminate\Support\Facades\Route::class,

        /*
         * Extra, optional facade aliases
         */
    ],
];
