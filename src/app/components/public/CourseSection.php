<?php

namespace app\components\public;

use app\models\Course;
use PDO;
use PDOException;


class CourseSection {
  private PDO $pdo;

  public function __construct(PDO $pdo) {
      $this->pdo = $pdo;
  }

  public function getFreeCourses(){
    try{
      $sqlQuery = "SELECT * FROM courses WHERE course_type = 'Free'";
      $stmt = $this->pdo->query($sqlQuery);

      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

      foreach($results as $result){
        $freeCourses[] = new Course(
          $result['id'],
          $result['title'],
          $result['description'],
          $result['difficulty'],
          $result['lesson_count'],
          $result['price'],
          $result['course_type']
        );
      }

      return $freeCourses;

    } catch (PDOException $e) {
      die("Error fetching courses: " . $e->getMessage());
    }
  }

  public function displayFreeCourses(array $freeCourses){
    foreach ($freeCourses as $course) {
      echo "
          <div class='course-container'>
              <div class='course-type'>
                  <p>{$course->getCourseType()} course</p>
              </div>
              <div class='course-description'>
                  <h3>{$course->getTitle()}</h3>
                  <p>{$course->getDescription()}</p>
              </div>
              <div class='dotted-line'>.................................</div>
              <div class='course-subsol'>
                  <img src='assets/icon/icons8-no-connection-24.png'>
                  <p><b>{$course->getDifficulty()}</b></p>
                  <p><b>{$course->getLessonCount()}</b> Lessons</p>
              </div>
          </div>
          ";
    }
  }
}