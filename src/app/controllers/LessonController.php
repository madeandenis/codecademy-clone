<?php

namespace app\controllers;

use app\core\database\mysql\MySqlManager;
use app\core\database\MongoDBManager;
use app\utils\LessonUtil;
use app\utils\JWTManager;
use app\repositories\UserRepository;


class LessonController extends Controller
{
    public function getLesson($courseId)
    {
        $courseId = $this->getCourseIdFromUrl($courseId);

        if (!isset($_COOKIE["jwtToken"])) {
            header("Location: http://codecademyre.com/login");
            exit;
        }

        $jwtToken = $_COOKIE["jwtToken"];
        $jwtManager = new JWTManager();
        $username = $jwtManager->getUsername($jwtToken);

        $userCollection = MongoDBManager::getCollection('userdb', 'users');
        $userRepository = new UserRepository($userCollection);
        $user = $userRepository->getUserByUsername($username);
        $userEnrolledCourses = isset($user['enrollment_keys']) ? $this->bsonArrayToArray($user['enrollment_keys']) : [];

        if (!in_array($courseId, $userEnrolledCourses)) {
            header("Location: http://codecademyre.com/login");
            exit;
        }

        // Render lesson page
        $lessonUtil = new LessonUtil(MySqlManager::getConnection());
        $videoLessonURI = $lessonUtil->getVideoURIByCourseId($courseId);
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


    private function getCourseIdFromUrl($courseId)
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
