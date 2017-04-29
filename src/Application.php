<?php

namespace Phin;

use Exception;
use Dotenv\Dotenv;
use Illuminate\Config\Repository;
use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Facade;
use Symfony\Component\Debug\ExceptionHandler;

class Application extends Container
{
    protected $basePath;

    public function handle(Request $request)
    {
        $this['request'] = $request;
        try {
            $response = $this['router']->dispatch($request);
        } catch (Exception $e) {
            $response = $this[ExceptionHandler::class]->handle($e);
        }
        return $response;
    }

    public function terminate(Request $request, $response)
    {
        $middlewares = [];
        if ($route = $request->route()) {
            $middlewares = $this['router']->gatherRouteMiddleware($route);
        }
        foreach ($middlewares as $middleware) {
            list($name, $parameters) = $this->parseMiddleware($middleware);
            $instance = $this->make($name);
            if (method_exists($instance, 'terminate')) {
                $instance->terminate($request, $response);
            }
        }
    }

    public function setBasePath($basePath)
    {
        $this->basePath = rtrim($basePath, '\/');
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

    public function publicPath()
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'public';
    }

    protected function bindPathsInContainer()
    {
        $this->instance('path', $this->path());
        $this->instance('path.base', $this->basePath());
        $this->instance('path.public', $this->publicPath());
    }

    protected function loadMiddleware()
    {
        $router = $this['router'];
        $middleware = $this['config']->get('middleware', []);
        $router->middlewareGroup('web', $middleware);
    }

    protected function loadRoutesFrom($path)
    {
        $namespace = $this['config']->get('site.namespace', 'Site');
        $this['router']->group(['namespace' => $namespace, 'middleware' => 'web'], function (Router $router) use ($path) {
            require $path;
        });
    }

    private function loadEnvironment()
    {
        if (file_exists($this->basePath . '/.env')) {
            $dotenv = new Dotenv($this->basePath);
            $dotenv->load();
        }
    }

    protected function parseMiddleware($middleware)
    {
        list($name, $parameters) = array_pad(explode(':', $middleware, 2), 2, []);

        if (is_string($parameters)) {
            $parameters = explode(',', $parameters);
        }

        return [$name, $parameters];
    }

    private function registerConfig()
    {
        $this->singleton('config', function ($app) {
            $config = new Repository(require base_path('config.php'));
            date_default_timezone_set($config['timezone']);
            return $config;
        });
    }

    private function registerServiceProviders()
    {
        $this->singleton(ExceptionHandler::class, function ($app) {
            return new ExceptionHandler($app['config']->get('debug', false));
        });
        $providers = $this['config']->get('providers', []);
        foreach ($providers as $provider) {
            with(new $provider($this))->register();
        }
    }

    private function registerFacades()
    {
        Facade::setFacadeApplication($this);
        $facades = $this['config']->get('aliases', []);
        foreach ($facades as $alias=>$class) {
            class_alias($class, $alias);
        }
    }

    public function registerCoreContainerAliases()
    {
        $aliases = [
            'config'  => ['Illuminate\Config\Repository', 'Illuminate\Contracts\Config\Repository'],
            'events'  => ['Illuminate\Events\Dispatcher', 'Illuminate\Contracts\Events\Dispatcher'],
            'request' => ['Illuminate\Http\Request', 'Symfony\Component\HttpFoundation\Request'],
            'router'  => ['Illuminate\Routing\Router', 'Illuminate\Contracts\Routing\Registrar'],
            'view'    => ['Illuminate\View\Factory', 'Illuminate\Contracts\View\Factory'],
            'session'              => ['Illuminate\Session\SessionManager'],
            'session.store'        => ['Illuminate\Session\Store', 'Symfony\Component\HttpFoundation\Session\SessionInterface'],
        ];

        foreach ($aliases as $key => $aliases) {
            foreach ($aliases as $alias) {
                $this->alias($key, $alias);
            }
        }
    }

    public function __construct($basePath)
    {
        Container::setInstance($this);
        $this->setBasePath($basePath);
        $this->loadEnvironment();
        $this->registerConfig();
        $this->registerServiceProviders();
        $this->registerCoreContainerAliases();
        $this->registerFacades();
        $this->bindPathsInContainer();
        $this->loadMiddleware();
        $this->loadRoutesFrom(site_path('routes.php'));
    }
}