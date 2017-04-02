<?php

namespace Phin\Providers;

use Faker\Factory as FakerFactory;
use Illuminate\Support\ServiceProvider;

class FakerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('faker', function () {
            return FakerFactory::create();
        });
    }
}
