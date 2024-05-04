<?php

use app\repositories\UserRepository;
use app\utils\JWTManager;
use app\utils\Session;
use app\core\database\MongoDBManager;

Session::start();

// Get the raw POST data
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

if (isset($input['course_id'])) {
    try {
        $courseId = $input['course_id'];
        if (isset($_COOKIE["jwtToken"])) {
            $jwtManager = new JWTManager();
            $username = $jwtManager->getUsername($_COOKIE["jwtToken"]);

            $userCollection = MongoDBManager::getCollection('userdb', 'users');
            $userRepository = new UserRepository($userCollection);

            $result = $userRepository->addEnrollment($username,$courseId);
            echo json_encode(['response_msg' => $result]);
            
        } else {
            echo json_encode(['login_request' => true]);
        }
        exit;
    } catch (Exception $e) {
        echo json_encode(['response_msg' => "Failed to enroll: ".$e->getMessage()]);
    }
}
