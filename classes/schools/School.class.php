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
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    //----------------------------
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
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
    public function getHaveAccount()
    {
        return $this->haveAccount;
    }
    public function setHaveAccount($haveAccount)
    {
        if ($haveAccount == true) {
            $haveAccount = "Com conta";
        } else {
            $haveAccount = "Sem conta";
        }

        $this->haveAccount = $haveAccount;
    }
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
    public function registerSchool($school)
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
        }
    }

    /**
     * @method listTeacher() lists the teacher by 
     * @param string $search 
     */
    public function listSchool(string $search = '', string $filter = ''): array | false
    {
        $connection = Connection::connection();

        try {
            if (!empty($search)) {
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
     * @method buildTeacherList() organize the list of teachers by 
     * @param array $result 
     */
    private function buildSchoolList(array | false $result): array | false
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
            // $school->github = $row['github'];
            // $school->linkedin = $row['linkedin'];
            // $school->facebook = $row['facebook'];
            // $school->instagram = $row['instagram'];
            // $school->photo = $row['photo'];
            array_push($schools, $school);
        }

        $this->setResultBuildList($schools);
        return $schools;
    }

    //----------------------------
    /**
     * @method countTeachers() count the teachers by 
     * @param string $search 
     */
    public function countSchools(string $search = '', string $filter): string
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
     * @method searchTeacher() search teachers names by 
     * @param string $search 
     */
    private function searchSchool(string $search): array | false
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
     * @method deleteTeacher() delete the teacher by 
     * @param int $id 
     * @param string $path 
     */
    //this method delete the teacher by id.
    public function deleteSchool(int $id, string $path): void
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
     * @method updateTeacher() updates the teacher by 
     * @param Teacher $teacher 
     * @param int $id 
     */
    public function updateSchool(School $school, int $id): void
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("UPDATE teachers SET name = ?, address = ?, have_account = ?, about = ?, github = ?, linkedin = ?, facebook = ?, instagram = ?, photo = ?, updated_at = NOW()
                                         WHERE id = $id");

            $stmt->bindValue(1, $school->getName());
            $stmt->bindValue(2, $school->getAddress());
            $stmt->bindValue(3, $school->getHaveAccount());
            $stmt->bindValue(4, $school->getAbout());
            $stmt->bindValue(5, $school->getGithub());
            $stmt->bindValue(6, $school->getLinkedin());
            $stmt->bindValue(7, $school->getFacebook());
            $stmt->bindValue(8, $school->getInstagram());
            $stmt->bindValue(9, $school->getPhoto());

            $stmt->execute();

            $_SESSION['statusPositive'] = "Professor atualizado com sucesso.";
            header('Location: /project/private/adm/pages/register/register-teacher/list-teacher.page.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

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

    public function styleFilter($style)
    {
        $styleFilter = $style == "" ? 'btn btn-primary' : 'btn btn-outline-primary';
        $styleFilter = $style == "Comconta" ? 'btn btn-primary' : 'btn btn-outline-primary';
        $styleFilter = $style == "Semconta" ? 'btn btn-primary' : 'btn btn-outline-primary';

        return $styleFilter;
    }
}
