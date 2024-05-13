<?php

use app\utils\JWTManager;
use app\utils\Session;
use app\core\database\mongo\MongoDBManager;
use app\models\User;
use app\repositories\RoleRepository;
use app\repositories\UserRepository;
use app\services\UserService;

Session::start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username_or_email']) && isset($_POST['password'])) {
    // Extract username or email and password from POST data
    $username_or_email = $_POST['username_or_email'];
    $password = $_POST['password'];

    try {
        // Get MongoDB necessary tools
        $roleCollection = MongoDBManager::getCollection('userdb', 'roles');
        $userCollection = MongoDBManager::getCollection('userdb', 'users');
        $roleRepository = new RoleRepository($roleCollection);
        $userRepository = new UserRepository($userCollection);
        $userService = new UserService($userRepository, $roleRepository);

        // Authenticate user
        $authResult = $userService->authenticateUser($username_or_email, $password);

        // If authentication successful, generate JWT token
        if ($authResult) {
            // Retrieve role IDs assigned to the user roles
            $roleIDs = $roleRepository->extract_roleIDs_from_rolesArray($authResult['roles']);
            // Convert role IDs to names (like ROLE_USER ) for storing in the token
            $roleNames = $roleRepository->convert_roleIDs_to_roleNames($roleIDs);
            $tokenUser = new User(
                $authResult['username'],
                $authResult['email'],
                // Password isn't included in the token
                '',
                $roleNames
            );
            $jwtManager = new JWTManager();
            $token = $jwtManager->createToken($tokenUser);

            // Validates and sets token in a HTTP only cookie
            if ($jwtManager->validateToken($token)) {
                setcookie(name: "jwtToken", value: $token, expires_or_options: time() + $jwtManager->getExpDuration(), httponly: true);
                $_SESSION['success_msg'] = 'Authentication successful';
            }
        }
    } catch (Exception $e) {
        $_SESSION['error_msg'] = $e->getMessage();
    }
}

header("Location: https://codecademyre.com/login");

exit;