<?php

namespace app\components\public;

use app\models\Course;
use PDO;
use PDOException;


class CourseSection
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getCourses($courseType = null, $limit = null)
    {
        try {
            $sqlQuery = "SELECT * FROM courses";

            if ($courseType) {
                $sqlQuery .= " WHERE course_type = '" . $courseType . "'";
            }

            if ($limit) {
                $sqlQuery .= " ORDER BY RAND() LIMIT " . (int) $limit;
            }

            $stmt = $this->pdo->prepare($sqlQuery);
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $courses = [];

            foreach ($results as $result) {
                $courses[] = new Course(
                    $result['course_id'],
                    $result['title'],
                    $result['description'],
                    $result['difficulty'],
                    $result['lesson_count'],
                    $result['price'],
                    $result['course_type']
                );
            }

            return $courses;

        } catch (PDOException $e) {
            die("Error fetching courses: " . $e->getMessage());
        }
    }

    public function getCoursesAsHtml(array $courses)
    {
        $htmlCourses = [];
        foreach ($courses as $course) {
            $courseTypeLowerCase = strtolower($course->getCourseType());
            $htmlCourses[] = "
        <a style='text-decoration: none; color: #10162F;' href='https://codecademyre.com/course/{$course->getId()}'>
          <div class='course-container'>
              <div class='course-type-{$courseTypeLowerCase}'>
                  <p>{$course->getCourseType()} course</p>
              </div>
              <div class='course-description'>
                  <h3>{$course->getTitle()}</h3>
                  <p>{$course->getDescription()}</p>
              </div>
              <div class='dotted-line'>.................................</div>
              <div class='course-subsol'>
                  <img src='assets/icon/icons8-no-connection-24.png'>
                  <p class='course-difficulty'><b>{$course->getDifficulty()}</b></p>
                  <p class='lesson-count'><b>{$course->getLessonCount()}</b> Lessons</p>
              </div>
          </div>
          </a>
          ";
        }
        return $htmlCourses;
    }
}