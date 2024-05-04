<?php

namespace app\core\routing;

use app\controllers\ErrorsController;
use app\services\providers\PathService;

use Exception;

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
        $uri = strtok($uri, '?');
        $uri = str_replace($this->basePath, '', $uri);

        if (!isset($this->routes[$method])) {
            http_response_code(500);
            throw new Exception("No routes defined for method: $method");
        }

        if (array_key_exists($uri, $this->routes[$method])) {
            $route = $this->routes[$method][$uri];
            $controller = $route['controller'];
            $action = $route['action'];
            $controller = new $controller();
            $controller->$action();
            return;
        }

        foreach ($this->routes[$method] as $route => $handler) {
            if (preg_match('#^' . $route . '$#', $uri, $matches)) {
                $controller = $handler['controller'];
                $action = $handler['action'];
                $controller = new $controller();
                $controller->$action($matches[1]);
                return;
            }
        }

        http_response_code(404);
        $errorsController = new ErrorsController();
        $errorsController->error_404();
    }

}

