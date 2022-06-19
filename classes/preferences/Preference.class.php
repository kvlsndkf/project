<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/questions/Question.class.php');

class Preference
{
    public static function getPreferencesUser($userID)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT course.id, course.name, course.photo FROM courses course
                                            
                                        INNER JOIN usershaspreferences up
                                        ON course.id = up.preference_id
                                        INNER JOIN users usr
                                        ON usr.id = up.user_id
                                        WHERE up.user_id = $userID
                                        ORDER BY course.name
                                        ");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return Preference::buildPreferencesList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private static function buildPreferencesList($result)
    {
        $preferences = [];

        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            $preference = Preference::buildPreferences($row);

            array_push($preferences, $preference);
        }

        return $preferences;
    }

    private static function buildPreferences($row)
    {
        $preference = new Preference();
        $preference->id = $row['id'];
        $preference->name = $row['name'];
        $preference->photo = $row['photo'];

        return $preference;
    }

    public function listPrefereces($preferenceID)
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
                                            WHERE quest.course_id = $preferenceID
                                            ORDER BY quest.created_at DESC
                                        ");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $question = new Question;

            return $question->buildQuestionList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getNamePreference($preferenceID)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT course.id, course.name, course.photo FROM courses course
                                            
                                        INNER JOIN usershaspreferences up
                                        ON course.id = up.preference_id
                                        WHERE course.id = $preferenceID
                                        ");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return Preference::buildPreferences($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
