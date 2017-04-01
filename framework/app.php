<?php

$app = new Phine\Application(realpath(__DIR__.'/../'));

$app['env'] = 'production';

require app_path('routes.php');

return $app;
