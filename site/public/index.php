<?php

$loader = require __DIR__ . '/../vendor/autoload.php';
$phin = new Phin\Application(realpath(__DIR__.'/../'));
$loader->addPsr4(config('site.namespace', 'Site') . '\\', site_path());

use Illuminate\Http\Request;

$request = Request::capture();
$response = $phin->handle($request);

if ($response) {
	$response->send();
}

$phin->terminate($request, $response);
