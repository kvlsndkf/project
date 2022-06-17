<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/answers/Answer.class.php');

class StudentMethods
{
    //attributes
    public int $id;
    public string $firstName;
    public string $surname;
    public int $xp;
    public int $userId;
    public int $courseId;
    public int $moduleId;
    public int $schoolId;

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
    public function getFirstName()
    {
        return $this->firstName;
    }
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }
    //----------------------------
    public function getSurname()
    {
        return $this->surname;
    }
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }
    //----------------------------
    public function getUserId()
    {
        return $this->userId;
    }
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
    //----------------------------
    public function getCourseId()
    {
        return $this->courseid;
    }
    public function setCourseId($courseid)
    {
        $this->courseid = $courseid;
    }
    //----------------------------
    public function getModuleId()
    {
        return $this->moduleid;
    }
    public function setModuleId($moduleid)
    {
        $this->moduleid = $moduleid;
    }
    //----------------------------
    public function getSchoolId()
    {
        return $this->schoolId;
    }
    public function setSchoolId($schoolId)
    {
        $this->schoolId = $schoolId;
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

    public function getStudentByUserID(int $id)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT s.id FROM students s
                                        INNER JOIN users u
                                        ON s.user_id = u.id
                                        WHERE u.id = '$id'
                                    ");

            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getLatestXpStudent(int $idStudent)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT xp FROM students
                                                WHERE id = '$idStudent'");

            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public static function getUserByStudentID(int $id)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT user_id FROM students WHERE id = $id");

            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getDataStudentByID(int $id)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT stu.id, stu.first_name, stu.surname, stu.user_id, stu.xp, usr.photo, stu.created_at, module.id AS 'moduleId',
                                            module.name AS 'module', course.name AS 'course', school.name AS 'school', usr.linkedin, usr.github, 
                                            usr.facebook, usr.instagram, usr.profile_link FROM students stu

                                            INNER JOIN users usr
                                            ON stu.user_id = usr.id
                                            INNER JOIN modules module
                                            ON stu.module_id = module.id
                                            INNER JOIN courses course
                                            ON stu.course_id = course.id
                                            INNER JOIN schoolshasstudents ss
                                            ON stu.id = ss.student_id
                                            INNER JOIN schools school
                                            ON ss.school_id = school.id
                                            WHERE stu.id = $id
                                        ");

            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $this->buildStudent($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function buildStudent($row)
    {
        $student = new StudentMethods();
        $student->id = $row['id'];
        $student->userId = $row['user_id'];
        $student->firstName = $row['first_name'];
        $student->surname = $row['surname'];
        $student->xp = $row['xp'];
        $student->photo = $row['photo'];
        $student->module = $row['module'];
        $student->moduleId = $row['moduleId'];
        $student->course = $row['course'];
        $student->school = $row['school'];
        $student->linkedin = $row['linkedin'];
        $student->github = $row['github'];
        $student->facebook = $row['facebook'];
        $student->instagram = $row['instagram'];
        $student->linkProfile = $row['profile_link'];

        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        $student->created =  date('d F Y', strtotime($row['created_at']));
       

        return $student;
    }

    public function listAnswersByStudent(int $idStudent)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT answ.id AS 'answer_id', answ.answer, answ.photo AS 'imageAnswer', 
                                            answ.avg_avaliation, answ.like_answer, answ.document, answ.document_name, 
                                            answ.created_at, quest.id AS 'question_id', quest.link_question, quest.question, 
                                            course.name AS 'course', cate.name AS 'category', subj.name AS 'subject' 
                                            FROM students stu
                                                                                            
                                            INNER JOIN answers answ
                                            ON stu.id = answ.answer_creator_id
                                            INNER JOIN questions quest
                                            ON answ.question_id = quest.id
                                            INNER JOIN courses course
                                            ON quest.course_id = course.id
                                            INNER JOIN categories cate
                                            ON quest.category_id = cate.id
                                            INNER JOIN subjects subj
                                            ON quest.subject_id = subj.id
                                            WHERE stu.id = $idStudent
                                            AND answ.is_blocked NOT IN(1)
                                            ORDER BY answ.created_at DESC
                                        ");

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildAnswerStudentList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function buildAnswerStudentList($result)
    {
        $students = [];

        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            $student = $this->buildStudentAnswer($row);

            array_push($students, $student);
        }

        $countAnswerAvaliation = Answer::countAnswerAvaliation();
        $countAnswerLike = Answer::countAnswerLike();

        for ($i = 0; $i < count($students); $i++) {
            $student = $students[$i];


            for ($j = 0; $j < count($countAnswerAvaliation); $j++) {
                $avaliationTotal = $countAnswerAvaliation[$j];

                if ($student->answerId == $avaliationTotal['answer_id']) {
                    $student->totalAvaliationAnswer = $avaliationTotal['total'];
                }
            }
        }

        for ($i = 0; $i < count($students); $i++) {
            $student = $students[$i];

            for ($j = 0; $j < count($countAnswerLike); $j++) {
                $likeTotal = $countAnswerLike[$j];

                if ($student->answerId == $likeTotal['answer_id']) {
                    $student->totalLikeAnswer = $likeTotal['totalLike'];
                }
            }
        }

        return $students;
    }

    private function buildStudentAnswer($row)
    {
        $student = new StudentMethods();
        $student->answerId = $row['answer_id'];
        $student->answer = $row['answer'];
        $student->photo = $row['imageAnswer'];
        $student->avgAvaliation = $row['avg_avaliation'];
        $student->likeAnswer = $row['like_answer'];
        $student->document = $row['document'];
        $student->documentName = $row['document_name'];
        $student->created = Answer::countCreatedAnswer($row['created_at']);
        $student->questionId = $row['question_id'];
        $student->linkQuestion = $row['link_question'];
        $student->question = $row['question'];
        $student->course = $row['course'];
        $student->category = $row['category'];
        $student->subject = $row['subject'];

        return $student;
    }

    public function listQuestionsByStudent(int $idStudent)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT quest.id, quest.link_question, quest.question, quest.created_at, quest.photo,
                                            quest.document, quest.document_name, course.name AS 'course', cate.name AS 'category', 
                                            subj.name AS 'subject' FROM questions quest
                                                
                                            INNER JOIN courses course
                                            ON quest.course_id = course.id
                                            INNER JOIN categories cate
                                            ON quest.category_id = cate.id
                                            INNER JOIN subjects subj
                                            ON quest.subject_id = subj.id
                                            INNER JOIN students stu
                                            ON stu.id = quest.student_id
                                            WHERE stu.id = $idStudent
                                            AND quest.category_id NOT IN(3)
                                            AND quest.is_blocked NOT IN(1)
                                            ORDER BY quest.created_at DESC
                                        ");

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildQuestionStudentList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function buildQuestionStudentList($result)
    {
        $students = [];

        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            $student = $this->buildStudentQuestion($row);

            array_push($students, $student);
        }
        return $students;
    }

    private function buildStudentQuestion($row)
    {
        $student = new StudentMethods();
        $student->questionId = $row['id'];
        $student->linkQuestion = $row['link_question'];
        $student->question = $row['question'];
        $student->course = $row['course'];
        $student->category = $row['category'];
        $student->subject = $row['subject'];
        $student->photo = $row['photo'];
        $student->document = $row['document'];
        $student->documentName = $row['document_name'];
        $student->created = Answer::countCreatedAnswer($row['created_at']);

        return $student;
    }

    public function listMaterialsByStudent(int $idStudent)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT quest.id, quest.link_question, quest.question, quest.created_at, quest.photo,
                                            quest.document, quest.document_name, course.name AS 'course', cate.name AS 'category', 
                                            subj.name AS 'subject' FROM questions quest
                                                
                                            INNER JOIN courses course
                                            ON quest.course_id = course.id
                                            INNER JOIN categories cate
                                            ON quest.category_id = cate.id
                                            INNER JOIN subjects subj
                                            ON quest.subject_id = subj.id
                                            INNER JOIN students stu
                                            ON stu.id = quest.student_id
                                            WHERE stu.id = $idStudent
                                            AND quest.category_id = 3
                                            AND quest.is_blocked NOT IN(1)
                                            ORDER BY quest.created_at DESC
                                        ");

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildMaterialsStudentList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function buildMaterialsStudentList($result)
    {
        $students = [];

        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            $student = $this->buildStudentMaterial($row);

            array_push($students, $student);
        }
        return $students;
    }

    private function buildStudentMaterial($row)
    {
        $student = new StudentMethods();
        $student->questionId = $row['id'];
        $student->linkQuestion = $row['link_question'];
        $student->question = $row['question'];
        $student->course = $row['course'];
        $student->category = $row['category'];
        $student->subject = $row['subject'];
        $student->photo = $row['photo'];
        $student->document = $row['document'];
        $student->documentName = $row['document_name'];
        $student->created = Answer::countCreatedAnswer($row['created_at']);

        return $student;
    }

    public function listPreferencesStudent(int $idStudent)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT course.name, course.photo FROM courses course

                                            INNER JOIN usershaspreferences up
                                            ON course.id = up.preference_id
                                            INNER JOIN students stu
                                            ON stu.user_id = up.user_id
                                            WHERE stu.id = $idStudent
                                            ORDER BY course.name
                                        ");

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildPreferencesStudentList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function buildPreferencesStudentList($result)
    {
        $students = [];

        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            $student = $this->buildStudentPreference($row);

            array_push($students, $student);
        }
        return $students;
    }

    private function buildStudentPreference($row)
    {
        $student = new StudentMethods();
        $student->name = $row['name'];
        $student->photo = $row['photo'];

        return $student;
    }
}
