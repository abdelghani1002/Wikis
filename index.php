<?php

require('core/dotenv.php');
require('core/routes.php');



$uri = $_SERVER['REQUEST_URI'];

$uri = str_replace('/' . $_ENV['APP_NAME'], '', $uri);
$uri[strlen($uri) - 1] === '/' && $uri !== "/" ? $uri = rtrim($uri, '/') : null;
$router->dispatch($uri);