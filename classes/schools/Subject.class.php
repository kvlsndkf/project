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
            if (!empty($search)) {
                $result = $this->searchSubject($search);
                return $this->buildSubjectList($result);
            }

            $stmt = $connection->prepare("SELECT * FROM subjects ORDER BY name");
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
            $stmt = $connection->prepare("SELECT * FROM subjects WHERE name LIKE '%$search%' ORDER BY name");

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
        $searching = (!is_null($search) && !empty($search));

        if ($searching) {
            $resultBuildList = $this->getResultBuildList();
            $totalSearch = count($resultBuildList);
            return "Resultado da pesquisa " . $totalSearch;
        }

        $connection = Connection::connection();
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
            $stmt = $connection->prepare("SELECT * FROM subjects ORDER BY name");
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
}