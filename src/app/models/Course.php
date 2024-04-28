<?php

namespace app\models;

class Course
{
    private $id;
    private $title;
    private $description;
    private $difficulty;
    private $lessonCount;
    private $price;
    private $courseType;

    public function __construct($id, $title, $description, $difficulty, $lessonCount, $price, $courseType)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->difficulty = $difficulty;
        $this->lessonCount = $lessonCount;
        $this->price = $price;
        $this->courseType = $courseType;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getDifficulty()
    {
        return $this->difficulty;
    }

    public function getLessonCount()
    {
        return $this->lessonCount;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getCourseType()
    {
        return $this->courseType;
    }
}
