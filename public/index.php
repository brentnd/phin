<?php

$loader = require __DIR__ . '/../vendor/autoload.php';
$loader->addPsr4('Site\\', realpath(__DIR__ . '/../site') . '/');
$app = require_once __DIR__ . '/../bootstrap/app.php';

$response = $app->handle(Illuminate\Http\Request::capture());

if ($response) {
	$response->send();
}
