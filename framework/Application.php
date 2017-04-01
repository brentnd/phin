<?php

namespace Phine;

use Exception;
use Illuminate\Http\Request;
use Symfony\Component\Debug\ExceptionHandler;
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
use Phine\ServiceProviders\ExceptionHandlerServiceProvider;
use Illuminate\Support\Facades\Route as RouteFacade;

class Application extends Container
{
    protected $basePath;

    public function handle(Request $request)
    {
        $this['request'] = $request;
        try {
            $response = RouteFacade::dispatch($request);
        } catch (Exception $e) {
            $response = $this[ExceptionHandler::class]->handle($e);
        }
        return $response;
    }

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
        return $this->bootstrapPath().DIRECTORY_SEPARATOR.'cache';
    }

    public function bootstrapPath()
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'bootstrap';
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
        $this->instance('path.bootstrap', $this->bootstrapPath());
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
        with(new ExceptionHandlerServiceProvider($this))->register();
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