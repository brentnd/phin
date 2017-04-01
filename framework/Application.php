<?php

namespace Phine;

use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;
use Illuminate\Events\EventServiceProvider;
use Illuminate\Routing\RoutingServiceProvider;
use Illuminate\Filesystem\FilesystemServiceProvider;
use Illuminate\View\ViewServiceProvider;
use Illuminate\Support\Facades\Route as RouteFacade;

class Application extends Container
{
    protected $basePath;

    public function setBasePath($basePath)
    {
        $this->basePath = rtrim($basePath, '\/');

        $this->bindPathsInContainer();

        return $this;
    }

    protected function bindPathsInContainer()
    {
        $this->instance('path.base', $this->basePath());
    }

    public function basePath()
    {
        return $this->basePath;
    }

    public function __construct($basePath = null)
    {
        if ($basePath) {
            $this->setBasePath($basePath);
        }
        Container::setInstance($this);

        $this->registerServiceProviders();
        $this->registerFacades();
    }

    private function registerServiceProviders()
    {
        with(new EventServiceProvider($this))->register();
        with(new RoutingServiceProvider($this))->register();
        with(new FilesystemServiceProvider($this))->register();
        with(new ConfigServiceProvider($this))->register();
        with(new ViewServiceProvider($this))->register();
        with(new FakerServiceProvider($this))->register();
    }

    private function registerFacades()
    {
        Facade::setFacadeApplication($this);
        class_alias(RouteFacade::class, 'Route');
    }
}