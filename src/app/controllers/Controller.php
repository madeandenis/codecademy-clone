<?php

namespace app\controllers;

use app\utils\JWTManager;

class Controller
{
    protected $viewsPath;
    protected $middlewarePath;
    protected $apiPath;


    public function __construct()
    {
        $this->viewsPath = realpath(__DIR__ . '/../views');
        $this->middlewarePath = realpath(__DIR__ . '/../middleware');
        $this->apiPath = realpath(__DIR__ . '/../api');
    }

    protected function redirectToLogin()
    {
        header("Location: https://codecademyre.com/login");
        exit;
    }

    protected function renderHome($view)
    {
        require $this->viewsPath . "/home/$view.php";
    }
    protected function renderPricing($view)
    {
        require $this->viewsPath . "/pricing/$view.php";
    }
    protected function renderCatalog($view)
    {
        require $this->viewsPath . "/catalog/$view.php";
    }
    protected function renderUpload($view)
    {
        if (!isset($_COOKIE["jwtToken"])) {
            $this->redirectToLogin();
        }
        require $this->viewsPath . "/upload/$view.php";
    }
    protected function renderAuth($view)
    {
        require $this->viewsPath . "/auth/$view.php";
    }
    protected function renderError($statusCode)
    {
        require $this->viewsPath . "/errors/$statusCode.php";
    }

    protected function renderAdmin($view)
    {
        $jwtManager = new JWTManager();

        if (!isset($_COOKIE["jwtToken"])) {
            $this->redirectToLogin();
        }

        if (!$jwtManager->hasAdminRole($_COOKIE["jwtToken"])) {
            $this->renderError('403');
        }

        require $this->viewsPath . "/admin/$view.php";
    }

    protected function handleLogin()
    {
        require $this->middlewarePath . "/handleLogin.php";
    }

    protected function handleLogOut()
    {
        require $this->middlewarePath . "/handleLogOut.php";
    }

    protected function handleRegister()
    {
        require $this->middlewarePath . "/handleRegister.php";
    }
    protected function handleEnrollment()
    {
        require $this->middlewarePath . "/handleEnrollment.php";
    }
    protected function handleUpload()
    {
        if (!isset($_COOKIE["jwtToken"])) {
            $this->redirectToLogin();
        }
        require $this->middlewarePath . "/handleUpload.php";
    }
}