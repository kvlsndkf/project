<?php
include_once ('/xampp/htdocs' . '/project/database/connection.php');

class Solicitation
{
    //attributes
    public int $id;
    public string $contact;
    public string $category;
    public string $registerLink;
    public string $title;
    public string $description;
    public string $status;
    public string $context;
    public string $conclusion;
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
    public function getContact()
    {
        return $this->contact;
    }
    public function setContact($contact)
    {
        $this->contact = $contact;
    }
    //----------------------------
    public function getCategory()
    {
        return $this->category;
    }
    public function setCategory($category)
    {
        $this->category = $category;
    }
    //----------------------------
    public function getRegisterLink()
    {
        return $this->registerLink;
    }
    public function setRegisterLink($registerLink)
    {
        $this->registerLink = $registerLink;
    }
    //----------------------------
    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($title)
    {
        $this->title = $title;
    }
    //----------------------------
    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
    //----------------------------
    public function getStatus()
    {
        return $this->status;
    }
    public function setStatus($status)
    {
        if($status == "Nova") {
            $status = "Nova";
        }else if($status == "Análise") {
            $status = "Análise";
        }else if($status == "Resolvida"){
            $status = "Resolvida";
        }
        $this->status = $status;
    }
    //----------------------------
    public function getStatusSituation()
    {
        return $this->status;
    }
    public function setStatusSituation($statusSituation)
    {
        if($statusSituation == true){
            $statusSituation = "Solicitação acatada";
        }else{
            $statusSituation = "Solicitação recusada";
        }
        $this->statusSituation = $statusSituation;
    }
    //----------------------------
    public function getContext()
    {
        return $this->context;
    }
    public function setContext($context)
    {
        $this->context = $context;
    }
    //----------------------------
    public function getConclusion()
    {
        return $this->conclusion;
    }
    public function setConclusion($conclusion)
    {
        $this->conclusion = $conclusion;
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
    public function getResultBuildListNew(): array
    {
        return $this->resultBuildListNew;
    }
    public function setResultBuildListNew(array $resultBuildListNew): void
    {
        $this->resultBuildListNew = $resultBuildListNew;
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
    public function getResultBuildListResolved(): array
    {
        return $this->resultBuildListResolved;
    }
    public function setResultBuildListResolved(array $resultBuildListResolved): void
    {
        $this->resultBuildListResolved = $resultBuildListResolved;
    }
    //----------------------------
    //methods
    /**
     * @method registerSolicitation() register solicitation by 
     * @param Solicitation $solicitation
     */
    public function registerSolicitation(Solicitation $solicitation)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("INSERT INTO solicitations(contact,category_id,title,description ,status,created_at)
                                         VALUES (?,?,?,?,?, NOW())");
            $stmt->bindValue(1, $solicitation->getContact());
            $stmt->bindValue(2, $solicitation->getCategory());
            $stmt->bindValue(3, $solicitation->getTitle());
            $stmt->bindValue(4, $solicitation->getDescription());
            $stmt->bindValue(5, $solicitation->getStatus());

            $stmt->execute();

            $_SESSION['statusCompleted'] = "Obrigado! Seu comentário ajuda a deixar o help melhor para todos. Vamos ajustar e logo você poderá adicionar essa informação na sua conta!";
            header('Location: /project/views/pages/login/login-page.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    //----------------------------
    /**
     * @method listNewSolicitation() lists the new solicitation by 
     * @param string $search 
     */
    public function listNewSolicitation(string $search = ''): array | false
    {
        $connection = Connection::connection();

        try {
            if (!is_null($search) && !empty($search)) {
                $result = $this->searchSolicitation($search);
                return $this->buildNewSolicitationList($result);
            }

            $stmt = $connection->prepare("SELECT id,contact,title,category_id,status,description FROM solicitations WHERE status = 'Nova' ORDER BY created_at DESC");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildNewSolicitationList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    //----------------------------
    /**
     * @method listSolicitation() lists the solicitation by 
     */
    public function listSolicitation(): array | false
    {
        $connection = Connection::connection();

        try {

            $stmt = $connection->prepare("SELECT id,contact,title,category_id,status,description FROM solicitations WHERE status = 'Análise' ORDER BY created_at DESC");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildSolicitationList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    //----------------------------
    /**
     * @method listResolvedSolicitation() lists the resolved solicitation by 
     */
    public function listResolvedSolicitation(): array | false
    {
        $connection = Connection::connection();

        try {

            $stmt = $connection->prepare("SELECT id,contact,title,category_id,status,description,conclusion,situation_id FROM solicitations WHERE status = 'Resolvida' ORDER BY created_at DESC");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildResolvedSolicitationList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
     //----------------------------
    /**
     * @method listSolicitationOfSearchBar() list solicitation for search bar  
     */
    public function listSolicitationOfSearchBar()
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT * FROM solicitations ORDER BY created_at DESC");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildSolicitationList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    //----------------------------
    /**
     * @method searchSolicitation() search solicitation by 
     * @param string $search 
     */
    private function searchSolicitation(string $search)
    {
        $connection = Connection::connection();

        try {

            $stmt = $connection->prepare("SELECT * FROM solicitations WHERE description LIKE '%$search%' ORDER BY description");

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
     * @method buildNewSolicitationList() organize the list of new solicitation by 
     * @param array $result 
     */
    private function buildNewSolicitationList(array | false $result)
    {
        $solicitations = [];

        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            $solicitation = new Solicitation();
            $solicitation->id = $row['id'];
            $solicitation->contact = $row['contact'];
            $solicitation->category = $row['category_id'];
            $solicitation->title = $row['title'];
            $solicitation->status = $row['status'];
            $solicitation->description = $row['description'];
            array_push($solicitations, $solicitation);
        }

        $this->setResultBuildListNew($solicitations);
        return $solicitations;
    }
    //----------------------------
    /**
     * @method buildSolicitationList() organize the list of solicitation analitc by 
     * @param array $result 
     */
    private function buildSolicitationList(array | false $result)
    {
        $solicitations = [];

        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            $solicitation = new Solicitation();
            $solicitation->id = $row['id'];
            $solicitation->contact = $row['contact'];
            $solicitation->category = $row['category_id'];
            $solicitation->title = $row['title'];
            $solicitation->status = $row['status'];
            $solicitation->description = $row['description'];
            array_push($solicitations, $solicitation);
        }

        $this->setResultBuildList($solicitations);
        return $solicitations;
    }

     //----------------------------
    /**
     * @method buildResolvedSolicitationList() organize the list of solicitation resolved by 
     * @param array $result 
     */
    private function buildResolvedSolicitationList(array | false $result)
    {
        $solicitations = [];

        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            $solicitation = new Solicitation();
            $solicitation->id = $row['id'];
            $solicitation->contact = $row['contact'];
            $solicitation->category = $row['category_id'];
            $solicitation->title = $row['title'];
            $solicitation->status = $row['status'];
            $solicitation->statusSituation = $row['situation_id'];
            $solicitation->description = $row['description'];
            $solicitation->conclusion = $row['conclusion'];
            array_push($solicitations, $solicitation);
        }

        $this->setResultBuildList($solicitations);
        return $solicitations;
    }

    //----------------------------
    /**
     * @method countNewSolicitation() count the new solicitation by 
     * @param string $search 
     */
    public function countNewSolicitation($search)
    {
        $connection = Connection::connection();

        $searching = (!is_null($search) && !empty($search));

        if ($searching) {
            $stmt = $connection->prepare("SELECT COUNT(id) AS resultado FROM solicitations WHERE description LIKE '%$search%'");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return "Resultado da pesquisa " . $result[0]['resultado'];
        }

        try {
            $stmt = $connection->prepare("SELECT COUNT(id) AS total FROM solicitations WHERE status LIKE '%Nova%'");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return "Total (" . $result[0]['total'].")";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method countSolicitation() count the solicitation by 
     */
    public function countSolicitation()
    {   
        $connection = Connection::connection();


        $stmt = $connection->prepare("SELECT COUNT(id) AS total FROM solicitations WHERE status LIKE '%Análise%'");
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return "Total (" . $result[0]['total'].")";
        
    }
    //----------------------------
    /**
     * @method countResolvedSolicitation() count the resolved solicitation by 
     */
    public function countResolvedSolicitation()
    {
        $connection = Connection::connection();


        $stmt = $connection->prepare("SELECT COUNT(id) AS total FROM solicitations WHERE status LIKE '%Resolvida%'");
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return "Total (" . $result[0]['total'].")";
        
    }
    //----------------------------
    /**
     * @method analyzingSolicitation() analyzing the solicitations by 
     * @var $solicitation 
     * @param int $id
     */

    public function analyzingSolicitation(Solicitation $solicitation, int $id)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("UPDATE solicitations SET status = ?, created_at = NOW()
                                         WHERE id = $id");

            $stmt->bindValue(1, $solicitation->getStatus());

            $stmt->execute();

            $_SESSION['statusPositive'] = "Solicitação movida para <strong>Em análise<strong>.";
            header('Location: /project/private/adm/pages/information/list-information.page.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    //----------------------------
    /**
     * @method resolvedSolicitation() resolved the solicitation by 
     * @var $solicitation
     * @param int $id
     */
    public function resolvedSolicitation(Solicitation $solicitation, int $id)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("UPDATE solicitations SET status = ?, conclusion = ?,situation_id = ?, updated_at = NOW()
                                         WHERE id = $id");

            $stmt->bindValue(1, $solicitation->getStatus());
            $stmt->bindValue(2, $solicitation->getConclusion());
            $stmt->bindValue(3, $solicitation->getStatusSituation());

            $stmt->execute();

            $_SESSION['statusPositive'] = "Mensagem movida para <strong>Resolvidas<strong>.";
            header('Location: /project/private/adm/pages/information/list-information.page.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}
