<?php

namespace Phine;

use Philo\Blade\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    protected $viewDir;
    protected $cacheDir;
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $viewDir = $this->viewDir;
        $cacheDir = $this->cacheDir;
        $this->app->singleton('Philo\Blade\Blade', function ($app) use ($viewDir, $cacheDir)
        {
            return new Blade($viewDir, $cacheDir);
        });
    }

    public function __construct($app, $viewDir, $cacheDir)
    {
        $this->viewDir = $viewDir;
        $this->cacheDir = $cacheDir;
        parent::__construct($app);
    }
}
