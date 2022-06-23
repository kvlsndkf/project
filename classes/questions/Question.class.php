<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');

class Question
{
    //attributes
    public int $id;
    public int $xp;
    public string $question;
    public string $createdAt;
    public string $updatedAt;
    public $category;
    public $course;
    public $subject;
    public int $student;
    public string $photo = "";
    public string $document = "";
    public string $nameDocument = "";

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
    public function getCategory()
    {
        return $this->category;
    }
    public function setCategory($category)
    {
        $this->category = $category;
    }
    //----------------------------
    public function getQuestion()
    {
        return $this->question;
    }
    public function setQuestion($question)
    {
        $this->question = $question;
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
    public function getCourse()
    {
        return $this->course;
    }
    public function setCourse($course)
    {
        $this->course = $course;
    }
    //----------------------------
    public function getSubject()
    {
        return $this->subject;
    }
    public function setSubject($subject)
    {
        $this->subject = $subject;
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
    //methods
    /**
     * @method registerModule() registers the modules by 
     * @param Module $module 
     */
    public function registerQuestion(Question $question)
    {
        $connection = Connection::connection();

        try {
            $connection->beginTransaction();
            $stmt = $connection->prepare("INSERT INTO questions(xp, question, photo, document, document_name, course_id, subject_id, category_id, student_id)
                                         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->bindValue(1, $question->getXp());
            $stmt->bindValue(2, $question->getQuestion());
            $stmt->bindValue(3, $question->getPhoto());
            $stmt->bindValue(4, $question->getDocument());
            $stmt->bindValue(5, $question->getNameDocument());
            $stmt->bindValue(6, $question->getCourse());
            $stmt->bindValue(7, $question->getSubject());
            $stmt->bindValue(8, $question->getCategory());
            $stmt->bindValue(9, $question->getStudent());

            $stmt->execute();

            $idQuestion = $connection->lastInsertId();
            $this->setId($idQuestion);
            $connection->commit();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        try {
            $connection = Connection::connection();

            $id = $this->getId();
            $linkQuestion = "/project/private/student/pages/detail-question/detail-question.page.php?idQuestion=" . $id;

            $insetLink = $connection->prepare("UPDATE questions SET link_question = ?, created_at = NOW()
                                                WHERE id = '$id'");

            $insetLink->bindValue(1, $linkQuestion);
            $insetLink->execute();

            $_SESSION['statusPositive'] = "Pergunta feita.";
            header('Location: /project/private/student/pages/home/home.page.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @method listSchool() lists the schools by 
     * @param string $search 
     */
    public function listQuestion()
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT quest.id, quest.link_question, usr.photo, usr.profile_link, stu.first_name, stu.surname, module.name AS 'module', 
                                        school.name AS 'school', subj.name AS 'subject', quest.question, quest.xp, 
                                        category.name AS 'category', course.name AS 'course', quest.photo AS 'imageQuestion', 
                                        quest.document, quest.document_name, quest.is_denounced, quest.created_at FROM students stu
                                            
                                            INNER JOIN schoolshasstudents ss
                                            ON stu.id = ss.student_id
                                            INNER JOIN schools school
                                            ON ss.school_id = school.id
                                            INNER JOIN modules module
                                            ON module.id = stu.module_id
                                            INNER JOIN questions quest
                                            ON stu.id = quest.student_id
                                            INNER JOIN subjects subj
                                            ON subj.id = quest.subject_id
                                            INNER JOIN courses course
                                            ON course.id = quest.course_id
                                            INNER JOIN categories category
                                            ON category.id = quest.category_id
                                            INNER JOIN users usr
                                            ON stu.user_id = usr.id
                                            ORDER BY quest.created_at DESC
                                        ");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildQuestionList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function buildQuestionList($result)
    {
        $questions = [];

        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            $question = $this->buildQuestion($row);

            array_push($questions, $question);
        }
        return $questions;
    }

    private function countCreatedQuestion($dateQuestion)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $CurrentDateAndTime = date('y-m-d H:i:s', time());

        $CurrentDate =  new DateTime($CurrentDateAndTime);
        $QuestionDate =  new DateTime($dateQuestion);

        $result = $QuestionDate->diff($CurrentDate);

        if ($result->s < 60 && $result->i == 0) {
            return "Há poucos segundos";
        }

        if ($result->i >= 0 && $result->h == 0) {
            return $result->i . " minutos";
        }

        if ($result->h >= 0 && $result->d == 0) {
            return $result->h . " horas";
        }

        if ($result->d <= 30 && $result->m == 0) {
            return $result->d . " dias";
        }

        if ($result->m <= 12 && $result->y == 0) {
            return $result->m . " meses";
        }

        if ($result->y > 0) {
            return $result->y . " anos";
        }
    }

    public function listDetailsQuestion(int $id)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT quest.id, quest.link_question, usr.photo, usr.profile_link, stu.first_name, stu.surname, module.name AS 'module', 
                                        school.name AS 'school', subj.name AS 'subject', quest.question, quest.xp, quest.student_id,
                                        category.name AS 'category', course.name AS 'course', quest.photo AS 'imageQuestion', 
                                        quest.document, quest.document_name, quest.is_denounced, quest.created_at FROM students stu
                                            
                                            INNER JOIN schoolshasstudents ss
                                            ON stu.id = ss.student_id
                                            INNER JOIN schools school
                                            ON ss.school_id = school.id
                                            INNER JOIN modules module
                                            ON module.id = stu.module_id
                                            INNER JOIN questions quest
                                            ON stu.id = quest.student_id
                                            INNER JOIN subjects subj
                                            ON subj.id = quest.subject_id
                                            INNER JOIN courses course
                                            ON course.id = quest.course_id
                                            INNER JOIN categories category
                                            ON category.id = quest.category_id
                                            INNER JOIN users usr
                                            ON stu.user_id = usr.id
                                            WHERE quest.id = '$id'
                                        ");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $this->buildQuestion($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function buildQuestion($row)
    {
        $question = new Question();
        $question->id = $row['id'];
        $question->linkQuestion = $row['link_question'];
        $question->photo = $row['photo'];
        $question->firstName = $row['first_name'];
        $question->surname = $row['surname'];
        $question->module = $row['module'];
        $question->school = $row['school'];
        $question->subject = $row['subject'];
        $question->question = $row['question'];
        $question->xp = $row['xp'];
        $question->category = $row['category'];
        $question->course = $row['course'];
        $question->image = $row['imageQuestion'];
        $question->document = $row['document'];
        $question->documentName = $row['document_name'];
        $question->isDenounced = $row['is_denounced'];
        $question->creatorId = $row['student_id'] ?? "";
        $question->linkProfile = $row['profile_link'];
        $question->created = $this->countCreatedQuestion($row['created_at']);

        return $question;
    }

    public function getCreatorQuestionById(int $idQuestion)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT student_id FROM questions
                                                WHERE id = '$idQuestion'");

            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getLatestXpQuestion(int $idQuestion)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT xp FROM questions
                                                WHERE id = '$idQuestion'");

            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function hasAnswers(int $questionID)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT id FROM answers
                                            WHERE question_id = $questionID
                                        ");

            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function deleteQuestion(int $questionID, string $pathPhoto, string $pathDocument)
    {
        $connection = Connection::connection();

        try {
            unlink("/xampp/htdocs" . $pathPhoto);
            unlink("/xampp/htdocs" . $pathDocument);

            $stmt = $connection->prepare("DELETE FROM questions WHERE id= '$questionID'");

            $stmt->execute();

            $_SESSION['statusPositive'] = "Questão apagada com sucesso.";
            header('Location: /project/private/student/pages/home/home.page.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function searchQuestionForUpdate(int $id): array
    {

        $connection = Connection::connection();

        $stmt = $connection->prepare("SELECT * FROM questions WHERE id = $id");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
}
