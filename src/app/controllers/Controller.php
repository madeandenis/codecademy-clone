<?php

namespace app\controllers;

class Controller{
    protected $viewsPath;
    protected $middlewarePath;

    public function __construct() {
        $this->viewsPath = realpath(__DIR__ . '/../views');
        $this->middlewarePath = realpath(__DIR__ . '/../middleware');
    }

    protected function renderHome($view){
        require $this->viewsPath . "/home/$view.php";
    }
    protected function renderAuth($view){
        require $this->viewsPath . "/auth/$view.php";
    }
    protected function renderAdmin($view){
        require $this->viewsPath . "/admin/$view.php";
    }

    protected function handleLogin(){
        require $this->middlewarePath . "/handleLogin.php";
    }
    protected function handleRegister(){
        require $this->middlewarePath . "/handleRegister.php";
    }
}