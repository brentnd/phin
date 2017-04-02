<?php

$loader = require __DIR__ . '/../vendor/autoload.php';
$phin = require_once __DIR__ . '/../bootstrap/phin.php';
$loader->addPsr4('Site\\', site_path());

$response = $phin->handle(Illuminate\Http\Request::capture());

if ($response) {
	$response->send();
}
