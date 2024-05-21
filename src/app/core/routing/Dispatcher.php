<?php

namespace app\core\routing;

use app\controllers\PageErrorController;
use app\services\providers\PathService;

class Dispatcher
{
    private $routes;
    private $basePath;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
        $this->basePath = PathService::getBasePath();
    }

    public function dispatch($uri, $method)
    {
        // Removes basePath which consists of scheme and host
        $uri = str_replace($this->basePath, '', $uri);
        // Removes the query string
        $uri = strtok($uri, '?');

        // If the method is not defined, return a 500 error
        if (!isset($this->routes[$method])) {
            http_response_code(500);
            exit;
        }

        // Checks if there is a route defined for the uri
        if (array_key_exists($uri, $this->routes[$method])) {
            // Retrieves route information associated with the uri
            $route = $this->routes[$method][$uri];
            // Extracts controller class and method name and dynamically action it 
            $controller = $route['controller'];
            $action = $route['action'];
            $controller = new $controller();
            $controller->$action();
            return;
        }

        // Iterates over each route defined for the specified HTTP method 
        foreach ($this->routes[$method] as $route => $handler) {
            // Checks if the requested URI matches the current route pattern
            if (preg_match('#^' . $route . '$#', $uri, $matches)) {
                $controller = $handler['controller'];
                $action = $handler['action'];
                $controller = new $controller();
                $controller->$action($matches[1]);
                return;
            }
        }

        // If there is no route found, display 404 error view page
        http_response_code(404);
        $errorsController = new PageErrorController();
        $errorsController->error('404');
    }

}

