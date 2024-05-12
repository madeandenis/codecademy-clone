<?php

use app\core\database\mongo\MongoDBManager;
use app\models\User;
use app\repositories\RoleRepository;
use app\repositories\UserRepository;
use app\services\UserService;
use app\utils\Session;

Session::start();

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])){
    // Extract username, email and password from POST data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    try{
        // Get MongoDB necessary tools
        $roleCollection = MongoDBManager::getCollection('userdb','roles');
        $userCollection = MongoDBManager::getCollection('userdb','users');
        $roleRepository = new RoleRepository($roleCollection);
        $userRepository = new UserRepository($userCollection);
        $userService = new UserService($userRepository,$roleRepository);

        $user = new User(
            $username,
            $email,
            $password,
            // Each new user has an user role by default
            ['ROLE_USER']
        );
        // Register user
        $userService->registerUser($user);

        $_SESSION['success_msg'] = 'Registration successful';
    }
    catch(Exception $e){
        $_SESSION['error_msg'] = $e->getMessage();
    }
}

header("Location: http://codecademyre.com/register");

exit; 