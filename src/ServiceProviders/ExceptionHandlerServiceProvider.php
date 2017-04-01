<?php

namespace Phin\ServiceProviders;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Debug\ExceptionHandler;

class ExceptionHandlerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ExceptionHandler::class, function ($app) {
            return new ExceptionHandler($app['env'] != "production");
        });
    }
}
