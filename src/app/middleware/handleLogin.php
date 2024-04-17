<?php

use app\utils\JWTManager;
use app\utils\Session;
use app\core\database\MongoDBManager;
use app\models\User;
use app\repositories\RoleRepository;
use app\repositories\UserRepository;
use app\services\UserService;

Session::start();

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username_or_email']) && isset($_POST['password'])){
    $username_or_email = $_POST['username_or_email'];
    $password = $_POST['password'];

    try{
        $roleCollection = MongoDBManager::getCollection('userdb','roles');
        $userCollection = MongoDBManager::getCollection('userdb','users');
        $roleRepository = new RoleRepository($roleCollection);
        $userRepository = new UserRepository($userCollection);
        $userService = new UserService($userRepository,$roleRepository);

        $authResult = $userService->authenticateUser($username_or_email,$password);

        if($authResult){
            $roleIDs = $roleRepository->extract_roleIDs_from_rolesArray($authResult['roles']);
            $roleNames = $roleRepository->convert_roleIDs_to_roleNames($roleIDs);
            $tokenUser = new User(
                $authResult['username'],
                $authResult['email'],
                '',
                $roleNames
            );
            $jwtManager = new JWTManager();
            $token = $jwtManager->createToken($tokenUser);

            if($jwtManager->validateToken($token)){
                setcookie(name: "jwtToken", value: $token, expires_or_options: time() + $jwtManager->getExpDuration(), httponly: true);
                $_SESSION['success_msg'] = 'Authentication successful';
            }
        }
    }
    catch(Exception $e){
        $_SESSION['error_msg'] = $e->getMessage();
    }
}

header("Location: http://codecademyre.com/login");

exit; 