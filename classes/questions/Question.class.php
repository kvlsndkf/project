<?php

use Question as GlobalQuestion;

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
    //methods
    /**
     * @method registerModule() registers the modules by 
     * @param Module $module 
     */
    public function registerQuestion(Question $question)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("INSERT INTO questions(xp, question, course_id, subject_id, category_id, student_id, created_at)
                                         VALUES (?, ?, ?, ?, ?, ?, NOW())");

            $stmt->bindValue(1, $question->getXp());
            $stmt->bindValue(2, $question->getQuestion());
            $stmt->bindValue(3, $question->getCourse());
            $stmt->bindValue(4, $question->getSubject());
            $stmt->bindValue(5, $question->getCategory());
            $stmt->bindValue(6, $question->getStudent());

            $stmt->execute();

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
            $stmt = $connection->prepare("SELECT usr.photo, stu.first_name, stu.surname, module.name AS 'module', school.name AS 'school', subj.name AS 'subject', quest.question, quest.xp, category.name AS 'category', course.name AS 'course', quest.created_at FROM students stu
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

    private function buildQuestionList($result)
    {
        $questions = [];

        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            $question = new Question();
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
            $question->created = $this->countCreatedQuestion($row['created_at']);

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
            return "< 1 minuto. Há poucos segundos";
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
}
