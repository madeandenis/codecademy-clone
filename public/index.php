<?php
// Enables error reporting (production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';
require_once '../config/routes.php';

use app\core\routing\Router;

$router = Router::getRouter();
$router->dispatch();