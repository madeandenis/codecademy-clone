<?php

namespace app\core\routing;

class Router{

    private static $router;
    public $routes = [];

    private function __construct()
    {
    }
    public static function getRouter(): self{
        if(!isset(self::$router)){
            self::$router = new self();
        }
        return self::$router;
    } 

    private function addRoute($uri, $controller, $action, $method){
        $this->routes[$method][$uri] = [
            'controller' => $controller,
            'action' => $action
        ];
    }
    public function get($route, $controller, $action){
        $this->addRoute($route,$controller,$action,"GET");
    }
    public function post($route, $controller, $action){
        $this->addRoute($route,$controller,$action,"POST");
    }
    public function dispatch(){
        $dispatcher = new Dispatcher($this->routes);
        $dispatcher->dispatch($_SERVER['REQUEST_URI'],$_SERVER['REQUEST_METHOD']);
    }
}