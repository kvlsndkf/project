<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');

class Denunciation
{
    //attributes
    public int $id;
    public int $createdById;
    public int $denouncedId;
    public ?int $questionId = null;
    public ?int $answerId = null;
    public string $reason;
    public string $postLink;
    public string $status;
    public string $context;
    public string $conclusion;
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
    public function getQuestionId()
    {
        return $this->questionId;
    }
    public function setQuestionId($questionId)
    {
        $this->questionId = $questionId;
    }
    //----------------------------
    public function getAnswerId()
    {
        return $this->answerId;
    }
    public function setAnswerId($answerId)
    {
        $this->answerId = $answerId;
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
    //methods

    public function registerDenunciation(Denunciation $denunciation)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("INSERT INTO denunciations(reason, post_link, status, created_by_id, denounced_id, question_id, answer_id, created_at)
                                         VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");

            $stmt->bindValue(1, $denunciation->getReason());
            $stmt->bindValue(2, $denunciation->getPostLink());
            $stmt->bindValue(3, $denunciation->getStatus());
            $stmt->bindValue(4, $denunciation->getCreatedById());
            $stmt->bindValue(5, $denunciation->getDenouncedId());
            $stmt->bindValue(6, $denunciation->getQuestionId());
            $stmt->bindValue(7, $denunciation->getAnswerId());

            $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        $idQuestion = $this->getQuestionId();
        $idAnswer = $this->getAnswerId();

        if (!empty($idQuestion)) {
            try {

                $stmt = $connection->prepare("UPDATE questions SET is_denounced = ?, updated_at = NOW()
                                             WHERE id = $idQuestion");

                $stmt->bindValue(1, true);

                $stmt->execute();
                header('Location: /project/private/student/pages/home/home.page.php');
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        if (!empty($idAnswer)) {
            try {

                $stmt = $connection->prepare("UPDATE answers SET is_denounced = ?, updated_at = NOW()
                                             WHERE id = $idAnswer");

                $stmt->bindValue(1, true);

                $stmt->execute();
                header('Location: /project/private/student/pages/home/home.page.php');
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }
}
