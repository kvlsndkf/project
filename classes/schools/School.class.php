<?php
include_once ('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/inheritances/Social.class.php');

class School extends Social
{
    //attributes
    private int $id;
    private string $name;
    private string $district;
    private string $city;
    private string $about;
    private string $photo;
    private bool $haveAccount;
    private string $createdAt;
    private string $updatedAt;

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
    public function getPhoto()
    {
        return $this->photo;
    }
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }
    //----------------------------
    public function getHaveAccount()
    {
        return $this->haveAccount;
    }
    public function setHaveAccount($haveAccount)
    {
        $this->haveAccount = $haveAccount;
    }
    //----------------------------
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }
    //----------------------------
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }
    //----------------------------
}