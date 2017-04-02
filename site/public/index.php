<?php

$loader = require __DIR__ . '/../vendor/autoload.php';
$phin = require_once __DIR__ . '/../bootstrap/phin.php';
$loader->addPsr4(config('site.namespace', 'Site') . '\\', site_path());

use Illuminate\Http\Request;

$response = $phin->handle(Request::capture());

if ($response) {
	$response->send();
}
