<?php

use app\Controllers\AdminController;
use app\Controllers\HomeController;
use core\Router;

$router = new Router();

$router->addRoute('/', HomeController::class, 'index');

/* Admin routes */
$router->addRoute('/dashboard', AdminController::class, 'dashboard');
