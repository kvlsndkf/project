<?php
include_once ('/xampp/htdocs' . '/project/database/connection.php');

class Denunciation
{
    //attributes
    private int $id;
    private int $createdById;
    private int $denouncedId;
    private string $reason;
    private string $postLink;
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
    public function getCreatedById()
    {
        return $this->createdById;
    }
    public function setCreatedById($createdById)
    {
        $this->createdById = $createdById;
    }
    //----------------------------
    public function getDenouncedId()
    {
        return $this->denouncedId;
    }
    public function setDenouncedId($denouncedId)
    {
        $this->denouncedId = $denouncedId;
    }
    //----------------------------
    public function getReason()
    {
        return $this->reason;
    }
    public function setReason($reason)
    {
        $this->reason = $reason;
    }
    //----------------------------
    public function getPostLink()
    {
        return $this->postLink;
    }
    public function setPostLink($postLink)
    {
        $this->postLink = $postLink;
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