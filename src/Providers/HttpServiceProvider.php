<?php

namespace Phin\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class HttpServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('http', function () {
            return new Client();
        });
    }
}