<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/answers/Answer.class.php');
require_once('/xampp/htdocs' . '/project/classes/questions/Question.class.php');


class Search
{
    //attributes
    public int $studentID;
    public string $firstName;
    public string $surname;
    public string $photoStudent;
    public string $linkStudent;
    public string $module;
    public string $course;
    public string $school;
    public int $schoolID;
    public string $schoolName;
    public string $schoolPhoto;
    public string $address;

    //methods
    public function searchQuestions(string $search)
    {
        $connection = Connection::connection();

        try {
            $question = $connection->prepare("SELECT quest.id, quest.link_question, quest.question, quest.created_at,
                                                 course.name AS 'course', cate.name AS 'category', subj.name AS 'subject' 
                                                 FROM questions quest

                                                 INNER JOIN courses course
                                                 ON quest.course_id = course.id
                                                 INNER JOIN categories cate
                                                 ON quest.category_id = cate.id
                                                 INNER JOIN subjects subj
                                                 ON quest.subject_id = subj.id
                                                
                                                 WHERE quest.question LIKE '%$search%' 
                                                 AND cate.name NOT IN('Apoio')
                                                 AND quest.is_blocked NOT IN(1)
                                                 ORDER BY quest.created_at DESC
                                        ");

            $question->execute();

            $listQuestion = $question->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        try {
            $answer = $connection->prepare("SELECT quest.id, quest.link_question, quest.question, quest.created_at,
                                                 course.name AS 'course', cate.name AS 'category', subj.name AS 'subject', 
                                                 answ.answer FROM questions quest

                                                 INNER JOIN courses course
                                                 ON quest.course_id = course.id
                                                 INNER JOIN categories cate
                                                 ON quest.category_id = cate.id
                                                 INNER JOIN subjects subj
                                                 ON quest.subject_id = subj.id
                                                 INNER JOIN answers answ
                                                 ON answ.question_id = quest.id
                                                
                                                 WHERE answ.answer LIKE '%$search%' 
                                                 AND cate.name NOT IN('Apoio')
                                                 AND quest.is_blocked NOT IN(1)
                                                 ORDER BY quest.created_at DESC
                                        ");

            $answer->execute();

            $listAnswer = $answer->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return $this->buildQuestionsSearchList($listQuestion, $listAnswer);
    }

    private function buildQuestionsSearchList($question, $answer)
    {
        $questionsArray = [];
        $answersArray = [];

        for ($i = 0; $i < count($question); $i++) {
            $row = $question[$i];
            $questionsList = $this->buildStudentQuestion($row);

            array_push($questionsArray, $questionsList);
        }

        for ($i = 0; $i < count($answer); $i++) {
            $row = $answer[$i];
            $answersList = $this->buildStudentQuestion($row);

            array_push($answersArray, $answersList);
        }

        $compare = array_merge($answersArray, $questionsArray);
        $result = array_unique($compare, SORT_REGULAR);

        return $result;
    }

    private function buildStudentQuestion($row)
    {
        $question = new Question();
        $question->questionId = $row['id'];
        $question->linkQuestion = $row['link_question'];
        $question->question = $row['question'];
        $question->course = $row['course'];
        $question->category = $row['category'];
        $question->subject = $row['subject'];
        $question->created = Answer::countCreatedAnswer($row['created_at']);

        return $question;
    }

    public function searchProfiles(string $search)
    {
        $connection = Connection::connection();

        try {
            $students = $connection->prepare("SELECT stu.id AS 'studentId', stu.first_name, stu.surname, usr.photo, usr.profile_link, 
                                            module.name AS 'module', course.name AS 'course', school.name AS 'school' 
                                            FROM students stu
                                            
                                            INNER JOIN users usr
                                            ON usr.id = stu.user_id
                                            INNER JOIN modules module
                                            ON module.id = stu.module_id
                                            INNER JOIN courses course
                                            ON course.id = stu.course_id
                                            INNER JOIN schoolshasstudents ss
                                            ON ss.student_id = stu.id
                                            INNER JOIN schools school
                                            ON school.id = ss.school_id
                                                                                            
                                            WHERE stu.first_name LIKE '%$search%' 
                                            OR stu.surname LIKE '%$search%' 
                                            AND usr.is_blocked NOT IN(1)
                                            ORDER BY stu.first_name
                                        ");

            $students->execute();

            $studentsProfiles = $students->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        try {
            $schools = $connection->prepare("SELECT name AS 'schoolName', photo AS 'photoSchool', address, id AS 'schoolId',
                                            link_school FROM schools
                                                                                            
                                            WHERE name LIKE '%$search%' 
                                            AND have_account NOT IN('Sem conta')
                                            ORDER BY name
                                        ");

            $schools->execute();


            $schoolsProfiles = $schools->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return $this->buildProfilesSearchList($studentsProfiles, $schoolsProfiles);
    }

    private function buildProfilesSearchList($students, $schools)
    {
        $studentsArray = [];
        $schoolsArray = [];

        for ($i = 0; $i < count($students); $i++) {
            $row = $students[$i];
            $studentsProfiles = $this->buildProfileList($row);

            array_push($studentsArray, $studentsProfiles);
        }

        for ($i = 0; $i < count($schools); $i++) {
            $row = $schools[$i];
            $schoolsProfiles = $this->buildProfileList($row);

            array_push($schoolsArray, $schoolsProfiles);
        }

        $compare = array_merge($studentsArray, $schoolsArray);
        $result = array_unique($compare, SORT_REGULAR);

        return $result;
    }

    private function buildProfileList($row)
    {
        $search = new Search();
        $search->studentID = Search::isPropertyExist('studentId', $row, 0);
        $search->firstName = Search::isPropertyExist('first_name', $row, "");
        $search->surname = Search::isPropertyExist('surname', $row, "");
        $search->photoStudent = Search::isPropertyExist('photo', $row, "");
        $search->linkStudent = Search::isPropertyExist('profile_link', $row, "");
        $search->module = Search::isPropertyExist('module', $row, "");
        $search->course = Search::isPropertyExist('course', $row, "");
        $search->school = Search::isPropertyExist('school', $row, "");
        $search->schoolID = Search::isPropertyExist('schoolId', $row, 0);
        $search->schoolName = Search::isPropertyExist('schoolName', $row, "");
        $search->schoolPhoto = Search::isPropertyExist('photoSchool', $row, "");
        $search->schoolLink = Search::isPropertyExist('link_school', $row, "");
        $search->address = Search::isPropertyExist('address', $row, "");

        return $search;
    }

    private static function isPropertyExist($name, $row, $value)
    {
        return array_key_exists($name, $row) ? $row[$name] : $value;
    }

    public function searchMaterials(string $search)
    {
        $connection = Connection::connection();

        try {
            $question = $connection->prepare("SELECT quest.id, quest.link_question, quest.question, quest.created_at,
                                                 course.name AS 'course', cate.name AS 'category', subj.name AS 'subject' 
                                                 FROM questions quest

                                                 INNER JOIN courses course
                                                 ON quest.course_id = course.id
                                                 INNER JOIN categories cate
                                                 ON quest.category_id = cate.id
                                                 INNER JOIN subjects subj
                                                 ON quest.subject_id = subj.id
                                                
                                                 WHERE quest.question LIKE '%$search%' 
                                                 AND cate.name IN('Apoio')
                                                 AND quest.is_blocked NOT IN(1)
                                                 ORDER BY quest.created_at DESC
                                        ");

            $question->execute();

            $listQuestion = $question->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        try {
            $answer = $connection->prepare("SELECT quest.id, quest.link_question, quest.question, quest.created_at,
                                                 course.name AS 'course', cate.name AS 'category', subj.name AS 'subject', 
                                                 answ.answer FROM questions quest

                                                 INNER JOIN courses course
                                                 ON quest.course_id = course.id
                                                 INNER JOIN categories cate
                                                 ON quest.category_id = cate.id
                                                 INNER JOIN subjects subj
                                                 ON quest.subject_id = subj.id
                                                 INNER JOIN answers answ
                                                 ON answ.question_id = quest.id
                                                
                                                 WHERE answ.answer LIKE '%$search%' 
                                                 AND cate.name IN('Apoio')
                                                 AND quest.is_blocked NOT IN(1)
                                                 ORDER BY quest.created_at DESC
                                        ");

            $answer->execute();

            $listAnswer = $answer->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return $this->buildMaterialsSearchList($listQuestion, $listAnswer);
    }

    private function buildMaterialsSearchList($question, $answer)
    {
        $questionsArray = [];
        $answersArray = [];

        for ($i = 0; $i < count($question); $i++) {
            $row = $question[$i];
            $questionsList = $this->buildMaterials($row);

            array_push($questionsArray, $questionsList);
        }

        for ($i = 0; $i < count($answer); $i++) {
            $row = $answer[$i];
            $answersList = $this->buildMaterials($row);

            array_push($answersArray, $answersList);
        }

        $compare = array_merge($answersArray, $questionsArray);
        $result = array_unique($compare, SORT_REGULAR);

        return $result;
    }

    private function buildMaterials($row)
    {
        $question = new Question();
        $question->questionId = $row['id'];
        $question->linkQuestion = $row['link_question'];
        $question->question = $row['question'];
        $question->course = $row['course'];
        $question->category = $row['category'];
        $question->subject = $row['subject'];
        $question->created = Answer::countCreatedAnswer($row['created_at']);

        return $question;
    }
}
