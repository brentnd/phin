<?php

$loader = require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$loader->addPsr4('Site\\', site_path());

$response = $app->handle(Illuminate\Http\Request::capture());

if ($response) {
	$response->send();
}
