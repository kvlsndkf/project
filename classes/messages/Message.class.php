<?php
include_once ('/xampp/htdocs' . '/project/database/connection.php');

class Message
{
    //attributes
    public int $id;
    public string $contact;
    public string $status;
    public string $message;
    public string $createdAt;
    public string $updatedAt;

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
    public function getResultBuildList(): array
    {
        return $this->resultBuildList;
    }
    public function setResultBuildList(array $resultBuildList): void
    {
        $this->resultBuildList = $resultBuildList;
    }

    //methods
    /**
     * @method registerMessage() registers the messages by 
     * @param Message $message
     */
    public function registerMessage(Message $mensagem): void
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("INSERT INTO messages(message, contact, created_at)
                                         VALUES (?,?, NOW())");
                                         
            $stmt->bindValue(1, $mensagem->getMessage());
            $stmt->bindValue(2, $mensagem->getContact());
            
            
            

            $stmt->execute();

            $_SESSION['statusPositive'] = "Módulo cadastrado com sucesso.";
            header('Location:');
        } catch (Exception $e) {
            echo $e->getMessage();
            
        }
    }
    
    
}