<?php

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../vendor/illuminate/support/helpers.php';

$basePath = str_finish(realpath(__DIR__.'/../app/'), '/');
$controllersDirectory = $basePath . 'Controllers';

Illuminate\Support\ClassLoader::register();
Illuminate\Support\ClassLoader::addDirectories(array($controllersDirectory));

$app = new Illuminate\Container\Container;
Illuminate\Support\Facades\Facade::setFacadeApplication($app);

$app['app'] = $app;
$app['env'] = 'production';

with(new Illuminate\Events\EventServiceProvider($app))->register();
with(new Illuminate\Routing\RoutingServiceProvider($app))->register();

require $basePath . 'routes.php';

$request = Illuminate\Http\Request::createFromGlobals();
$response = $app['router']->dispatch($request);

$response->send();