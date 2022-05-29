<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/inheritances/User.class.php');

class Student extends User
{
    //attributes
    public int $id;
    public string $firstName;
    public string $surname;
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

    public function registerStudent(Student $student)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("INSERT INTO users(email, password, photo, type_user, github, linkedin, facebook, instagram, created_at)
                                             VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
            $stmt->bindValue(1, $student->getEmail());
            $stmt->bindValue(2, $student->getPassword());
            $stmt->bindValue(3, $student->getPhoto());
            $stmt->bindValue(4, $student->getTypeUser());
            $stmt->bindValue(5, $student->getGithub());
            $stmt->bindValue(6, $student->getLinkedin());
            $stmt->bindValue(7, $student->getFacebook());
            $stmt->bindValue(8, $student->getInstagram());


            $stmt->execute();

            $idUser = $connection->lastInsertId();
            $this->setId($idUser);
            $connection->commit();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        try {
            $idUser = $this->getId();
            $preferences = $this->getPreferences();

            for ($i = 0; $i < count($preferences); $i++) {
                if (!empty($idUser)) {
                    $stmt = $connection->prepare("INSERT INTO usershaspreferences(created_at, user_id, preference_id)
                                                    VALUES (NOW(), ?, ?)");

                    $stmt->bindValue(1, $idUser);
                    $stmt->bindValue(2, $preferences[$i]);

                    $stmt->execute();
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        try {
            if (!empty($idUser)) {
                $stmt = $connection->prepare("INSERT INTO students(first_name, surname, created_at, user_id, course_id, module_id)
                                                VALUES (?, ?, NOW(), ?, ?, ?)");

                $stmt->bindValue(1, $student->getFirstName());
                $stmt->bindValue(2, $student->getSurname());
                $stmt->bindValue(3, $idUser);
                $stmt->bindValue(4, $student->getCourseId());
                $stmt->bindValue(5, $student->getModuleId());

                $stmt->execute();

                $idStudent = $connection->lastInsertId();
                $this->setId($idStudent);
                $connection->commit();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        try {
            $idStudent = $this->getId();

            if (!empty($idStudent)) {
                $stmt = $connection->prepare("INSERT INTO schoolshasstudents(created_at, student_id, school_id)
                                                VALUES (NOW(), ?, ?)");

                $stmt->bindValue(1, $idStudent);
                $stmt->bindValue(2, $student->getSchoolId());

                $stmt->execute();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}