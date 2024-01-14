<?php

require('core/dotenv.php');
require('core/routes.php');



$uri = $_SERVER['REQUEST_URI'];

// Find the position of the last occurrence of '?'
$lastQuestionMark = strrpos($uri, '?');

// If '?' is found, extract the substring up to that position; otherwise, use the entire URI
$uri = ($lastQuestionMark !== false) ? substr($uri, 0, $lastQuestionMark) : $uri;

$uri = str_replace('/' . $_ENV['APP_NAME'], '', $uri);
$uri[strlen($uri) - 1] === '/' && $uri !== "/" ? $uri = rtrim($uri, '/') : null;
$router->dispatch($uri);