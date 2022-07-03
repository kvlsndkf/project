<?php
include_once ('/xampp/htdocs' . '/project/database/connection.php');

class Solicitation
{
    //attributes
    private int $id;
    private string $contact;
    private string $category;
    private string $registerLink;
    private string $title;
    private string $description;
    private string $status;
    private string $context;
    private string $conclusion;
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
    public function getContact()
    {
        return $this->contact;
    }
    public function setContact($contact)
    {
        $this->contact = $contact;
    }
    //----------------------------
    public function getCategory()
    {
        return $this->category;
    }
    public function setCategory($category)
    {
        $this->category = $category;
    }
    //----------------------------
    public function getRegisterLink()
    {
        return $this->registerLink;
    }
    public function setRegisterLink($registerLink)
    {
        $this->registerLink = $registerLink;
    }
    //----------------------------
    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($title)
    {
        $this->title = $title;
    }
    //----------------------------
    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
    //----------------------------
    public function getStatus()
    {
        return $this->status;
    }
    public function setStatus($status)
    {
        $this->status = $status;
    }
    //----------------------------
    public function getContext()
    {
        return $this->context;
    }
    public function setContext($context)
    {
        $this->context = $context;
    }
    //----------------------------
    public function getConclusion()
    {
        return $this->conclusion;
    }
    public function setConclusion($conclusion)
    {
        $this->conclusion = $conclusion;
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