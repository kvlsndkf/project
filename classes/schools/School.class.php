<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/inheritances/Social.class.php');

class School extends Social
{
    //attributes
    public int $id;
    public string $name;
    public string $address;
    public string $haveAccount;
    public string $photo = "";
    public string $about = "";
    public string $createdAt;
    public string $updatedAt;
    public array $teacher = [];
    public string $inSpCity = "";
    public string $notInSpCity = "";

    //getters and setters
    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    //----------------------------
    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    //----------------------------
    public function getAddress()
    {
        return $this->address;
    }
    public function setAddress($address)
    {
        $this->address = $address;
    }
    //----------------------------
    public function getAbout(): string
    {
        return $this->about;
    }
    public function setAbout(string $about): void
    {
        $this->about = $about;
    }
    //----------------------------
    public function getPhoto(): string
    {
        return $this->photo;
    }
    public function setPhoto(string $photo): void
    {
        $this->photo = $photo;
    }
    //----------------------------
    public function getHaveAccount(): string
    {
        return $this->haveAccount;
    }
    public function setHaveAccount(string $haveAccount): void
    {
        if ($haveAccount == true) {
            $haveAccount = "Com conta";
        } else {
            $haveAccount = "Sem conta";
        }

        $this->haveAccount = $haveAccount;
    }
    //----------------------------
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
    //----------------------------
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }
    public function setUpdatedAt(string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
    //----------------------------
    public function getTeacher()
    {
        return $this->teacher;
    }
    public function setTeacher($teacher)
    {
        $this->teacher = $teacher;
    }
    //----------------------------
    public function getResultBuildList(): array
    {
        return $this->resultBuildList;
    }
    public function setResultBuildList(array $resultBuildList): void
    {
        $this->resultBuildList = $resultBuildList;
    }
    //----------------------------
    public function getInSpCity(): string
    {
        return $this->inSpCity;
    }
    public function setInSpCity(string $inSpCity): void
    {
        $this->inSpCity = $inSpCity;
    }
    //----------------------------
    public function getNotInSpCity(): string
    {
        return $this->notInSpCity;
    }
    public function setNotInSpCity(string $notInSpCity): void
    {
        $this->notInSpCity = $notInSpCity;
    }
    //----------------------------
    //methods

    /**
     * @method registerSchool() register the school by 
     * @param School $school 
     */
    public function registerSchool(School $school)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("INSERT INTO schools(name, address, have_account, in_sp_city, not_in_sp_city, about, github, linkedin, facebook, instagram, photo, created_at)
                                         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");

            $stmt->bindValue(1, $school->getName());
            $stmt->bindValue(2, $school->getAddress());
            $stmt->bindValue(3, $school->getHaveAccount());
            $stmt->bindValue(4, $school->getInSpCity());
            $stmt->bindValue(5, $school->getNotInSpCity());
            $stmt->bindValue(6, $school->getAbout());
            $stmt->bindValue(7, $school->getGithub());
            $stmt->bindValue(8, $school->getLinkedin());
            $stmt->bindValue(9, $school->getFacebook());
            $stmt->bindValue(10, $school->getInstagram());
            $stmt->bindValue(11, $school->getPhoto());

            $stmt->execute();
            $idSchool = $connection->lastInsertId();
            $this->setId($idSchool);
            $connection->commit();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        try {
            $teacher = $this->getTeacher();
            $idSchool = $this->getId();

            for ($i = 0; $i < count($teacher); $i++) {
                if (!empty($idSchool)) {
                    $stmt = $connection->prepare("INSERT INTO schoolsHasTeachers(created_at, school_id, teacher_id)
                                                VALUES (NOW(), ?, ?)");

                    $stmt->bindValue(1, $idSchool);
                    $stmt->bindValue(2, $teacher[$i]);

                    $stmt->execute();
                }
            }

            $_SESSION['statusPositive'] = "Etec cadastrada com sucesso.";
            header('Location: /project/private/adm/pages/register/register-school/list-school.page.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @method listSchool() lists the schools by 
     * @param string $search 
     */
    public function listSchool(string $search = '', string $filter = ''): array | false
    {
        $connection = Connection::connection();

        try {
            if (!is_null($search) && !empty($search)) {
                $result = $this->searchSchool($search);
                return $this->buildSchoolList($result);
            }

            if (!empty($filter)) {
                $result = $this->filterSchool($filter);
                return $this->buildSchoolList($result);
            }

            $stmt = $connection->prepare("SELECT * FROM schools ORDER BY name");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildSchoolList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method listSchoolOfSearchBar() list schools for search bar  
     */
    public function listSchoolOfSearchBar()
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT * FROM schools ORDER BY name");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildSchoolList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method buildSchoolList() organize the list of teachers by 
     * @param array $result 
     */
    private function buildSchoolList(array | false $result)
    {
        $schools = [];

        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            $school = new School();
            $school->id = $row['id'];
            $school->name = $row['name'];
            $school->address = $row['address'];
            $school->haveAccount = $row['have_account'];
            $school->about = $row['about'];
            array_push($schools, $school);
        }

        $this->setResultBuildList($schools);
        return $schools;
    }

    //----------------------------
    /**
     * @method listSchoolForModal() list the school inside the modal by 
     * @param int $id 
     */
    public function listSchoolForModal(int $id)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT * FROM schools WHERE id='$id'");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildSchoolListForModal($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method buildSchoolListForModal() organize the list of schools inside the modal by 
     * @param array $result 
     */
    private function buildSchoolListForModal(array | false $result)
    {
        $schools = [];

        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            $school = new School();
            $school->id = $row['id'];
            $school->name = $row['name'];
            $school->address = $row['address'];
            $school->haveAccount = $row['have_account'];
            $school->about = $row['about'];
            $school->github = $row['github'];
            $school->linkedin = $row['linkedin'];
            $school->facebook = $row['facebook'];
            $school->instagram = $row['instagram'];
            $school->photo = $row['photo'];
            array_push($schools, $school);
        }

        return $schools;
    }

    //----------------------------
    /**
     * @method countSchools() count the teachers by 
     * @param string $search 
     */
    public function countSchools(string $search = '', string $filter)
    {
        $searching = (!is_null($search) && !empty($search));
        $filtering = (!is_null($filter) && !empty($filter));

        if ($searching) {
            $resultBuildList = $this->getResultBuildList();
            $totalSearch = count($resultBuildList);
            return "Resultado da pesquisa " . $totalSearch;
        }

        if ($filtering) {
            $resultBuildList = $this->getResultBuildList();
            $totalFilter = count($resultBuildList);
            return "Filtrado " . $totalFilter;
        }

        $connection = Connection::connection();
        try {
            $stmt = $connection->prepare("SELECT COUNT(id) AS total FROM schools");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return "Total " . $result[0]['total'];
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method searchSchool() search schools by 
     * @param string $search 
     */
    private function searchSchool(string $search)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT * FROM schools WHERE name LIKE '%$search%' ORDER BY name");

            $stmt->execute();

            $lines = $stmt->rowCount();

            if ($lines == 00) {
                $_SESSION['statusNegative'] = "Não existe registros.";
            }

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method countTeachersInSchool() counts the teachers to appear inside the card chips by 
     * @param int $id 
     */
    public function countTeachersInSchool(int $id)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT COUNT(teacher_id) AS total FROM schoolsHasTeachers WHERE school_id='$id'");

            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result[0]['total'];
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method deleteSchool() delete the school by 
     * @param int $id 
     * @param string $path 
     */
    public function deleteSchool(int $id, string $path)
    {
        $connection = Connection::connection();

        try {
            unlink("/xampp/htdocs" . $path);

            $stmt = $connection->prepare("DELETE FROM schools WHERE id='$id'");

            $stmt->execute();

            $_SESSION['statusPositive'] = "Etec apagada com sucesso.";
            header('Location: /project/private/adm/pages/register/register-school/list-school.page.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method updateSchool() updates the school by 
     * @param School $school 
     * @param int $id 
     */
    public function updateSchool(School $school, int $id)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("UPDATE schools SET name = ?, address = ?, have_account = ?, in_sp_city = ?, not_in_sp_city = ?, about = ?, github = ?, linkedin = ?, facebook = ?, instagram = ?, photo = ?, updated_at = NOW()
                                         WHERE id = $id");

            $stmt->bindValue(1, $school->getName());
            $stmt->bindValue(2, $school->getAddress());
            $stmt->bindValue(3, $school->getHaveAccount());
            $stmt->bindValue(4, $school->getInSpCity());
            $stmt->bindValue(5, $school->getNotInSpCity());
            $stmt->bindValue(6, $school->getAbout());
            $stmt->bindValue(7, $school->getGithub());
            $stmt->bindValue(8, $school->getLinkedin());
            $stmt->bindValue(9, $school->getFacebook());
            $stmt->bindValue(10, $school->getInstagram());
            $stmt->bindValue(11, $school->getPhoto());

            $stmt->execute();

            if (!$school->getHaveAccount()) {
                $_SESSION['statusPositive'] = "Etec atualizada com sucesso.";
                header('Location: /project/private/adm/pages/register/register-school/list-school.page.php');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        try {
            $teachers = $this->getTeacher();

            $schoolHasTeachersQuery = $connection->prepare(
                "SELECT st.teacher_id FROM schoolsHasTeachers st
                 LEFT JOIN teachers t
                 ON st.teacher_id = t.id
                 WHERE school_id = $id"
            );

            $schoolHasTeachersQuery->execute();

            $fetchTeachers = $schoolHasTeachersQuery->fetchAll(PDO::FETCH_ASSOC);

            $arrayQuery = array_map(function ($item) {
                return $item['teacher_id'];
            }, $fetchTeachers);

            $arrayToDelete = array_diff($arrayQuery, $teachers);
            $arrayToInsert = array_diff($teachers, $arrayQuery);

            if (count($arrayToDelete) > 0) {
                $idTeacherToDelete = [];

                foreach ($arrayToDelete as $row => $value) {
                    array_push($idTeacherToDelete, $value);
                }

                $deleteTeacher = $connection->prepare("DELETE FROM schoolsHasTeachers WHERE teacher_id IN (" . implode(', ', $idTeacherToDelete) . ") AND school_id='$id'");
                $deleteTeacher->execute();
            }

            if (count($arrayToInsert) > 0) {
                $queryValues = [];
                $idTeacherToInsert = [];

                for ($i = 0; $i < count($arrayToInsert); $i++) {
                    $item = $arrayToInsert[$i];

                    if ($item) {
                        array_push($queryValues, '(NOW(), ?, ?)');
                        array_push($idTeacherToInsert, $item);
                    }
                }

                $insertTeacher = $connection->prepare(
                    "INSERT INTO schoolsHasTeachers(created_at, school_id, teacher_id) 
                        VALUES " . implode(', ', $queryValues)
                );

                $idSchoolPosition = 1;
                $idTeacherPosition = 2;

                for ($i = 0; $i < count($arrayToInsert); $i++) {
                    $insertTeacher->bindValue($idSchoolPosition, $id);
                    $insertTeacher->bindValue($idTeacherPosition, $idTeacherToInsert[$i]);

                    $idSchoolPosition += 2;
                    $idTeacherPosition += 2;
                }

                $insertTeacher->execute();
            }

            $_SESSION['statusPositive'] = "Etec atualizada com sucesso.";
            header('Location: /project/private/adm/pages/register/register-school/list-school.page.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method filterSchool() filter the schools by 
     * @param string $filter 
     */
    private function filterSchool(string $filter)
    {
        $connection = Connection::connection();

        if ($filter == "Comconta") {

            $stmt = $connection->prepare("SELECT * FROM schools WHERE have_account = 'Com conta' ORDER BY name");
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        if ($filter == "Semconta") {
            $stmt = $connection->prepare("SELECT * FROM schools WHERE have_account = 'Sem conta' ORDER BY name");
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    //----------------------------
    /**
     * @method searchSchoolForUpdate() looks for the school data for the update, they appear inside the input by 
     * @param int $id 
     */
    public function searchSchoolForUpdate(int $id): array
    {

        $connection = Connection::connection();

        $stmt = $connection->prepare("SELECT * FROM schools WHERE id = $id");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    //----------------------------
    /**
     * @method selectTeachersUsedBySchool() selects the teachers being used by the school by 
     * @param int $id 
     */
    public function selectTeachersUsedBySchool(int $id): array
    {
        $connection = Connection::connection();

        $stmt = $connection->prepare("SELECT t.id, t.name, t.photo FROM schoolshasteachers st
                                         INNER JOIN teachers t
                                         ON t.id = st.teacher_id
                                         WHERE st.school_id = $id
                                     ");

        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    //----------------------------
    /**
     * @method selectAvailableTeachersForSchool() selects teachers that are not being used by the school by 
     * @param int $idSchool
     */
    public function selectAvailableTeachersForSchool(int $idSchool): array
    {
        $connection = Connection::connection();

        $stmt = $connection->prepare("SELECT DISTINCT t.id, t.name FROM teachers t
                                        WHERE t.id 
                                        NOT IN ( 
                                        SELECT t.id FROM schoolshasteachers st
                                        INNER JOIN teachers t
                                        ON t.id = st.teacher_id
                                        WHERE st.school_id = $idSchool)
                                        ");

        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    //----------------------------
    public function listSchoolsOfSelectResgisterCourse()
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT id, name FROM schools
                                            WHERE have_account = 'Com conta'");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $this->buildSchoolListSelect($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method buildSchoolList() organize the list of teachers by 
     * @param array $result 
     */
    private function buildSchoolListSelect(array | false $result)
    {
        $schools = [];

        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            $school = new School();
            $school->id = $row['id'];
            $school->name = $row['name'];
            array_push($schools, $school);
        }

        $this->setResultBuildList($schools);
        return $schools;
    }


    public function schoolsHasCourses()
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT DISTINCT s.id, s.name FROM schools s
                                                INNER JOIN schoolsHasCourses sc
                                                ON s.id = sc.school_id
                                        ");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $this->buildSchoolListSelect($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
