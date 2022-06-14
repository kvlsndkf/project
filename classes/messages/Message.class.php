<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');

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
        } else {
            $status = "Lida";
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
    //----------------------------
    public function getResultBuildListNew(): array
    {
        return $this->resultBuildListNew;
    }
    public function setResultBuildListNew(array $resultBuildListNew): void
    {
        $this->resultBuildListNew = $resultBuildListNew;
    }
    //----------------------------
    public function getResultReadBuildList(): array
    {
        return $this->resultReadBuildList;
    }
    public function setResultReadBuildList(array $resultReadBuildList): void
    {
        $this->resultReadBuildList = $resultReadBuildList;
    }
    //----------------------------
    //methods
    /**
     * @method registerMessage() register the messages by 
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

            header('Location: /project/views/landing-page/landing-page.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @method listNewMessage() list the new messages by 
     * @param string $search 
     */
    public function listNewMessage(string $search = ''): array | false
    {
        $connection = Connection::connection();

        try {
            if (!is_null($search) && !empty($search)) {
                $result = $this->searchMessage($search);
                return $this->buildNewMessageList($result);
            }

            $stmt = $connection->prepare("SELECT id, contact, status, message FROM messages 
                                            WHERE status = 'Nova'    
                                            ORDER BY created_at DESC");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildNewMessageList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @method listReadMessage() list the read messages
     */
    public function listReadMessage(): array | false
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT id, contact, status, message FROM messages 
                                            WHERE status = 'Lida'    
                                            ORDER BY updated_at DESC");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildReadMessageList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method buildNewMessageList() organize the list of new messages by 
     * @param array $result 
     */
    private function buildNewMessageList(array | false $result)
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

        $this->setResultBuildListNew($messages);
        return $messages;
    }

    //----------------------------
    /**
     * @method countNewMessages() count the new messages by 
     * @param string $search 
     */
    public function countNewMessages($search)
    {
        $resultBuildListNew = $this->getResultBuildListNew();

        $searching = (!is_null($search) && !empty($search));

        if ($searching) {
            $resultBuildList = $this->getResultBuildListNew();
            $totalSearch = count($resultBuildList);
            return "Resultado da pesquisa " . $totalSearch;
        }

        $totalNewMessage = count($resultBuildListNew);
        return "Total (" . $totalNewMessage . ")";
    }

    //----------------------------
    /**
     * @method countReadMessages() count the read messages 
     */
    public function countReadMessages()
    {
        $resultBuildListRead = $this->getResultReadBuildList();

        $totalReadMessage = count($resultBuildListRead);
        return "Total (" . $totalReadMessage . ")";
    }

    //----------------------------
    /**
     * @method buildReadMessageList() organize the list of read messages by 
     * @param array $result 
     */
    private function buildReadMessageList(array | false $result)
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

        $this->setResultReadBuildList($messages);
        return $messages;
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
     * @method buildMessageList() organize the list of messages by 
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

        return $messages;
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

    //----------------------------
    /**
     * @method readingTheMessage() reading the messages by 
     * @param string $message 
     * @param int $id
     */

    public function readingTheMessage(Message $message, int $id)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("UPDATE messages SET status = ?, updated_at = NOW()
                                         WHERE id = $id");

            $stmt->bindValue(1, $message->getStatus());

            $stmt->execute();

            $_SESSION['statusPositive'] = "Mensagem movida para <strong>Lidas<strong>.";
            header('Location: /project/private/adm/pages/message/list-message.page.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
