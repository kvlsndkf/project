<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');

class Dashboard
{
    public function countDenunciations()
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT COUNT(id) AS total FROM denunciations WHERE status = 'Nova'");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result[0]['total'];
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function countMessages()
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT COUNT(id) AS total FROM messages WHERE status = 'Nova'");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result[0]['total'];
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function countStudents()
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT COUNT(id) AS total FROM users 

                                            WHERE type_user = 'student'
                                            AND (is_blocked NOT IN(1) AND is_confirmed NOT IN(0))
                                        ");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result[0]['total'];
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function countAvaliations()
    {
        $connection = Connection::connection();

        try {
            $all = $connection->prepare("SELECT COUNT(id) AS total FROM answers 

                                            WHERE avg_avaliation > 1
                                        ");
            $all->execute();

            $result = $all->fetchAll(PDO::FETCH_ASSOC);

            $resultAll = $result[0]['total'];
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        try {
            $good = $connection->prepare("SELECT COUNT(id) AS total FROM answers 

                                            WHERE avg_avaliation >= 3
                                        ");
            $good->execute();

            $result = $good->fetchAll(PDO::FETCH_ASSOC);

            $resultGood = $result[0]['total'];
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        try {
            $bad = $connection->prepare("SELECT COUNT(id) AS total FROM answers 

                                            WHERE avg_avaliation < 3
                                        ");
            $bad->execute();

            $result = $bad->fetchAll(PDO::FETCH_ASSOC);
            $resultBad = $result[0]['total'];
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return $this->calculatePorcent($resultAll, $resultGood,$resultBad);
    }

    private function calculatePorcent($all, $good, $bad)
    {
        // $porcentGood = ($all * 100)/$good;
        // $porcentBad = ($all * 100)/$bad;

        $g = intval($good);
        $b = intval($bad);

        $result = array(
            array('0' => $g),
            array('1' => $b)
        );

        return $result;
    }

    public function countCoursesByStudents()
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare(" SELECT count(s.id) AS total, c.name, c.photo FROM students s 

                                            INNER JOIN courses c
                                            ON c.id = s.course_id
                                            
                                            GROUP BY c.name
                                            ORDER BY total DESC
                                            LIMIT 10
                                        ");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $this->buildCoursesList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
       
    }

    private function buildCoursesList($result)
    {
        $course = [];

        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            $total = $this->buildList($row);

            array_push($course, $total);
        }

        return $course;
    }

    private function buildList($row)
    {
        $dashboard = new Dashboard();
        $dashboard->name = $row['name'];
        $dashboard->photo = $row['photo'];

        return $dashboard;
    }
}
