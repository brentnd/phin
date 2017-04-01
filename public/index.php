<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../framework/app.php';

$request = Illuminate\Http\Request::capture();
$app['request'] = $request;
$response = router()->dispatch($request);

$response->send();