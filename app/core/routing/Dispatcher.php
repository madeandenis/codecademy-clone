<?php

namespace App\Core\Routing;

use App\Services\Providers;
use App\Services\Providers\PathService;

use Exception;

class Dispatcher{
    protected $routes;

    private $basePath = PathService::$basePath;
    public function __construct(array $routes){
        $this->routes = $routes;
    }
     
    public function dispatch($uri, $method){
        $uri = str_replace($this->basePath,'',$uri);

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