<?php

namespace app\core\routing;

use app\services\providers\PathService;

use Exception;

class Dispatcher{
    protected $routes;

    private $basePath;
    public function __construct(array $routes){
        $this->routes = $routes;
        $this->basePath = PathService::getBasePath();
    }
     
    public function dispatch($uri, $method){
        $uri = str_replace($this->basePath,'',$uri);

        if (!isset($this->routes[$method])) {
            throw new Exception("No routes defined for method: $method");
        }

        if(array_key_exists($uri, $this->routes[$method])){
            $controller = $this->routes[$method][$uri]['controller'];
            $action = $this->routes[$method][$uri]['action'];
            $controller = new $controller();
            $controller->$action();
        } else {
            throw new Exception("No route found for URI: $uri");
        }

    }
}