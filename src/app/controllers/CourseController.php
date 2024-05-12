<?php

namespace app\controllers;

use app\core\database\mysql\MySqlManager;
use app\models\Course;
use app\utils\CourseUtil;

class CourseController extends Controller{
    public function getCourse($courseId){
        $courseUtil = new CourseUtil(MySqlManager::getConnection());
        
        $course = $courseUtil->getCourseById($courseId);
        if(!$course instanceof Course){
            $this->renderError('404');
            return;
        }
        echo $courseUtil->renderCoursePage($course);
    }
}