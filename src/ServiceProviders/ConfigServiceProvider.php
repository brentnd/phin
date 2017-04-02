<?php

namespace Phin\ServiceProviders;

use Illuminate\Support\ServiceProvider;
use Illuminate\Config\Repository;

class ConfigServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('config', function ($app) {
            $config = new Repository(require base_path('site/config.php'));
            date_default_timezone_set($config['timezone']);
            return $config;
        });
    }
}
