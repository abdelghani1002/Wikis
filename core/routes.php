<?php

use app\Controllers\AdminController;
use app\Controllers\CategoryController;
use app\Controllers\HomeController;
use app\Controllers\TagController;
use core\Router;

$router = new Router();

$router->addRoute('/', HomeController::class, 'index');

/********** Admin routes **********/
// Category
$router->addRoute('/dashboard', AdminController::class, 'dashboard');
$router->addRoute('/dashboard/categories', CategoryController::class, 'index');
$router->addRoute('/dashboard/categories/create', CategoryController::class, 'create');
$router->addRoute('/dashboard/categories/store', CategoryController::class, 'store');
$router->addRoute('/dashboard/categories/edit', CategoryController::class, 'edit');
$router->addRoute('/dashboard/categories/update', CategoryController::class, 'update');
$router->addRoute('/dashboard/categories/delete', CategoryController::class, 'delete');

// Tag
$router->addRoute('/dashboard/tags', TagController::class, 'index');
$router->addRoute('/dashboard/tags/store', TagController::class, 'store');
$router->addRoute('/dashboard/tags/update', TagController::class, 'update');
$router->addRoute('/dashboard/tags/delete', TagController::class, 'delete');