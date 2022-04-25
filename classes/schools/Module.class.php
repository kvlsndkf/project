<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');

class Module
{
    //attributes
    public int $id;
    public string $name;
    public string $createdAt;
    public string $updatedAt;
    public array $resultBuildList;

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
     * @method registerModule() registers the modules by 
     * @param Module $module 
     */
    public function registerModule(Module $module): void
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("INSERT INTO modules(name, created_at)
                                         VALUES (?, NOW())");
            $stmt->bindValue(1, $module->getName());

            $stmt->execute();

            $_SESSION['statusPositive'] = "Módulo cadastrado com sucesso.";
            header('Location: /project/private/adm/pages/register/register-module/list-module.page.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method deleteModule() delete the module by 
     * @param int $id 
     */
    //this method delete the teacher by id.
    public function deleteModule(int $id): void
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("DELETE FROM modules WHERE id='$id'");

            $stmt->execute();

            $_SESSION['statusPositive'] = "Módulo apagado com sucesso.";
            header('Location: /project/private/adm/pages/register/register-module/list-module.page.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method updateModule() updates the module by 
     * @param Module $module 
     * @param int $id 
     */
    public function updateModule(Module $module, int $id): void
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("UPDATE modules SET name = ?, updated_at = NOW()
                                         WHERE id = $id");
            $stmt->bindValue(1, $module->getName());

            $stmt->execute();

            $_SESSION['statusPositive'] = "Módulo atualizado com sucesso.";
            header('Location: /project/private/adm/pages/register/register-module/list-module.page.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method listModule() lists the module by 
     * @param string $search 
     */
    public function listModule(string $search = ''): array | false
    {
        $connection = Connection::connection();
        try {
            if (!is_null($search)) {
                $result = $this->searchModule($search);
                return $this->buildModuleList($result);
            }

            $stmt = $connection->prepare("SELECT id, name FROM modules ORDER BY name");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildModuleList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method searchModule() search modules names by 
     * @param string $search 
     */
    private function searchModule(string $search): array | false
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT * FROM modules WHERE name LIKE '%$search%' ORDER BY name");

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
     * @method buildModuleList() organize the list of modules by 
     * @param array $result 
     */
    private function buildModuleList(array | false $result): array | false
    {
        $modules = [];

        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            $module = new Module();
            $module->id = $row['id'];
            $module->name = $row['name'];
            array_push($modules, $module);
        }

        $this->setResultBuildList($modules);
        return $modules;
    }

    //----------------------------
    /**
     * @method countTeachers() count the teachers by 
     * @param string $search 
     */
    public function countModules(string $search = ''): string
    {
        $searching = (!is_null($search) && !empty($search));

        if ($searching) {
            $resultBuildList = $this->getResultBuildList();
            $totalSearch = count($resultBuildList);
            return "Resultado da pesquisa " . $totalSearch;
        }

        $connection = Connection::connection();
        try {
            $stmt = $connection->prepare("SELECT COUNT(id) AS total FROM modules");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return "Total " . $result[0]['total'];
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
