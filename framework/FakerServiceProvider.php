<?php

namespace Phine;

use Faker\Factory as FakerFactory;
use Illuminate\Support\ServiceProvider;

class FakerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('faker', function ($app) {
            return FakerFactory::create();
        });
    }
}
