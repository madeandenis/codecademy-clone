<?php

use App\Core\Routing\Router;

require '../vendor/autoload.php';
require '../config/routes.php';

$router = Router::getRouter();
$router->dispatch();