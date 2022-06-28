<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');

class StudentController
{
    //getters and setters
    public function getReason()
    {
        return $this->reason;
    }
    public function setReason($reason)
    {
        $this->reason = $reason;
    }
    //----------------------------
    public function getResultBuildListActiveStudents()
    {
        return $this->resultBuildListActiveStudents;
    }
    public function setResultBuildListActiveStudents($resultBuildListActiveStudents)
    {
        $this->resultBuildListActiveStudents = $resultBuildListActiveStudents;
    }
    //----------------------------
    public function getResultBuildListBlockedStudents()
    {
        return $this->resultBuildListBlockedStudents;
    }
    public function setResultBuildListBlockedStudents($resultBuildListBlockedStudents)
    {
        $this->resultBuildListBlockedStudents = $resultBuildListBlockedStudents;
    }
    //----------------------------
    public function getResultBuildSearchList()
    {
        return $this->resultBuildSearchList;
    }
    public function setResultBuildSearchList($resultBuildSearchList)
    {
        $this->resultBuildSearchList = $resultBuildSearchList;
    }
    //----------------------------
    //methods
    public function ListActiveStudents()
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT stu.id, stu.user_id, stu.first_name, stu.surname, usr.photo, usr.type_user, usr.created_at,
                                            cour.name AS 'course', module.name AS 'module', school.name AS 'school', usr.blocked_at, 
                                            usr.is_blocked FROM students stu

                                        INNER JOIN users usr
                                        ON stu.user_id = usr.id
                                        INNER JOIN courses cour
                                        ON stu.course_id = cour.id
                                        INNER JOIN modules module
                                        ON stu.module_id = module.id
                                        INNER JOIN schoolshasstudents ss
                                        ON stu.id = ss.student_id
                                        INNER JOIN schools school
                                        ON ss.school_id = school.id
                                        WHERE usr.is_blocked = 0
                                    ");

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $this->setResultBuildListActiveStudents($result);
            return $this->buildStudentList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function countActiveStudents()
    {
        $resultBuildListActiveStudents = $this->getResultBuildListActiveStudents();

        $totalActives = count($resultBuildListActiveStudents);
        return "Total (" . $totalActives . ")";
    }

    private function buildStudentList($result)
    {
        $students = [];

        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            $student = $this->buildStudents($row);

            array_push($students, $student);
        }

        return $students;
    }

    private function buildStudents($row)
    {
        $student = new StudentController();
        $student->studentID = $row['id'];
        $student->userID = $row['user_id'];
        $student->firstName = $row['first_name'];
        $student->surname = $row['surname'];
        $student->photo = $row['photo'];
        $student->typeUser = $row['type_user'];
        $student->course = $row['course'];
        $student->module = $row['module'];
        $student->school = $row['school'];
        $student->isBlocked = $row['is_blocked'];
        $student->created = $row['created_at'] ?? '';
        $student->blocked = $row['blocked_at'] ?? '';
        $student->reason = $row['conclusion'] ?? '';

        return $student;
    }

    public function ListBlockedStudents()
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT stu.id, stu.user_id, stu.first_name, stu.surname, usr.photo, usr.type_user, 
                                            cour.name AS 'course', module.name AS 'module', school.name AS 'school', usr.blocked_at, usr.created_at,
                                            usr.is_blocked, de.conclusion FROM students stu

                                        INNER JOIN users usr
                                        ON stu.user_id = usr.id
                                        INNER JOIN courses cour
                                        ON stu.course_id = cour.id
                                        INNER JOIN modules module
                                        ON stu.module_id = module.id
                                        INNER JOIN schoolshasstudents ss
                                        ON stu.id = ss.student_id
                                        INNER JOIN schools school
                                        ON ss.school_id = school.id
                                        INNER JOIN denunciations de
                                        ON stu.user_id = de.denounced_id
                                        WHERE usr.is_blocked = 1
                                    ");

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $this->setResultBuildListBlockedStudents($result);
            return $this->buildStudentList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function countBlockedStudents()
    {
        $resultBuildListBlockedStudents = $this->getResultBuildListBlockedStudents();

        $totalBlocked = count($resultBuildListBlockedStudents);
        return "Total (" . $totalBlocked . ")";
    }

    public function blockUser($user, $userID)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("UPDATE users SET blocking_reason = ?, is_blocked = ?, blocked_at = NOW()

                                         WHERE id = $userID
                                         ");

            $stmt->bindValue(1, $user->getReason());
            $stmt->bindValue(2, true);

            $stmt->execute();

            $_SESSION['statusPositive'] = "Usuário bloqueado, movido para <strong>Bloqueados<strong>.";
            header('Location: /project/private/adm/pages/list-profiles/list-profiles.page.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function unlockUser($userID)
    {
        $connection = Connection::connection();


        try {
            $stmt = $connection->prepare("UPDATE users SET blocking_reason = ?, is_blocked = ?, blocked_at = ?

                                         WHERE id = $userID
                                         ");

            $stmt->bindValue(1, "");
            $stmt->bindValue(2, false);
            $stmt->bindValue(3, null);

            $stmt->execute();

            $_SESSION['statusPositive'] = "Usuário desbloqueado, movido para <strong>Ativos<strong>.";
            header('Location: /project/private/adm/pages/list-profiles/list-profiles.page.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function listSearchBarProfiles()
    {
        $connection = Connection::connection();

        try {
            $all = $connection->prepare("SELECT CONCAT(first_name, ' ', surname) AS 'name'
                                            FROM students
                                        ");
            $all->execute();
            $result = $all->fetchAll(PDO::FETCH_ASSOC);


            return $this->buildSearchList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function buildSearchList($result)
    {
        $students = [];

        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];

            $student = new StudentController();
            $student->name = $row['name'];


            array_push($students, $student);
        }

        return $students;
    }

    public function listSearchProfiles($search)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT stu.id, stu.user_id, stu.first_name, stu.surname, usr.photo, usr.type_user, 
                                            cour.name AS 'course', module.name AS 'module', school.name AS 'school', usr.blocked_at, usr.created_at,
                                            usr.is_blocked FROM students stu

                                        INNER JOIN users usr
                                        ON stu.user_id = usr.id
                                        INNER JOIN courses cour
                                        ON stu.course_id = cour.id
                                        INNER JOIN modules module
                                        ON stu.module_id = module.id
                                        INNER JOIN schoolshasstudents ss
                                        ON stu.id = ss.student_id
                                        INNER JOIN schools school
                                        ON ss.school_id = school.id
                                        WHERE (CONCAT(stu.first_name, ' ', stu.surname) LIKE '%$search%')
                                    ");

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $lines = $stmt->rowCount();

            if ($lines == 00) {
                $_SESSION['statusNegative'] = "Não existem registros.";
            }

            $this->setResultBuildSearchList($result);
            return $this->buildStudentList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function countSearchList()
    {
        $resultBuildList = $this->getResultBuildSearchList();

        $totalSearch = count($resultBuildList);
        return "Resultado da pesquisa (" . $totalSearch . ")";
    }
}
