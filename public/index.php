<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../framework/app.php';

$response = $app->handle(Illuminate\Http\Request::capture());

if ($response) {
	$response->send();
}
