<?php

$app = new Phin\Application(realpath(__DIR__.'/../'));

$app['env'] = 'local';

require site_path('routes.php');

return $app;
