<?php

use app\repositories\UserRepository;
use app\utils\JWTManager;
use app\utils\Session;
use app\core\database\mongo\MongoDBManager;

Session::start();

// Json body format
$requestBody = file_get_contents('php://input');
$requestData = json_decode($requestBody, true);

function handleCourseEnrollment($requestData) {
    if (!isset($requestData['course_id'])) {
        echo json_encode(['error' => 'Course ID is missing']);
        return;
    }

    try {
        $courseId = $requestData['course_id'];
        
        if (!isset($_COOKIE["jwtToken"])) {
            echo json_encode(['error' => 'Authentication required']);
            return;
        }

        $jwtManager = new JWTManager();
        $username = $jwtManager->getUsername($_COOKIE["jwtToken"]);

        $userCollection = MongoDBManager::getCollection('userdb', 'users');
        $userRepository = new UserRepository($userCollection);

        $enrollmentResult = $userRepository->addEnrollment($username, $courseId);
        echo json_encode(['response_msg' => $enrollmentResult]);
    } catch (Exception $e) {
        echo json_encode(['error' => 'Failed to enroll: ' . $e->getMessage()]);
    }
}


handleCourseEnrollment($requestData);
