<?php

namespace Phine;

use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;
use Illuminate\Events\EventServiceProvider;
use Illuminate\Routing\RoutingServiceProvider;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Filesystem\FilesystemServiceProvider;
use Illuminate\View\ViewServiceProvider;
use Illuminate\Translation\TranslationServiceProvider;
use Phine\ServiceProviders\ConfigServiceProvider;
use Phine\ServiceProviders\FakerServiceProvider;
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

    public function basePath()
    {
        return $this->basePath;
    }

    public function path()
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'site';
    }

    public function langPath()
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'lang';
    }

    public function storagePath()
    {
        return $this->frameworkPath().DIRECTORY_SEPARATOR.'cache';
    }

    public function frameworkPath()
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'framework';
    }

    public function publicPath()
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'public';
    }

    protected function bindPathsInContainer()
    {
        $this->instance('path', $this->path());
        $this->instance('path.base', $this->basePath());
        $this->instance('path.lang', $this->langPath());
        $this->instance('path.public', $this->publicPath());
        $this->instance('path.storage', $this->storagePath());
        $this->instance('path.framework', $this->frameworkPath());
    }

    private function registerServiceProviders()
    {
        with(new EventServiceProvider($this))->register();
        with(new RoutingServiceProvider($this))->register();
        with(new FilesystemServiceProvider($this))->register();
        with(new ConfigServiceProvider($this))->register();
        with(new TranslationServiceProvider($this))->register();
        with(new ViewServiceProvider($this))->register();
        with(new FakerServiceProvider($this))->register();
    }

    private function registerFacades()
    {
        Facade::setFacadeApplication($this);
        class_alias(RouteFacade::class, 'Route');
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
}