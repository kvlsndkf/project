<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/questions/Question.class.php');

class Following
{
    public function listFeedFollowing($followerID)
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
                                            INNER JOIN usershasfollowers uf
                                            ON stu.user_id = uf.following_id
                                            WHERE uf.follower_id = $followerID
                                            AND quest.is_blocked NOT IN(1)
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
}