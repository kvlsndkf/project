<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');

class Ranking
{
    public function colocationTotal()
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT stu.id, stu.first_name, stu.xp, usr.profile_link, usr.photo FROM students stu
                                            
                                            INNER JOIN users usr
                                            ON stu.user_id = usr.id
                                            ORDER BY stu.xp DESC
                                            LIMIT 5 
                                        ");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildRankingList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function buildRankingList($result)
    {
        $colocation = [];

        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            $total = $this->buildRanking($row);

            array_push($colocation, $total);
        }

        return $colocation;
    }

    private function buildRanking($row)
    {
        $ranking = new Ranking();
        $ranking->id = $row['id'];
        $ranking->name = $row['first_name'];
        $ranking->xp = $row['xp'];
        $ranking->photo = $row['photo'];
        $ranking->linkProfile = $row['profile_link'];

        return $ranking;
    }

    public function colocationTotalAll($studentID)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT stu.id FROM students stu
                                            
                                            INNER JOIN users usr
                                            ON stu.user_id = usr.id
                                            ORDER BY stu.xp DESC
                                        ");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildRankingListAll($result, $studentID);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    private function buildRankingListAll($result, $studentID)
    {
        $j = 1;
        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];

            if ($row['id'] == $studentID) {
                break;
            }

            $j++;
        }

        return $j;
    }

    public function colocationFllowers($idStudent)
    {
        $connection = Connection::connection();

        try {
            $followers = $connection->prepare("SELECT stu.id, stu.first_name, stu.xp, usr.profile_link, usr.photo FROM students stu
                                            
                                            INNER JOIN users usr
                                            ON stu.user_id = usr.id
                                            INNER JOIN usershasfollowers uf
                                            ON stu.user_id = uf.following_id
                                            WHERE uf.follower_id = $idStudent
                                            ORDER BY stu.xp DESC
                                            LIMIT 5
                                        ");
            $followers->execute();
            $resultFollowers = $followers->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        try {
            $student = $connection->prepare("SELECT stu.id, stu.first_name, stu.xp, usr.profile_link, usr.photo FROM students stu
                                            
                                            INNER JOIN users usr
                                            ON stu.user_id = usr.id
                                            WHERE stu.user_id = $idStudent
                                        ");
            $student->execute();
            $resultStudent = $student->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return $this->buildFollowersAllList($resultFollowers, $resultStudent);
    }


    private function buildFollowersAllList($resultFollowers, $resultStudent)
    {
        function comparator($object1, $object2)
        {
            return $object1['xp'] < $object2['xp'];
        }

        $compare = array_merge($resultFollowers, $resultStudent);

        usort($compare, 'comparator');

        return array_splice($compare, 0, 5);
    }

    public function colocationFllowersAll($idStudent)
    {
        $connection = Connection::connection();

        try {
            $followers = $connection->prepare("SELECT stu.id, stu.xp, stu.user_id FROM students stu
                                            
                                            INNER JOIN users usr
                                            ON stu.user_id = usr.id
                                            INNER JOIN usershasfollowers uf
                                            ON stu.user_id = uf.following_id
                                            WHERE uf.follower_id = $idStudent
                                        ");
            $followers->execute();
            $resultFollowers = $followers->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        try {
            $student = $connection->prepare("SELECT stu.id, stu.xp, stu.user_id FROM students stu
                                            
                                            INNER JOIN users usr
                                            ON stu.user_id = usr.id
                                            WHERE stu.user_id = $idStudent
                                        ");
            $student->execute();
            $resultStudent = $student->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return $this->buildFollowers($resultFollowers, $resultStudent, $idStudent);
    }

    private function buildFollowers($resultFollowers, $resultStudent, $studentID)
    {
        function comparator1($object1, $object2)
        {
            return $object1['xp'] < $object2['xp'];
        }

        $compare = array_merge($resultFollowers, $resultStudent);

        usort($compare, 'comparator1');
        
        $j = 1;
        for ($i = 0; $i < count($compare); $i++) {
            $row = $compare[$i];

            
            if ($row['user_id'] == $studentID) {
                break;
            }
            
            $j++;
        }
        return $j;

    }
}
