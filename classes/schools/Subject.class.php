<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');

class Subject
{
    //attributes
    public int $id;
    public string $name;
    public string $createdAt;
    public string $updatedAt;

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
     * @method registerSubject() registers the subjects by 
     * @param Subject $subject 
     */
    public function registerSubject(Subject $subject): void
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("INSERT INTO subjects(name, created_at)
                                         VALUES (?, NOW())");
            $stmt->bindValue(1, $subject->getName());

            $stmt->execute();

            $_SESSION['statusPositive'] = "Matéria cadastrada com sucesso.";
            header('Location: /project/private/adm/pages/register/register-subject/list-subject.page.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method searchSubjectForUpdate() looks for the subject data for the update, they appear inside the input by 
     * @param int $id 
     */
    public function searchSubjectForUpdate(int $id): array
    {

        $connection = Connection::connection();

        $stmt = $connection->prepare("SELECT * FROM subjects WHERE id = $id");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * @method listSubject() lists the subjects by 
     * @param string $search 
     */
    public function listSubject(string $search = ''): array | false
    {
        $connection = Connection::connection();

        try {
            if (!is_null($search) && !empty($search)) {
                $result = $this->searchSubject($search);
                return $this->buildSubjectList($result);
            }
            //Receber o numero de página
            $current_page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
            $page = (!empty($current_page)) ? $current_page : 1;

            //Setar a quantidade de registros por página
            $limit_result = 9;

            //Calcular o inicio da vizualização
            $start = ($limit_result * $page) - $limit_result;

            $stmt = $connection->prepare("SELECT * FROM subjects ORDER BY name LIMIT $start, $limit_result");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildSubjectList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method buildSubjectList() organize the list of subjects by 
     * @param array $result 
     */
    private function buildSubjectList(array | false $result)
    {
        $subjects = [];

        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            $subject = new Subject();
            $subject->id = $row['id'];
            $subject->name = $row['name'];

            array_push($subjects, $subject);
        }

        $this->setResultBuildList($subjects);
        return $subjects;
    }

    //----------------------------
    /**
     * @method updateSubject() updates the subjects by 
     * @param Subject $subject 
     * @param int $id 
     */
    public function updateSubject(Subject $subject, int $id): void
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("UPDATE subjects SET name = ?, updated_at = NOW()
                                         WHERE id = $id");
            $stmt->bindValue(1, $subject->getName());

            $stmt->execute();

            $_SESSION['statusPositive'] = "Matéria atualizada com sucesso.";
            header('Location: /project/private/adm/pages/register/register-subject/list-subject.page.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method deleteSubject() delete the subject by 
     * @param int $id 
     */
    public function deleteSubject(int $id): void
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("DELETE FROM subjects WHERE id='$id'");

            $stmt->execute();

            $_SESSION['statusPositive'] = "Matéria apagada com sucesso.";
            header('Location: /project/private/adm/pages/register/register-subject/list-subject.page.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method searchSubject() search subjects names by 
     * @param string $search 
     */
    private function searchSubject(string $search): array | false
    {
        $connection = Connection::connection();

        try {
            //Receber o numero de página
            $current_page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
            $page = (!empty($current_page)) ? $current_page : 1;

            //Setar a quantidade de registros por página
            $limit_result = 9;

            //Calcular o inicio da vizualização
            $start = ($limit_result * $page) - $limit_result;

            $stmt = $connection->prepare("SELECT * FROM subjects WHERE name LIKE '%$search%' ORDER BY name LIMIT $start, $limit_result");

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
     * @method countSubjects() count the subjects by 
     * @param string $search 
     */
    public function countSubjects(string $search = ''): string
    {
        $connection = Connection::connection();

        $searching = (!is_null($search) && !empty($search));

        if ($searching) {
            $stmt = $connection->prepare("SELECT COUNT(id) AS total FROM subjects WHERE name LIKE '%$search%'");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return "Resultado da Pesquisa " . $result[0]['total'];
        }


        try {
            $stmt = $connection->prepare("SELECT COUNT(id) AS total FROM subjects");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return "Total " . $result[0]['total'];
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method listSubjectsOfSearchBar() list subjects for search bar  
     */
    public function listSubjectsOfSearchBar()
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT * FROM subjects ORDER BY name ");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildSubjectList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method batchRegistrationSubjects() register several subjects through a spreadsheet by 
     * @param $file
     */
    public function batchRegistrationSubjects($file)
    {
        $connection = Connection::connection();

        $file = new DOMDocument;
        $file->load($_FILES['subject-table-file']['tmp_name']);

        $rows = $file->getElementsByTagName("Row");

        $firstRow = true;

        foreach ($rows as $row) {
            if (!$firstRow) {
                $nameSubject = $row->getElementsByTagName("Data")->item(0)->nodeValue;

                try {
                    $stmt = $connection->prepare("INSERT INTO subjects(name)
                                                VALUES (?)");
                    $stmt->bindValue(1, $nameSubject);
                    $stmt->execute();
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
            $firstRow = false;
        }

        $_SESSION['statusPositive'] = "Cadastro em lote feito com sucesso.";
        header('Location: /project/private/adm/pages/register/register-subject/list-subject.page.php');
    }

    //----------------------------
    public function listSubjectsOfSelectResgisterCourse()
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT id, name FROM subjects");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $this->buildSubjectsListSelect($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method buildSchoolList() organize the list of teachers by 
     * @param array $result 
     */
    private function buildSubjectsListSelect(array | false $result)
    {
        $subjects = [];

        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            $subject = new Subject();
            $subject->id = $row['id'];
            $subject->name = $row['name'];
            array_push($subjects, $subject);
        }

        return $subjects;
    }

    //----------------------------
    /**
     * @method paginationSubjects() paginate list of subjects
     */
    public function paginationSubjects()
    {
        $connection = Connection::connection();

        //Receber o numero de página
        $current_page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
        $page = (!empty($current_page)) ? $current_page : 1;

        //Setar a quantidade de registros por página
        $limit_result = 9;


        //Contar a quantidade de registros no bd 
        $query_qnt_register = "SELECT COUNT(id) AS 'id' FROM subjects";
        $result_qnt_register = $connection->prepare($query_qnt_register);
        $result_qnt_register->execute();
        $row_qnt_register = $result_qnt_register->fetch(PDO::FETCH_ASSOC);

        //Quantidade de páginas
        $page_qnt = ceil($row_qnt_register['id'] / $limit_result);

        $prev_page = $page - 1;

        $next_page = $page + 1;

        echo "<ul class='pagination'>";

        //botão para voltar
        if ($prev_page != 0) {
            echo "<li class='page-item'>";
            echo "<a class='page-link pagination-last normal-14-medium-p' href='./list-subject.page.php?page=$prev_page ' tabindex='-1' aria-disabled='true'>Anterior</a>";
            echo "</li>";
        } else {
            echo "<li class='page-item disabled'>";
            echo "<a class='page-link disable pagination-last normal-14-medium-p' href='#' tabindex='-1' aria-disabled='true'>Anterior</a>";
            echo "</li>";
        }

        //Apresentar a paginação
        for ($i = 1; $i < $page_qnt + 1; $i++) {
            echo "<li class='page-item'><a class='page-link pagination-page normal-14-medium-p' href='./list-subject.page.php?page=$i'> $i </a></li>";
        }

        //botão para avançar
        if ($next_page <= $page_qnt) {
            echo "<li class='page-item'>";
            echo "<a class='page-link pagination-next normal-14-medium-p' href='./list-subject.page.php?page= $next_page ' tabindex='-1' aria-disabled='true'>Próximo</a>";
            echo "</li>";
        } else {
            echo "<li class='page-item disabled'>";
            echo "<a class='page-link disable pagination-next normal-14-medium-p' href='#' tabindex='-1' aria-disabled='true'>Próximo</a>";
            echo "</li>";
        }
        echo "</ul>";
    }

    //----------------------------
    /**
     * @method paginationSubjects() paginate list of subjects
     * @param string $search
     */
    public function paginationSubjectsOfSearch(string $search)
    {
        $connection = Connection::connection();

        //Receber o numero de página
        $current_page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
        $page = (!empty($current_page)) ? $current_page : 1;

        //Setar a quantidade de registros por página
        $limit_result = 9;


        //Contar a quantidade de registros no bd 
        $query_qnt_register = "SELECT COUNT(id) AS 'id' FROM subjects WHERE name LIKE '%$search%'";
        $result_qnt_register = $connection->prepare($query_qnt_register);
        $result_qnt_register->execute();
        $row_qnt_register = $result_qnt_register->fetch(PDO::FETCH_ASSOC);

        //Quantidade de páginas
        $page_qnt = ceil($row_qnt_register['id'] / $limit_result);

        $prev_page = $page - 1;

        $next_page = $page + 1;

        echo "<ul class='pagination'>";

        //botão para voltar
        if ($prev_page != 0) {
            echo "<li class='page-item'>";
            echo "<a class='page-link pagination-last normal-14-medium-p' href='./list-subject.page.php?page=$prev_page &searchSubject=$search' tabindex='-1' aria-disabled='true'>Anterior</a>";
            echo "</li>";
        } else {
            echo "<li class='page-item disabled'>";
            echo "<a class='page-link disable pagination-last normal-14-medium-p' href='#' tabindex='-1' aria-disabled='true'>Anterior</a>";
            echo "</li>";
        }

        //Apresentar a paginação
        for ($i = 1; $i < $page_qnt + 1; $i++) {
            echo "<li class='page-item'><a class='page-link pagination-page normal-14-medium-p' href='./list-subject.page.php?page=$i &searchSubject=$search'> $i </a></li>";
        }

        //botão para avançar
        if ($next_page <= $page_qnt) {
            echo "<li class='page-item'>";
            echo "<a class='page-link pagination-next normal-14-medium-p' href='./list-subject.page.php?page= $next_page &searchSubject=$search' tabindex='-1' aria-disabled='true'>Próximo</a>";
            echo "</li>";
        } else {
            echo "<li class='page-item disabled'>";
            echo "<a class='page-link disable pagination-next normal-14-medium-p' href='#' tabindex='-1' aria-disabled='true'>Próximo</a>";
            echo "</li>";
        }
        echo "</ul>";
    }

    //----------------------------
    /**
     * @method selectTeachersUsedBySchool() selects the teachers being used by the school by 
     * @param int $id 
     */
    public function selectSubjectsByCourse(string $id): array
    {
        $connection = Connection::connection();

        $stmt = $connection->prepare("SELECT s.id, s.name FROM subjects s
                                        INNER JOIN courseshassubjects cs
                                        ON s.id = cs.subject_id
                                        INNER JOIN courses c
                                        ON c.id = cs.course_id
                                        WHERE c.id = '$id'
                                    ");

        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }
}
