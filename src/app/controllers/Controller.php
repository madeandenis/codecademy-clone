<?php

namespace app\controllers;

class Controller{
    protected $viewsPath;

    public function __construct() {
        $this->viewsPath = realpath(__DIR__ . '/../views');
    }

    protected function renderHome($view){
        require $this->viewsPath . "/home/$view.php";
    }
    protected function renderAuth($view){
        require $this->viewsPath . "/auth/$view.php";
    }
}