<?php

namespace app\core\routing;

use app\services\providers\PathService;
use app\controllers\ApiController;

use Exception;

class Dispatcher{
    private $routes;
    private $basePath;

    public function __construct(array $routes){
        $this->routes = $routes;
        $this->basePath = PathService::getBasePath();
    }
     
    public function dispatch($uri, $method){
        $queryString = parse_url($uri, PHP_URL_QUERY);
        $uri = strtok($uri, '?');
        $uri = str_replace($this->basePath,'',$uri);

        if (!isset($this->routes[$method])) {
            http_response_code(500);
            throw new Exception("No routes defined for method: $method");
        }

        if(array_key_exists($uri, $this->routes[$method])){
            $controller = $this->routes[$method][$uri]['controller'];
            $action = $this->routes[$method][$uri]['action'];
            $controller = new $controller();
            if($controller instanceof ApiController){
                parse_str($queryString, $queryParams);
                if($method == 'GET'){
                    $controller->getData($action,$queryParams);
                }
                if($method == 'POST'){
                    $controller->setData($action,$queryParams);
                }
            }
            else{
                $controller->$action();
            }
        } else {
            http_response_code(500);
            throw new Exception("No route found for URI: $uri");
        }

    }
}