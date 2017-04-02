<?php

namespace Phin;

use Exception;
use Illuminate\Container\Container;
use Illuminate\Contracts\View\Factory as ViewFactoryContract;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Events\EventServiceProvider;
use Illuminate\Filesystem\FilesystemServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Routing\RoutingServiceProvider;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Route as RouteFacade;
use Illuminate\View\ViewServiceProvider;
use Symfony\Component\Debug\ExceptionHandler;

use Phin\Providers\ConfigServiceProvider;
use Phin\Providers\FakerServiceProvider;
use Phin\Providers\HttpServiceProvider;
use Phin\Providers\ExceptionHandlerServiceProvider;

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
        $directory = $this['config']->get('site.directory', 'site');
        return $this->basePath.DIRECTORY_SEPARATOR.$directory;
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
        $this->instance('path.base', $this->basePath());
        $this->instance('path.public', $this->publicPath());
        $this->instance('path.storage', $this->storagePath());
        $this->instance('path.bootstrap', $this->bootstrapPath());
    }

    protected function loadRoutesFrom($path)
    {
        $router = $this['router'];
        $namespace = $this['config']->get('site.namespace', 'Site');
        $router->group(['namespace' => $namespace], function (Router $router) use ($path) {
            require $path;
        });
    }

    private function registerServiceProviders()
    {
        with(new ConfigServiceProvider($this))->register();
        with(new EventServiceProvider($this))->register();
        with(new RoutingServiceProvider($this))->register();
        with(new FilesystemServiceProvider($this))->register();
        with(new ViewServiceProvider($this))->register();
        with(new FakerServiceProvider($this))->register();
        with(new HttpServiceProvider($this))->register();
        with(new ExceptionHandlerServiceProvider($this))->register();
    }

    private function registerServiceAliases()
    {
        $this->singleton(ViewFactoryContract::class, function ($this) {
            return $this['view'];
        });
        $this->singleton(Dispatcher::class, function ($this) {
            return $this['events'];
        });
    }

    private function registerFacades()
    {
        Facade::setFacadeApplication($this);
        class_alias(RouteFacade::class, 'Route');
    }

    private function setEnv()
    {
        $this['env'] = $this['config']->get('env', 'production');
    }

    public function __construct($basePath = null)
    {
        if ($basePath) {
            $this->setBasePath($basePath);
        }
        Container::setInstance($this);

        $this->registerServiceProviders();
        // Bind path after config is loaded
        $this->instance('path', $this->path());
        $this->registerServiceAliases();
        $this->registerFacades();
        $this->loadRoutesFrom(site_path('routes.php'));
        $this->setEnv();
    }
}