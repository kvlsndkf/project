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
            if (!is_null($search) && !empty($search)) {
                $result = $this->searchModule($search);
                return $this->buildModuleList($result);
            }
            //Receber o numero de página
            $current_page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
            $page = (!empty($current_page)) ? $current_page : 1;

            //Setar a quantidade de registros por página
            $limit_result = 12;

            //Calcular o inicio da vizualização
            $start = ($limit_result * $page) - $limit_result;

            $stmt = $connection->prepare("SELECT id, name FROM modules ORDER BY name LIMIT $start, $limit_result");
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

        //Receber o numero de página
        $current_page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
        $page = (!empty($current_page)) ? $current_page : 1;

        //Setar a quantidade de registros por página
        $limit_result = 12;

        //Calcular o inicio da vizualização
        $start = ($limit_result * $page) - $limit_result;

        try {
            $stmt = $connection->prepare("SELECT * FROM modules WHERE name LIKE '%$search%' ORDER BY name LIMIT $start, $limit_result");

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
        $connection = Connection::connection();

        $searching = (!is_null($search) && !empty($search));

        if ($searching) {
            $stmt = $connection->prepare("SELECT COUNT(id) AS resultado FROM modules WHERE name LIKE '%$search%'");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return "Resultado da pesquisa " . $result[0]['resultado'];
        }


        try {
            $stmt = $connection->prepare("SELECT COUNT(id) AS total FROM modules");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return "Total " . $result[0]['total'];
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method listModulesOfSelectResgisterUser() list the modules for student registration
     */
    public function listModulesOfSelectResgisterUser()
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT id, name FROM modules");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $this->buildModuleListSelect($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method buildSchoolList() organize the list of teachers by 
     * @param array $result 
     */
    private function buildModuleListSelect(array | false $result)
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
     * @method getIdModuleByName() find the module by name
     * @param string $name 
     */
    public function getIdModuleByName($name)
    {
        $connection = Connection::connection();

        $stmt = $connection->prepare("SELECT id FROM modules
                                         WHERE name = '$name'
                                     ");

        $stmt->execute();

        $result = $stmt->fetchAll();
        return $result[0]['id'];
    }

    //----------------------------
    /**
     * @method paginationModule() paginate list of module
     */
    public function paginationModule()
    {
        $connection = Connection::connection();

        //Receber o numero de página
        $current_page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
        $page = (!empty($current_page)) ? $current_page : 1;

        //Setar a quantidade de registros por página
        $limit_result = 12;


        //Contar a quantidade de registros no bd 
        $query_qnt_register = "SELECT COUNT(id) AS 'id' FROM modules ";
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
            echo "<a class='page-link pagination-last normal-14-medium-p' href='./list-module.page.php?page=$prev_page ' tabindex='-1' aria-disabled='true'>Anterior</a>";
            echo "</li>";
        } else {
            echo "<li class='page-item disabled'>";
            echo "<a class='page-link disable pagination-last normal-14-medium-p' href='#' tabindex='-1' aria-disabled='true'>Anterior</a>";
            echo "</li>";
        }

        //Apresentar a paginação
        for ($i = 1; $i < $page_qnt + 1; $i++) {
            echo "<li class='page-item'><a class='page-link pagination-page normal-14-medium-p' href='./list-module.page.php?page=$i '> $i </a></li>";
        }

        //botão para avançar
        if ($next_page <= $page_qnt) {
            echo "<li class='page-item'>";
            echo "<a class='page-link pagination-next normal-14-medium-p' href='./list-module.page.php?page= $next_page ' tabindex='-1' aria-disabled='true'>Próximo</a>";
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
     * @method paginationModuleOfSearch() paginate list of module
     *  @param string $search 
     */
    public function paginationModuleOfSearch(string $search)
    {
        $connection = Connection::connection();

        //Receber o numero de página
        $current_page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
        $page = (!empty($current_page)) ? $current_page : 1;

        //Setar a quantidade de registros por página
        $limit_result = 12;


        //Contar a quantidade de registros no bd 
        $query_qnt_register = "SELECT COUNT(id) AS 'id' FROM modules WHERE name LIKE '%$search%'";
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
            echo "<a class='page-link pagination-last normal-14-medium-p' href='./list-module.page.php?page=$prev_page &searchModule=$search' tabindex='-1' aria-disabled='true'>Anterior</a>";
            echo "</li>";
        } else {
            echo "<li class='page-item disabled'>";
            echo "<a class='page-link disable pagination-last normal-14-medium-p' href='#' tabindex='-1' aria-disabled='true'>Anterior</a>";
            echo "</li>";
        }

        //Apresentar a paginação
        for ($i = 1; $i < $page_qnt + 1; $i++) {
            echo "<li class='page-item'><a class='page-link pagination-page normal-14-medium-p' href='./list-module.page.php?page=$i &searchModule=$search'> $i </a></li>";
        }

        //botão para avançar
        if ($next_page <= $page_qnt) {
            echo "<li class='page-item'>";
            echo "<a class='page-link pagination-next normal-14-medium-p' href='./list-module.page.php?page= $next_page &searchModule=$search' tabindex='-1' aria-disabled='true'>Próximo</a>";
            echo "</li>";
        } else {
            echo "<li class='page-item disabled'>";
            echo "<a class='page-link disable pagination-next normal-14-medium-p' href='#' tabindex='-1' aria-disabled='true'>Próximo</a>";
            echo "</li>";
        }
        echo "</ul>";
    }

    public function getModuleForStudentUpdate($id)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT id, name FROM modules
                                            WHERE NOT id = $id
                                        ");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $this->buildModuleListSelect($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
