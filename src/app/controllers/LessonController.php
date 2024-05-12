<?php

namespace app\controllers;

use app\core\database\mysql\MySqlManager;
use app\core\database\mongo\MongoDBManager;
use app\utils\LessonUtil;
use app\utils\JWTManager;
use app\repositories\UserRepository;


class LessonController extends Controller
{
    public function getLesson()
    {
        $courseId = $this->getCourseIdFromUrl();

        if (!isset($_COOKIE["jwtToken"])) {
            $this->redirectToLogin();
        }

        // Extract username from JWT token
        $jwtToken = $_COOKIE["jwtToken"];
        $jwtManager = new JWTManager();
        $username = $jwtManager->getUsername($jwtToken);

        $userCollection = MongoDBManager::getCollection('userdb', 'users');
        $userRepository = new UserRepository($userCollection);

        // Retrieve user data 
        $user = $userRepository->getUserByUsername($username);

        // Extract enrolled course IDs from user data
        $userEnrolledCourses = isset($user['enrollment_keys']) ? $this->bsonArrayToArray($user['enrollment_keys']) : [];

        // Check if the user is not enrolled in the course
        if (!in_array($courseId, $userEnrolledCourses)) {
            // Forbidden access
            $this->renderError('403');
            exit;
        }

        // If it is enrolled render lesson page
        $lessonUtil = new LessonUtil(MySqlManager::getConnection());
        $videoLessonURI = $lessonUtil->getVideoURIByCourseId($courseId);
        // Render the lesson page with the video lesson URI
        echo $lessonUtil->renderLessonPage($videoLessonURI);
    }

    function bsonArrayToArray($bsonArray)
    {
        $result = [];
        foreach ($bsonArray as $value) {
            $result[] = $value;
        }
        return $result;
    }


    private function getCourseIdFromUrl()
    {
        $url = $_SERVER['REQUEST_URI'];
        $pattern = "/\/course\/(\d+)\//";

        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        } else {
            echo "Course ID not found.";
            exit;
        }
    }
}
