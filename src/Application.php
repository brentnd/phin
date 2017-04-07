<?php

namespace Phin;

use Exception;
use Dotenv\Dotenv;
use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Facade;
use Phin\Providers\ConfigServiceProvider;
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

    public function publicPath()
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'public';
    }

    protected function bindPathsInContainer()
    {
        $this->instance('path.base', $this->basePath());
        $this->instance('path.public', $this->publicPath());
    }

    protected function loadRoutesFrom($path)
    {
        $router = $this['router'];
        $namespace = $this['config']->get('site.namespace', 'Site');
        $router->group(['namespace' => $namespace], function (Router $router) use ($path) {
            require $path;
        });
    }

    private function loadEnvironment()
    {
        if (file_exists($this->basePath() . '/.env')) {
            $dotenv = new Dotenv($this->basePath());
            $dotenv->load();
        }
    }

    private function registerServiceProviders()
    {
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

        $this->loadEnvironment();
        with(new ConfigServiceProvider($this))->register();
        $this->registerServiceProviders();
        $this->registerFacades();
        // Bind path after config is loaded
        $this->instance('path', $this->path());
        $this->loadRoutesFrom(site_path('routes.php'));
        $this->setEnv();
    }
}