<?php

$loader = require __DIR__ . '/../vendor/autoload.php';
$phin = new Phin\Application(realpath(__DIR__.'/../'));
$loader->addPsr4(config('site.namespace', 'Site') . '\\', site_path());

use Illuminate\Http\Request;

$response = $phin->handle(Request::capture());

if ($response) {
	$response->send();
}
