<?php

namespace app\utils;

use app\models\Course;
use PDO;
use PDOException;

class CourseUtil
{

    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public function getCourseById($id)
    {
        try {
            $sqlQuery = "SELECT * FROM courses WHERE course_id = ?";

            $stmt = $this->pdo->prepare($sqlQuery);
            $stmt->execute([$id]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return new Course(
                    $result['course_id'],
                    $result['title'],
                    $result['description'],
                    $result['difficulty'],
                    $result['lesson_count'],
                    $result['price'],
                    $result['course_type']
                );
            } else {
                return null;
            }

        } catch (PDOException $e) {
            die("Error fetching courses: " . $e->getMessage());
        }
    }

    public function renderCoursePage(Course $course)
    {
        $viewsPath = realpath(__DIR__ . '/../views');
        $template = file_get_contents($viewsPath.'/course/course_template.php');

        $placeholders = [
            '{{TITLE}}' => $course->getTitle(),
            '{{DESCRIPTION}}' => $course->getDescription(),
            '{{DIFFICULTY}}' => $course->getDifficulty(),
            '{{LESSON_COUNT}}' => $course->getLessonCount(),
        ];
        if($course->getPrice() == 0.00){
            $placeholders['{{PRICE}}'] = 'Free';
        }
        else{
            $placeholders['{{PRICE}}'] = $course->getPrice().'$';
        }

        foreach ($placeholders as $placeholder => $value) {
            $template = str_replace($placeholder, $value, $template);
        }

        return $template;
    }

}
