<?php

return [
    'env' => env('SITE_ENV', 'production'),
    'debug' => env('SITE_DEBUG', false),
    'url' => env('SITE_URL', 'http://localhost'),
    'timezone' => 'America/New_York',
    'site' => [
        'name' => env('SITE_NAME'),
    ],
    'app' => [
        // For mailer which references app.name
        'name' => env('SITE_NAME'),
    ],
    'view' => [
        'paths' => [
            realpath(base_path('resources/views')),
        ],
        'compiled' => realpath(base_path('framework/compiled')),
    ],
    'mail' => [
        "driver" => "smtp",
        "host" => "smtp.mailtrap.io",
        "port" => 2525,
        "from" => array(
          "address" => "from@example.com",
          "name" => "Example"
        ),
        "username" => "ebe94f5a45aa18",
        "password" => "cc6dbca23c0608",
        "sendmail" => "/usr/sbin/sendmail -bs",
        "pretend" => false
    ],
    'analytics' => [
        'trackingId' => env('ANALYTICS_ID'),
    ],
    'providers' => [
        /*
         * Core, required service providers
         */
        Illuminate\Routing\RoutingServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,
        Illuminate\Events\EventServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,

        /*
         * Extra, optional service providers
         */
        Illuminate\Mail\MailServiceProvider::class,
    ],
    'aliases' => [
        /*
         * Core aliases
         */
        'Route' => Illuminate\Support\Facades\Route::class,

        /*
         * Extra, optional facade aliases
         */
        'Mail' => Illuminate\Support\Facades\Mail::class,
    ],
    'middleware' => [
        /*
         * Core standard middleware
         */
        Illuminate\Session\Middleware\StartSession::class,

        /*
         * Extra, optional middleware for all routes
         */
    ],
    'session' => [
        'driver' => env('SESSION_DRIVER', 'file'),
        'lifetime' => 120,
        'expire_on_close' => false,
        'encrypt' => false,
        'files' => realpath(base_path('framework/sessions')),
        'lottery' => [2, 100],
        'cookie' => 'laravel_session',
        'path' => '/',
        'domain' => env('SESSION_DOMAIN', null),
        'secure' => false,
        'http_only' => true,
    ],
];
