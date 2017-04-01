<?php

$app = new Phine\Application(realpath(__DIR__.'/../'));

$app['env'] = 'local';

require site_path('routes.php');

return $app;
