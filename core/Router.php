<?php

namespace core;

use app\Controllers\HomeController;

class Router
{
    protected $routes = [];

    public function addRoute($route, $controller, $action, $params = [])
    {
        $this->routes[$route] = ['controller' => $controller, 'action' => $action, 'params' => $params];
    }

    public function dispatch($uri)
    {
        
        if (array_key_exists($uri, $this->routes)) {
            $controller = $this->routes[$uri]['controller'];
            $action = $this->routes[$uri]['action'];
            $controller = new $controller();
            $controller->$action();
        } else {
            $homeController = new HomeController();
            $homeController->notFound();
        }
    }
}
