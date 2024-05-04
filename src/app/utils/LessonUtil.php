<?php

namespace app\utils;

use app\models\Course;
use app\services\providers\PathService;
use PDO;
use PDOException;

class LessonUtil
{

    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public function getVideoURIByCourseId($id)
    {
        try {
            $sqlQuery = "SELECT video_source FROM courses WHERE course_id = ?";

            $stmt = $this->pdo->prepare($sqlQuery);
            $stmt->execute([$id]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return $result['video_source'];
            
            } else {
                return null;
            }

        } catch (PDOException $e) {
            die("Error fetching courses: " . $e->getMessage());
        }
    }

    public function renderLessonPage($video_uri)
    {
        $viewsPath = realpath(__DIR__ . '/../views');
        $template = file_get_contents($viewsPath.'/lesson/lesson_template.php');

        $placeholders = [
            '{{TITLE}}' => pathinfo($video_uri,PATHINFO_FILENAME),
            '{{LESSON}}' => str_replace('-',' ',pathinfo($video_uri,PATHINFO_FILENAME)),
            '{{VIDEO_API}}' => 'https://codecademyre.com/api/fetchVideo?video_src='.$video_uri
        ];

        foreach ($placeholders as $placeholder => $value) {
            $template = str_replace($placeholder, $value, $template);
        }

        return $template;
    }

}
