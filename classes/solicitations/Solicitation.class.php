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
    public function getResultBuildList(): array
    {
        return $this->resultBuildList;
    }
    public function setResultBuildList(array $resultBuildList): void
    {
        $this->resultBuildList = $resultBuildList;
    }
    //----------------------------
    public function registerSolicitation(Solicitation $solicitation)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("INSERT INTO solicitations(contact,category_id,title,description ,status,created_at)
                                         VALUES (?,?,?,?,?, NOW())");
            $stmt->bindValue(1, $solicitation->getContact());
            $stmt->bindValue(2, $solicitation->getCategory());
            $stmt->bindValue(3, $solicitation->getTitle());
            $stmt->bindValue(4, $solicitation->getDescription());
            $stmt->bindValue(5, $solicitation->getStatus());
            

            $stmt->execute();

            $_SESSION['statuPositive'] = "Obrigado! Seu comentário ajuda a deixar o help melhor para todos. Vamos ajustar e logo você poderá adicionar essa informação na sua conta!";
            return header('Location: /project/views/pages/login/login-page.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    //----------------------------
}