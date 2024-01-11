<?php

use app\Controllers\AdminController;
use app\Controllers\CategoryController;
use app\Controllers\HomeController;
use app\Controllers\TagController;
use app\Controllers\WikiController;
use core\Router;

$router = new Router();

/* Home */
$router->addRoute('/', HomeController::class, 'index');

/********** User routes **********/
// $router->addRoute('/profile');
$router->addRoute('/wikis/show', WikiController::class, 'show');
$router->addRoute('/wikis/create', WikiController::class, 'create');
$router->addRoute('/wikis/store', WikiController::class, 'store');
$router->addRoute('/wikis/edit', WikiController::class, 'edit');
$router->addRoute('/wikis/update', WikiController::class, 'update');
$router->addRoute('/wikis/delete', WikiController::class, 'delete');

/********** Admin routes **********/
$router->addRoute('/dashboard', AdminController::class, 'dashboard');

// Category
$router->addRoute('/dashboard/categories', CategoryController::class, 'index');
$router->addRoute('/dashboard/categories/create', CategoryController::class, 'create');
$router->addRoute('/dashboard/categories/store', CategoryController::class, 'store');
$router->addRoute('/dashboard/categories/edit', CategoryController::class, 'edit');
$router->addRoute('/dashboard/categories/update', CategoryController::class, 'update');
$router->addRoute('/dashboard/categories/delete', CategoryController::class, 'delete');

// Wiki
$router->addRoute('/dashboard/wikis', WikiController::class, 'index');
$router->addRoute('/dashboard/wikis/edit', WikiController::class, 'edit');
$router->addRoute('/dashboard/wikis/update', WikiController::class, 'update');
$router->addRoute('/dashboard/wikis/delete', WikiController::class, 'delete');

// Tag
$router->addRoute('/dashboard/tags', TagController::class, 'index');
$router->addRoute('/dashboard/tags/store', TagController::class, 'store');
$router->addRoute('/dashboard/tags/update', TagController::class, 'update');
$router->addRoute('/dashboard/tags/delete', TagController::class, 'delete');