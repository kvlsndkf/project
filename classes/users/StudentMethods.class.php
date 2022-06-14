<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');

class StudentMethods
{
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

    public function getUserByStudentID(int $id)
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
}
