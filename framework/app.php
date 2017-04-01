<?php

$app = new Illuminate\Container\Container;

$thisPath  = str_finish(realpath(__DIR__), '/');
$basePath  = $thisPath . '/../';
$appPath   = $basePath . 'app/';
$viewPath  = $basePath . 'resources/views/';
$cachePath = $thisPath . 'cache/';

$app = new Illuminate\Container\Container;
Illuminate\Support\Facades\Facade::setFacadeApplication($app);

$app['app'] = $app;
$app['env'] = 'production';

with(new Illuminate\Events\EventServiceProvider($app))->register();
with(new Illuminate\Routing\RoutingServiceProvider($app))->register();
with(new Phine\BladeServiceProvider($app, $viewPath, $cachePath))->register();

require $appPath . 'routes.php';

return $app;