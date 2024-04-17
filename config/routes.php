<?php


use app\controllers\HomeController;
use app\controllers\AuthController;
use app\controllers\AdminController;
use app\controllers\ApiController;

use app\core\routing\Router;

$router = Router::getRouter();

$router->get('/', HomeController::class, 'index');
$router->get('/home', HomeController::class, 'index');

$router->get('/login', AuthController::class, 'login');
$router->post('/login', AuthController::class, 'submitLogin');

$router->get('/signup', AuthController::class, 'signup');
$router->get('/register', AuthController::class, 'signup');
$router->post('/signup', AuthController::class, 'submitSignup');
$router->post('/register', AuthController::class, 'submitSignup');

$router->get('/admin', AdminController::class, 'adminPanel');
$router->get('/admin/crud', AdminController::class, 'adminCrud');

// API route
$router->get('/api/getTables', ApiController::class, 'getTables');