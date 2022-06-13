<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/questions/Question.class.php');
require_once('/xampp/htdocs' . '/project/classes/users/StudentMethods.class.php');
class Answer
{
    //attributes
    public int $id;
    public int $xp;
    public int $idQuestion;
    public int $creatorAnswer;
    public int $creatorAvaliation;
    public float $avaliation;
    public int $likeAnswer;
    public string $answer;
    public string $createdAt;
    public string $updatedAt;
    public int $student;
    public string $photo = "";
    public string $document = "";
    public string $nameDocument = "";
    public int $stars = 0;

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
    public function getXp()
    {
        return $this->xp;
    }
    public function setXp($xp)
    {
        $this->xp = $xp;
    }
    //----------------------------
    public function getIdQuestion()
    {
        return $this->idQuestion;
    }
    public function setIdQuestion($idQuestion)
    {
        $this->idQuestion = $idQuestion;
    }
    //----------------------------
    public function getCreatorAnswer()
    {
        return $this->creatorAnswer;
    }
    public function setCreatorAnswer($creatorAnswer)
    {
        $this->creatorAnswer = $creatorAnswer;
    }
    //----------------------------
    public function getAnswer()
    {
        return $this->answer;
    }
    public function setAnswer($answer)
    {
        $this->answer = $answer;
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
    public function getStudent()
    {
        return $this->student;
    }
    public function setStudent($student)
    {
        $this->student = $student;
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
    public function getDocument()
    {
        return $this->document;
    }
    public function setDocument($document)
    {
        $this->document = $document;
    }
    //----------------------------
    public function getNameDocument()
    {
        return $this->nameDocument;
    }
    public function setNameDocument($nameDocument)
    {
        $this->nameDocument = $nameDocument;
    }
    //----------------------------
    public function getAvaliation()
    {
        return $this->avaliation;
    }
    public function setAvaliation($avaliation)
    {
        $this->avaliation = $avaliation;
    }
    //----------------------------
    public function getLikeAnswer()
    {
        return $this->likeAnswer;
    }
    public function setLikeAnswer($likeAnswer)
    {
        $this->likeAnswer = $likeAnswer;
    }
    //----------------------------
    //methods

    public function registerAnswer($answer)
    {
        $connection = Connection::connection();

        //id creator question
        $question = new Question();
        $questionID = $this->getIdQuestion();

        //creator question
        $creatorQuestion = $question->getCreatorQuestionById($questionID);

        //creator answer
        $creatorAnswerID = $this->getCreatorAnswer();

        //checking if the person has already replied
        $checkPerson = $this->checkAnswerCreator($creatorAnswerID, $questionID);

        //xp latest question
        $xpQuestion = $question->getLatestXpQuestion($questionID);

        //xp for creator answer
        $xpAnswer = $creatorAnswerID == $creatorQuestion[0]['student_id'] || !$checkPerson == false ? 0 : $xpQuestion[0]['xp'];

        // }

        try {
            $stmt = $connection->prepare("INSERT INTO answers(answer, photo, document, document_name, avg_avaliation, like_answer, question_id, answer_creator_id, created_at)
                                         VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");

            $stmt->bindValue(1, $answer->getAnswer());
            $stmt->bindValue(2, $answer->getPhoto());
            $stmt->bindValue(3, $answer->getDocument());
            $stmt->bindValue(4, $answer->getNameDocument());
            $stmt->bindValue(5, $answer->getAvaliation());
            $stmt->bindValue(6, $answer->getLikeAnswer());
            $stmt->bindValue(7, $answer->getIdQuestion());
            $stmt->bindValue(8, $answer->getCreatorAnswer());
            $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        try {
            //adding the xp
            $student = new StudentMethods();
            $latestXpStudent = $student->getLatestXpStudent($creatorAnswerID);
            $totalXp = $xpAnswer + $latestXpStudent[0]['xp'];

            $xpForTheAnswer = $connection->prepare("UPDATE students SET xp = ?
                                                    WHERE id = '$creatorAnswerID'");

            $xpForTheAnswer->bindValue(1, $totalXp);
            $xpForTheAnswer->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        try {
            if ($xpQuestion[0]['xp'] == 0) {
                $newXp = 0;
            } else {
                $newXp = $xpQuestion[0]['xp'] - 50;
            }

            $updateXpQuestion = $xpAnswer == 0 ? $xpQuestion[0]['xp'] : $newXp;

            $xpForTheQuestion = $connection->prepare("UPDATE questions SET xp = ?
                                                        WHERE id = '$questionID'");

            $xpForTheQuestion->bindValue(1, $updateXpQuestion);
            $xpForTheQuestion->execute();

            $_SESSION['statusPositive'] = "Resposta feita.";
            header('Location: /project/private/student/pages/detail-question/detail-question.page.php?idQuestion=' . $questionID);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @method listSchool() lists the schools by 
     * @param string $search 
     */
    public function listAnswer(int $idQuestion, $studentId)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT answ.id, usr.photo, stu.first_name, stu.surname, module.name AS 'module', 
                                        school.name AS 'school', answ.answer, answ.photo AS 'imageAnswer', answ.avg_avaliation,
                                        answ.like_answer, answ.document, answ.document_name, answ.created_at FROM students stu
                                            
                                        INNER JOIN schoolshasstudents ss
                                        ON stu.id = ss.student_id
                                        INNER JOIN schools school
                                        ON ss.school_id = school.id
                                        INNER JOIN modules module
                                        ON module.id = stu.module_id
                                        INNER JOIN answers answ
                                        ON stu.id = answ.answer_creator_id
                                        INNER JOIN users usr
                                        ON stu.user_id = usr.id
                                        INNER JOIN questions quest
                                        ON answ.question_id = quest.id
                                        WHERE quest.id = '$idQuestion'
                                        ORDER BY answ.created_at DESC
                                        ");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildAnswerList($result, $idQuestion, $studentId);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function buildAnswerList($result, $questionID, $studentId)
    {
        $answers = [];

        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            $answer = $this->buildAnswer($row);

            array_push($answers, $answer);
        }

        $listAnswerAvaliation = $this->listAnswerAvaliation($questionID, $studentId[0]['id']);
        $countAnswerAvaliation = $this->countAnswerAvaliation();
        $countAnswerLike = $this->countAnswerLike();

        for ($i = 0; $i < count($answers); $i++) {
            $answer = $answers[$i];

            for ($j = 0; $j < count($listAnswerAvaliation); $j++) {
                $avaliation = $listAnswerAvaliation[$j];

                if ($answer->id == $avaliation['answer_id']) {
                    $answer->stars = $avaliation['avaliation'];
                }
            }
        }

        for ($i = 0; $i < count($answers); $i++) {
            $answer = $answers[$i];

            for ($j = 0; $j < count($countAnswerAvaliation); $j++) {
                $avaliationTotal = $countAnswerAvaliation[$j];

                if ($answer->id == $avaliationTotal['answer_id']) {
                    $answer->totalAvaliation = $avaliationTotal['total'];
                }
            }
        }

        for ($i = 0; $i < count($answers); $i++) {
            $answer = $answers[$i];

            for ($j = 0; $j < count($countAnswerLike); $j++) {
                $likeTotal = $countAnswerLike[$j];

                if ($answer->id == $likeTotal['answer_id']) {
                    $answer->totalLike = $likeTotal['totalLike'];
                }
            }
        }

        return $answers;
    }

    private function buildAnswer($row)
    {
        $answer = new Answer();
        $answer->id = $row['id'];
        $answer->photo = $row['photo'];
        $answer->firstName = $row['first_name'];
        $answer->surname = $row['surname'];
        $answer->module = $row['module'];
        $answer->school = $row['school'];
        $answer->answer = $row['answer'];
        $answer->avaliation = $row['avg_avaliation'];
        $answer->image = $row['imageAnswer'];
        $answer->document = $row['document'];
        $answer->documentName = $row['document_name'];
        $answer->created = $this->countCreatedAnswer($row['created_at']);

        return $answer;
    }

    private function countCreatedAnswer($dateAnswer)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $CurrentDateAndTime = date('y-m-d H:i:s', time());

        $CurrentDate =  new DateTime($CurrentDateAndTime);
        $AnswerDate =  new DateTime($dateAnswer);

        $result = $AnswerDate->diff($CurrentDate);

        if ($result->s < 60 && $result->i == 0) {
            return "Há poucos segundos";
        }

        if ($result->i > 0 && $result->h == 0) {
            return $result->i . " minutos";
        }

        if ($result->h > 0 && $result->d == 0) {
            return $result->h . " horas";
        }

        if ($result->d < 30 && $result->m == 0) {
            return $result->d . " dias";
        }

        if ($result->m < 12 && $result->y == 0) {
            return $result->m . " meses";
        }

        if ($result->y > 0) {
            return $result->y . " anos";
        }
    }

    private function checkAnswerCreator(int $creatorAnswerID, int $questionID)
    {
        $connection = Connection::connection();

        $stmt = $connection->prepare("SELECT answer_creator_id, question_id FROM answers 
                                        WHERE answer_creator_id = '$creatorAnswerID' 
                                        AND question_id = '$questionID'
                                    ");
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getAnswerCreatorById(int $answerID, int $questionID)
    {
        $connection = Connection::connection();

        $stmt = $connection->prepare("SELECT answer_creator_id FROM answers 
                                        WHERE id = '$answerID' 
                                        AND question_id = '$questionID'
                                    ");

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }


    private function checkAvaliationCreator(int $creatorAvaliationID, int $answerID, int $questionId)
    {
        $connection = Connection::connection();

        $stmt = $connection->prepare("SELECT person_avaliation_id, question_id, answer_id FROM answershasavaliations 
                                        WHERE person_avaliation_id = $creatorAvaliationID
                                        AND question_id = $questionId
                                        AND answer_id = $answerID
                                    ");
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function registerAvaliation(Answer $avaliation, $questionID, $answerID, $personAvaliationID)
    {
        $connection = Connection::connection();

        $checkAvaliator = $this->checkAvaliationCreator($personAvaliationID, $answerID, $questionID);

        if ($checkAvaliator == false) {
            try {
                $stmt = $connection->prepare("INSERT INTO answershasavaliations(avaliation, answer_id, question_id, person_avaliation_id, created_at)
                                                VALUES (?, ?, ?, ?, NOW())");

                $stmt->bindValue(1, $avaliation->getAvaliation());
                $stmt->bindValue(2, $answerID);
                $stmt->bindValue(3, $questionID);
                $stmt->bindValue(4, $personAvaliationID);
                $stmt->execute();
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } else {
            try {
                $stmt = $connection->prepare("UPDATE answershasavaliations SET avaliation = ?, updated_at = NOW()
                                                WHERE $answerID");

                $stmt->bindValue(1, $avaliation->getAvaliation());

                $stmt->execute();
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        try {
            $getAvaliations = $connection->prepare("SELECT TRUNCATE(AVG(avaliation), 2) AS 'avaliation' FROM answershasavaliations 
                                                    WHERE answer_id = '$answerID' 
                                                    AND question_id = '$questionID'
                                                    ");

            $getAvaliations->execute();
            $result = $getAvaliations->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        try {
            $avaliationInsert = $connection->prepare("UPDATE answers SET avg_avaliation = ?
                                            WHERE id = $answerID
                                            AND
                                            question_id = $questionID 
                                        ");

            $avaliationInsert->bindValue(1, $result[0]['avaliation']);
            $avaliationInsert->execute();

            // header('Location: /project/private/student/pages/detail-question/detail-question.page.php?idQuestion=' . $questionID);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function listAnswerAvaliation($questionID, $personAvaliationID)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT avaliation, answer_id FROM answershasavaliations
                                            WHERE question_id = $questionID
                                            AND person_avaliation_id = $personAvaliationID
                                            ");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function countAnswerAvaliation()
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT COUNT(avaliation) AS total, answer_id FROM answershasavaliations
                                            GROUP BY answer_id
                                            ");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function countAnswers(int $idQuestion)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT COUNT(id) AS total FROM answers
                                            WHERE question_id = $idQuestion
                                        ");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return "Respondida " . $result[0]['total'];
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function deleteAnswer(int $answerID, string $pathPhoto = "", string $pathDocument = "", int $questionID, int $studentID)
    {
        $connection = Connection::connection();

        try {
            $student = new StudentMethods();
            $checkXP = $student->getLatestXpStudent($studentID);

            $currentXp = $checkXP[0]['xp'] - 50;

            $avaliationDelete = $connection->prepare("UPDATE students SET xp = ?
                                            WHERE id = $studentID
                                        ");

            $avaliationDelete->bindValue(1, $currentXp);
            $avaliationDelete->execute();

        } catch (Exception $e) {
            echo $e->getMessage();
        }

        try {
            unlink("/xampp/htdocs" . $pathPhoto);
            unlink("/xampp/htdocs" . $pathDocument);

            $stmt = $connection->prepare("DELETE FROM answers WHERE id= '$answerID'");

            $stmt->execute();

            $_SESSION['statusPositive'] = "Resposta apagada com sucesso.";
            header('Location: /project/private/student/pages/detail-question/detail-question.page.php?idQuestion=' . $questionID);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        
    }

    public function checkLikeCreator(int $questionID, int $answerID, int $personLikeID)
    {
        $connection = Connection::connection();

        $stmt = $connection->prepare("SELECT person_liked_id, question_id, answer_id FROM answershaslikes 
                                        WHERE person_liked_id = $personLikeID
                                        AND question_id = $questionID
                                        AND answer_id = $answerID
                                    ");
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function registerLike(int $questionID, int $answerID, int $personLikeID)
    {
        $connection = Connection::connection();

        $checkLiked = $this->checkLikeCreator($questionID, $answerID, $personLikeID);

        try {

            if ($checkLiked == false) {
                try {
                    $stmt = $connection->prepare("INSERT INTO answershaslikes(answer_id, question_id, person_liked_id, created_at)
                                                VALUES (?, ?, ?, NOW())");

                    $stmt->bindValue(1, $answerID);
                    $stmt->bindValue(2, $questionID);
                    $stmt->bindValue(3, $personLikeID);
                    $stmt->execute();
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            } else {
                try {
                    $stmt = $connection->prepare("DELETE FROM answershaslikes
                                                    WHERE $personLikeID");

                    $stmt->execute();

                    return header('Location: /project/private/student/pages/detail-question/detail-question.page.php?idQuestion=' . $questionID);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function countAnswerLike()
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT COUNT(id) AS totalLike, answer_id FROM answershaslikes
                                            GROUP BY answer_id
                                            ");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
