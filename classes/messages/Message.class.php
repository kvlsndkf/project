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
    public function setStatus(string $status): void
    {
        if ($status == true) {
            $status = "Nova";
        } 

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
            $stmt = $connection->prepare("INSERT INTO messages(contact, message, status, created_at)
                                         VALUES (?,?,?, NOW())");
                                         
            $stmt->bindValue(1, $mensagem->getContact());
            $stmt->bindValue(2, $mensagem->getMessage());
            $stmt->bindValue(3, $mensagem->getStatus());
            
            $stmt->execute();

            $_SESSION['statusPositive'] = "Mensagem Cadastrada com Sucesso.";
            header('Location: /project/views/landing-page/landing-page.php');
        } catch (Exception $e) {
            echo $e->getMessage();
            
        }
    }

     /**
     * @method listMessage() lists the messages by 
     * @param string $search 
     */

    public function listMessage(string $search = '', string $filter = ''): array | false
    {
        $connection = Connection::connection();

        try {
            if (!is_null($search) && !empty($search)) {
                $result = $this->searchMessage($search);
                return $this->buildMessageList($result);
            }

            if (!empty($filter)) {
                $result = $this->filterMessage($filter);
                return $this->buildMessageList($result);
            }


            $stmt = $connection->prepare("SELECT * FROM messages");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $this->buildMessageList($result);
    }
    
     catch (Exception $e) {
        echo $e->getMessage();
    }

  }

   //----------------------------
    /**
     * @method buildMessageList() organize the list of teachers by 
     * @param array $result 
     */
    private function buildMessageList(array | false $result)
    {
        $messages = [];

        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            $message = new Message();
            $message->id = $row['id'];
            $message->contact = $row['contact'];
            $message->status = $row['status'];
            $message->message = $row['message'];
            array_push($messages, $message);
        }

        $this->setResultBuildList($messages);
        return $messages;
    }

    
       //----------------------------
    /**
     * @method countCourses() count the teachers by 
     * @param string $search 
     */
    public function countMessages(string $search = '')
    {
        $searching = (!is_null($search) && !empty($search));

        if ($searching) {
            $resultBuildList = $this->getResultBuildList();
            $totalSearch = count($resultBuildList);
            return "Resultado da pesquisa " . $totalSearch;
        }

        $connection = Connection::connection();
        try {
            $stmt = $connection->prepare("SELECT COUNT(id) AS total FROM messages");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return "Total (" . $result[0]['total']. ")";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    //----------------------------
    /**
     * @method listMessageOfSearchBar() list messages for search bar  
     */
    public function listMessagesOfSearchBar()
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT * FROM messages ORDER BY message");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildMessageList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    //----------------------------
    /**
     * @method searchMessage() search messages by 
     * @param string $search 
     */
    private function searchMessage(string $search)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT * FROM messages WHERE message LIKE '%$search%' ORDER BY message");

            $stmt->execute();

            $lines = $stmt->rowCount();

            if ($lines == 00) {
                $_SESSION['statusNegative'] = "Não existe registros.";
            }

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}