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
$router->get('/admin/search', AdminController::class, 'adminSearch');

// API route
$router->get('/api/getTables', ApiController::class, 'getTables');
$router->get('/api/getTableData', ApiController::class, 'getTableData');
$router->get('/api/search', ApiController::class, 'search');
$router->post('/api/insertDatabase', ApiController::class, 'setData');
$router->post('/api/updateDatabase', ApiController::class, 'setData');
$router->post('/api/deleteFromDatabase', ApiController::class, 'setData');
