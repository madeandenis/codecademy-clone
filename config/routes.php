<?php

use app\core\routing\Router;

$router = Router::getRouter();

$router->get('/','app\controllers\HomeController','index');
$router->get('/home','app\controllers\HomeController','index');

$router->get('/login','app\controllers\AuthController','login');
$router->post('/login','app\controllers\AuthController','submitLogin');

$router->get('/signup','app\controllers\AuthController','signup');
$router->get('/register','app\controllers\AuthController','signup');
$router->post('/signup','app\controllers\AuthController','submitSignup');
$router->post('/register','app\controllers\AuthController','submitSignup');

$router->get('/admin','app\controllers\AdminController','adminPanel');
$router->get('/admin/dashboard','app\controllers\AdminController','adminDashboard');
