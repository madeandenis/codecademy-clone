<?php

use App\Core\Routing\Router;

$router = Router::getRouter();

$router->get('/','App\Controllers\HomeController','index');
$router->get('/home','App\Controllers\HomeController','index');