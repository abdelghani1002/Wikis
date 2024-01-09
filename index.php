<?php

require('core/dotenv.php');
require('core/routes.php');



$uri = $_SERVER['REQUEST_URI'];

$uri = str_replace('/' . $_ENV['APP_NAME'], '', $uri);
$uri = rtrim($uri, '/');
$router->dispatch($uri);