<?php

namespace app\controllers;

use app\core\database\mysql\MySqlManager;
use app\utils\CourseUtil;

class CourseController extends Controller{
    public function getCourse($courseId){
        $courseUtil = new CourseUtil(MySqlManager::getConnection());
        echo $courseUtil->renderCoursePage($courseUtil->getCourseById($courseId));
    }
}