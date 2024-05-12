<?php

use app\repositories\UserRepository;
use app\utils\JWTManager;
use app\utils\Session;
use app\core\database\mongo\MongoDBManager;

Session::start();

// Json body format
$requestBody = file_get_contents('php://input');
$requestData = json_decode($requestBody, true);

function handleCourseEnrollment($requestData)
{
    if (isset($requestData['course_id'])) {
        try {
            $courseId = $requestData['course_id'];
            if (isset($_COOKIE["jwtToken"])) {
                $jwtManager = new JWTManager();
                $username = $jwtManager->getUsername($_COOKIE["jwtToken"]);

                $userCollection = MongoDBManager::getCollection('userdb', 'users');
                $userRepository = new UserRepository($userCollection);

                $enrollmentResult = $userRepository->addEnrollment($username, $courseId);
                echo json_encode(['response_msg' => $enrollmentResult]);
            } else {
                echo json_encode(['login_request' => true]);
            }
            exit;
        } catch (Exception $e) {
            echo json_encode(['response_msg' => "Failed to enroll: " . $e->getMessage()]);
        }
    }
}

handleCourseEnrollment($requestData);
