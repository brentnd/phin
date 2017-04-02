<?php

$app = new Phin\Application(realpath(__DIR__.'/../'));

require site_path('routes.php');

return $app;
