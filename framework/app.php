<?php

$app = new Phine\Application(realpath(__DIR__.'/../'));

$app['env'] = 'production';

require site_path('routes.php');

return $app;
