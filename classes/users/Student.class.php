<?php
include_once ('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/inheritances/User.class.php');

class Student extends User
{
    //attributes
    protected int $id;
    protected string $firstName;
    protected string $surname;
    protected int $userId;
    protected int $courseId;
    protected int $moduleId;

    //getters and setters
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    //----------------------------
    public function getFirstName()
    {
        return $this->firstName;
    }
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }
    //----------------------------
    public function getSurname()
    {
        return $this->surname;
    }
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }
    //----------------------------
    public function getUserId()
    {
        return $this->userId;
    }
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
    //----------------------------
    public function getCourseId()
    {
        return $this->courseid;
    }
    public function setCourseId($courseid)
    {
        $this->courseid = $courseid;
    }
    //----------------------------
    public function getModuleId()
    {
        return $this->moduleid;
    }
    public function setModuleId($moduleid)
    {
        $this->moduleid = $moduleid;
    }
    //----------------------------
}