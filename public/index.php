<?php
use app\core\database\MongoDBManager;
use app\repositories\RoleRepository;
use app\repositories\UserRepository;
use app\services\UserService;
use app\utils\MongoUtils;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';
require '../config/routes.php';

use app\core\routing\Router;

// $router = Router::getRouter();"
// $router->dispatch();

use app\models\User;

$userService = new UserService(
    new UserRepository(MongoDBManager::getCollection("userdb","users")),
    new RoleRepository(MongoDBManager::getCollection("userdb","roles"))
);

print_r($userService->authenticateUser('john_doe','password123'));
