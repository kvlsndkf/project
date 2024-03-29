<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
class Teacher
{
    //attributes
    public int $id;
    public string $name;
    public string $photo;
    public string $createdAt;
    public string $updatedAt;
    public array $resultBuildList;
    public array $courses = [];
    public string $course = "";

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
    public function getPhoto(): string
    {
        return $this->photo;
    }
    public function setPhoto(string $photo): void
    {
        $this->photo = $photo;
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
    public function getResultBuildList(): array
    {
        return $this->resultBuildList;
    }
    public function setResultBuildList(array $resultBuildList): void
    {
        $this->resultBuildList = $resultBuildList;
    }
    //----------------------------
    //methods
    /**
     * @method registerTeacher() registers the teachers by 
     * @param Teacher $teacher 
     */
    public function registerTeacher(Teacher $teacher): void
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("INSERT INTO teachers(name, photo, created_at)
                                         VALUES (?, ?, NOW())");
            $stmt->bindValue(1, $teacher->getName());
            $stmt->bindValue(2, $teacher->getPhoto());

            $stmt->execute();

            $_SESSION['statusPositive'] = "Professor cadastrado com sucesso.";
            header('Location: /project/private/adm/pages/register/register-teacher/list-teacher.page.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method listTeacher() lists the teacher by 
     * @param string $search 
     */
    public function listTeacher(string $search = ''): array | false
    {
        $connection = Connection::connection();
        try {
            if (!is_null($search) && !empty($search)) {
                $result = $this->searchTeacher($search);
                return $this->buildTeacherList($result);
            }
            //Receber o numero de página
            $current_page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
            $page = (!empty($current_page)) ? $current_page : 1;

            //Setar a quantidade de registros por página
            $limit_result = 9;

            //Calcular o inicio da vizualização
            $start = ($limit_result * $page) - $limit_result;

            $stmt = $connection->prepare("SELECT * FROM teachers ORDER BY name LIMIT $start, $limit_result");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildTeacherList($result);
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
    public function deleteTeacher(int $id, string $path): void
    {
        $connection = Connection::connection();

        try {
            unlink("/xampp/htdocs" . $path);

            $stmt = $connection->prepare("DELETE FROM teachers WHERE id='$id'");

            $stmt->execute();

            $_SESSION['statusPositive'] = "Professor apagado com sucesso.";
            header('Location: /project/private/adm/pages/register/register-teacher/list-teacher.page.php');
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
    public function updateTeacher(Teacher $teacher, int $id): void
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("UPDATE teachers SET name = ?, photo = ?, updated_at = NOW()
                                         WHERE id = $id");
            $stmt->bindValue(1, $teacher->getName());
            $stmt->bindValue(2, $teacher->getPhoto());

            $stmt->execute();

            $_SESSION['statusPositive'] = "Professor atualizado com sucesso.";
            header('Location: /project/private/adm/pages/register/register-teacher/list-teacher.page.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method searchTeacher() search teachers names by 
     * @param string $search 
     */
    private function searchTeacher(string $search): array | false
    {
        $connection = Connection::connection();

        //Receber o numero de página
        $current_page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
        $page = (!empty($current_page)) ? $current_page : 1;

        //Setar a quantidade de registros por página
        $limit_result = 9;

        //Calcular o inicio da vizualização
        $start = ($limit_result * $page) - $limit_result;

        try {
            $stmt = $connection->prepare("SELECT * FROM teachers WHERE name LIKE '%$search%' ORDER BY name LIMIT $start,$limit_result");

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
     * @method buildTeacherList() organize the list of teachers by 
     * @param array $result 
     */
    private function buildTeacherList(array | false $result): array | false
    {
        $teachers = [];

        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            $teacher = new Teacher();
            $teacher->id = $row['id'];
            $teacher->name = $row['name'];
            $teacher->photo = $row['photo'];
            array_push($teachers, $teacher);
        }

        $this->setResultBuildList($teachers);
        return $teachers;
    }

    //----------------------------
    /**
     * @method countTeachers() count the teachers by 
     * @param string $search 
     */
    public function countTeachers(string $search = ''): string
    {   
        $connection = Connection::connection();
        
        $searching = (!is_null($search) && !empty($search));

        if ($searching) {
            $stmt = $connection->prepare("SELECT COUNT(id) AS resultado FROM teachers WHERE name LIKE '%$search%'");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return "Resultado da pesquisa " . $result[0]['resultado'];
        }

        
        try {
            $stmt = $connection->prepare("SELECT COUNT(id) AS total FROM teachers");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return "Total " . $result[0]['total'];
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    //----------------------------
    public function listTeachersOfSelectResgisterSchool()
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT id, name, photo FROM teachers");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $this->buildTeacherList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
