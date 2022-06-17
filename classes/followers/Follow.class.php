<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/users/StudentMethods.class.php');

class Follow
{
    //attributes
    public int $id;
    public int $followerID;
    public int $followingID;
    public string $createdAt;
    public string $updatedAt;
    public int $studentId;
    public string $firstName;
    public string $surname;
    public int $userId;
    public int $courseId;
    public int $moduleId;
    public int $schoolId;
    public string $linkProfile;

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
    public function getFollowerId()
    {
        return $this->followerID;
    }
    public function setFollowerId($followerID)
    {
        $this->followerID = $followerID;
    }
    //----------------------------
    public function getFollowingId()
    {
        return $this->followingID;
    }
    public function setFollowingId($followingID)
    {
        $this->followingID = $followingID;
    }
    //----------------------------
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
    //methods

    public function registerFollow(Follow $follow, $idStudentPerfil)
    {
        $connection = Connection::connection();

        $followerID = $this->getFollowerId();
        $followingID = $this->getFollowingId();

        $checkFollowers = $this->checkFollower($followerID, $followingID);

        if ($checkFollowers == false) {
            try {
                $stmt = $connection->prepare("INSERT INTO usershasfollowers(follower_id, following_id, created_at)
                                             VALUES (?, ?, NOW())");

                $stmt->bindValue(1, $follow->getFollowerId());
                $stmt->bindValue(2, $follow->getFollowingId());

                $stmt->execute();
                header('Location: /project/private/student/pages/detail-perfil-student/detail-perfil-student.page.php?idStudent=' . $idStudentPerfil);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } else {
            try {
                $stmt = $connection->prepare("DELETE FROM usershasfollowers
                                               WHERE follower_id = $followerID
                                                AND following_id = $followingID
                                            ");

                $stmt->execute();
                return header('Location: /project/private/student/pages/detail-perfil-student/detail-perfil-student.page.php?idStudent=' . $idStudentPerfil);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }

    public function checkFollower(int $followerID, int $followingID)
    {
        $connection = Connection::connection();

        try {
            $checkFollowers = $connection->prepare("SELECT * FROM usershasfollowers
                                         WHERE follower_id = $followerID
                                         AND following_id = $followingID
                                         ");

            $checkFollowers->execute();

            return $checkFollowers->rowCount() > 0;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getFollowers(int $followingID)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT COUNT(id) AS total FROM usershasfollowers
                                          WHERE following_id = $followingID
                                        ");

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getFollowing(int $followerID)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT COUNT(id) AS total FROM usershasfollowers
                                          WHERE follower_id = $followerID
                                        ");

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function listFollowers(int $followingID)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT stu.id, stu.user_id, stu.first_name, stu.surname, course.name AS 'course', 
                                            module.name AS 'module', school.name AS 'school', usr.photo, usr.profile_link 
                                            FROM students stu

                                            INNER JOIN modules module
                                            ON module.id = stu.module_id
                                            INNER JOIN courses course
                                            ON course.id = stu.course_id
                                            INNER JOIN users usr
                                            ON stu.user_id = usr.id
                                            INNER JOIN schoolshasstudents ss
                                            ON ss.student_id = stu.id
                                            INNER JOIN schools school
                                            ON ss.school_id = school.id
                                            INNER JOIN usershasfollowers uf
                                            ON stu.user_id = uf.follower_id
                                            WHERE uf.following_id = $followingID
                                        ");

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildFollowersList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function buildFollowersList($result)
    {
        $followers = [];

        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            $follower = $this->buildFollowers($row);

            array_push($followers, $follower);
        }
        return $followers;
    }

    private function buildFollowers($row)
    {
        $follow = new Follow();
        $follow->studentId = $row['id'];
        $follow->userId = $row['user_id'];
        $follow->firstName = $row['first_name'];
        $follow->surname = $row['surname'];
        $follow->photo = $row['photo'];
        $follow->module = $row['module'];
        $follow->course = $row['course'];
        $follow->school = $row['school'];
        $follow->linkProfile = $row['profile_link'];

        return $follow;
    }

    public function listFollowing(int $followerID)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT stu.id, stu.user_id, stu.first_name, stu.surname, course.name AS 'course', 
                                            module.name AS 'module', school.name AS 'school', usr.photo, usr.profile_link 
                                            FROM students stu

                                            INNER JOIN modules module
                                            ON module.id = stu.module_id
                                            INNER JOIN courses course
                                            ON course.id = stu.course_id
                                            INNER JOIN users usr
                                            ON stu.user_id = usr.id
                                            INNER JOIN schoolshasstudents ss
                                            ON ss.student_id = stu.id
                                            INNER JOIN schools school
                                            ON ss.school_id = school.id
                                            INNER JOIN usershasfollowers uf
                                            ON stu.user_id = uf.following_id
                                            WHERE uf.follower_id = $followerID
                                        ");

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildFollowingList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function buildFollowingList($result)
    {
        $following = [];

        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            $follower = $this->buildFollowing($row);

            array_push($following, $follower);
        }
        return $following;
    }

    private function buildFollowing($row)
    {
        $follow = new Follow();
        $follow->studentId = $row['id'];
        $follow->userId = $row['user_id'];
        $follow->firstName = $row['first_name'];
        $follow->surname = $row['surname'];
        $follow->photo = $row['photo'];
        $follow->module = $row['module'];
        $follow->course = $row['course'];
        $follow->school = $row['school'];
        $follow->linkProfile = $row['profile_link'];

        return $follow;
    }

    public function unfollowing(Follow $follow, $perfilUser)
    {
        $connection = Connection::connection();

        $followerID = $this->getFollowerId();
        $followingID = $this->getFollowingId();

        $checkFollowers = $this->checkFollower($followerID, $followingID);

        if ($checkFollowers == false) {
            try {
                $stmt = $connection->prepare("INSERT INTO usershasfollowers(follower_id, following_id, created_at)
                                             VALUES (?, ?, NOW())");

                $stmt->bindValue(1, $follow->getFollowerId());
                $stmt->bindValue(2, $follow->getFollowingId());

                $stmt->execute();
                header('Location: /project/private/student/pages/detail-perfil-student/list-following-student.page.php?idFollowers=' . $perfilUser);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } else {
            try {
                $stmt = $connection->prepare("DELETE FROM usershasfollowers
                                               WHERE follower_id = $followerID
                                                AND following_id = $followingID
                                            ");

                $stmt->execute();
                return header('Location: /project/private/student/pages/detail-perfil-student/list-following-student.page.php?idFollowers=' . $perfilUser);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }

    public function unfollowers(Follow $follow, $perfilUser)
    {
        $connection = Connection::connection();

        $followerID = $this->getFollowerId();
        $followingID = $this->getFollowingId();

        $checkFollowers = $this->checkFollower($followerID, $followingID);

        if ($checkFollowers == false) {
            try {
                $stmt = $connection->prepare("INSERT INTO usershasfollowers(follower_id, following_id, created_at)
                                             VALUES (?, ?, NOW())");

                $stmt->bindValue(1, $follow->getFollowerId());
                $stmt->bindValue(2, $follow->getFollowingId());

                $stmt->execute();
                header('Location: /project/private/student/pages/detail-perfil-student/list-followers-student.page.php?idFollowers=' . $perfilUser);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } else {
            try {
                $stmt = $connection->prepare("DELETE FROM usershasfollowers
                                               WHERE follower_id = $followerID
                                                AND following_id = $followingID
                                            ");

                $stmt->execute();
                return header('Location: /project/private/student/pages/detail-perfil-student/list-followers-student.page.php?idFollowers=' . $perfilUser);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }
}
