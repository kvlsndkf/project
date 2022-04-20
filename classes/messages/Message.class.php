<?php
include_once ('/xampp/htdocs' . '/project/database/connection.php');

class Message
{
    //attributes
    private int $id;
    private string $contact;
    private string $status;
    private string $message;
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
    public function getStatus()
    {
        return $this->status;
    }
    public function setStatus($status)
    {
        $this->status = $status;
    }
    //----------------------------
    public function getMessage()
    {
        return $this->message;
    }
    public function setMessage($message)
    {
        $this->message = $message;
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