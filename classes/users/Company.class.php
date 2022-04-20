<?php
include_once ('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/inheritances/User.class.php');

class Company extends User
{
    //attributes
    private int $id;
    private int $userId;
    private string $name;
    private string $district;
    private string $city;
    private string $about;

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
    public function getUserId()
    {
        return $this->userId;
    }
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
    //----------------------------
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    //----------------------------
    public function getDistrict()
    {
        return $this->district;
    }
    public function setDistrict($district)
    {
        $this->district = $district;
    }
    //----------------------------
    public function getCity()
    {
        return $this->city;
    }
    public function setCity($city)
    {
        $this->city = $city;
    }
    //----------------------------
    public function getAbout()
    {
        return $this->about;
    }
    public function setAbout($about)
    {
        $this->about = $about;
    }
    //----------------------------
}