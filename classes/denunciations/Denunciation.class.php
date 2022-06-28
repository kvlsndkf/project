<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');

class Denunciation
{
    //attributes
    public int $id;
    public int $createdById;
    public int $denouncedId;
    public ?int $questionId = null;
    public ?int $answerId = null;
    public string $reason;
    public string $postLink;
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
    public function getCreatedById()
    {
        return $this->createdById;
    }
    public function setCreatedById($createdById)
    {
        $this->createdById = $createdById;
    }
    //----------------------------
    public function getDenouncedId()
    {
        return $this->denouncedId;
    }
    public function setDenouncedId($denouncedId)
    {
        $this->denouncedId = $denouncedId;
    }
    //----------------------------
    public function getQuestionId()
    {
        return $this->questionId;
    }
    public function setQuestionId($questionId)
    {
        $this->questionId = $questionId;
    }
    //----------------------------
    public function getAnswerId()
    {
        return $this->answerId;
    }
    public function setAnswerId($answerId)
    {
        $this->answerId = $answerId;
    }
    //----------------------------
    public function getReason()
    {
        return $this->reason;
    }
    public function setReason($reason)
    {
        $this->reason = $reason;
    }
    //----------------------------
    public function getPostLink()
    {
        return $this->postLink;
    }
    public function setPostLink($postLink)
    {
        $this->postLink = $postLink;
    }
    //----------------------------
    public function getStatus()
    {
        return $this->status;
    }
    public function setStatus($status)
    {
        $this->status = $status;
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
    public function getType()
    {
        return $this->type;
    }
    public function setType($type)
    {
        $this->type = $type;
    }
    //----------------------------
    public function getResultBuildListNew()
    {
        return $this->resultBuildListNew;
    }
    public function setResultBuildListNew($resultBuildListNew)
    {
        $this->resultBuildListNew = $resultBuildListNew;
    }
    //----------------------------
    public function getResultBuildListAnalysis()
    {
        return $this->resultBuildListAnalysis;
    }
    public function setResultBuildListAnalysis($resultBuildListAnalysis)
    {
        $this->resultBuildListAnalysis = $resultBuildListAnalysis;
    }
    //----------------------------
    public function getResultBuildListResolved()
    {
        return $this->resultBuildListResolved;
    }
    public function setResultBuildListResolved($resultBuildListResolved)
    {
        $this->resultBuildListResolved = $resultBuildListResolved;
    }
    //----------------------------
    public function getResultBuildListSearch()
    {
        return $this->resultBuildListSearch;
    }
    public function setResultBuildListSearch($resultBuildListSearch)
    {
        $this->resultBuildListSearch = $resultBuildListSearch;
    }
    //----------------------------
    //methods

    public function registerDenunciation(Denunciation $denunciation)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("INSERT INTO denunciations(reason, post_link, status, type, created_by_id, denounced_id, question_id, answer_id, created_at)
                                         VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");

            $stmt->bindValue(1, $denunciation->getReason());
            $stmt->bindValue(2, $denunciation->getPostLink());
            $stmt->bindValue(3, $denunciation->getStatus());
            $stmt->bindValue(4, $denunciation->getType());
            $stmt->bindValue(5, $denunciation->getCreatedById());
            $stmt->bindValue(6, $denunciation->getDenouncedId());
            $stmt->bindValue(7, $denunciation->getQuestionId());
            $stmt->bindValue(8, $denunciation->getAnswerId());

            $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        $idQuestion = $this->getQuestionId();

        if (!empty($idQuestion)) {
            try {

                $stmt = $connection->prepare("UPDATE questions SET is_denounced = ?, updated_at = NOW()
                                             WHERE id = $idQuestion");

                $stmt->bindValue(1, true);

                $stmt->execute();
                $_SESSION['statusPositive'] = "Questão denunciada, logo ela será avaliada.";
                header('Location: /project/private/student/pages/home/home.page.php');
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }

    public function registerDenunciationAnswer(Denunciation $denunciation)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("INSERT INTO denunciations(reason, post_link, status, type, created_by_id, denounced_id, question_id, answer_id, created_at)
                                         VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");

            $stmt->bindValue(1, $denunciation->getReason());
            $stmt->bindValue(2, $denunciation->getPostLink());
            $stmt->bindValue(3, $denunciation->getStatus());
            $stmt->bindValue(4, $denunciation->getType());
            $stmt->bindValue(5, $denunciation->getCreatedById());
            $stmt->bindValue(6, $denunciation->getDenouncedId());
            $stmt->bindValue(7, $denunciation->getQuestionId());
            $stmt->bindValue(8, $denunciation->getAnswerId());

            $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        $idQuestion = $this->getQuestionId();
        $idAnswer = $this->getAnswerId();

        if (!empty($idAnswer)) {
            try {

                $stmt = $connection->prepare("UPDATE answers SET is_denounced = ?, updated_at = NOW()
                                             WHERE id = $idAnswer");

                $stmt->bindValue(1, true);

                $stmt->execute();
                $_SESSION['statusPositive'] = "Resposta denunciada, logo ela será avaliada.";
                header('Location: /project/private/student/pages/detail-question/detail-question.page.php?idQuestion=' . $idQuestion);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }

    public function registerDenunciationProfile(Denunciation $denunciation, $profile)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("INSERT INTO denunciations(reason, post_link, status, type, created_by_id, denounced_id, question_id, answer_id, created_at)
                                         VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");

            $stmt->bindValue(1, $denunciation->getReason());
            $stmt->bindValue(2, $denunciation->getPostLink());
            $stmt->bindValue(3, $denunciation->getStatus());
            $stmt->bindValue(4, $denunciation->getType());
            $stmt->bindValue(5, $denunciation->getCreatedById());
            $stmt->bindValue(6, $denunciation->getDenouncedId());
            $stmt->bindValue(7, $denunciation->getQuestionId());
            $stmt->bindValue(8, $denunciation->getAnswerId());

            $stmt->execute();
            $_SESSION['statusPositive'] = "Perfil denunciado, logo ele será avaliado.";
            header('Location: /project/private/student/pages/detail-perfil-student/detail-perfil-student.page.php?idStudent=' . $profile);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function registerDenunciationPreference(Denunciation $denunciation, $prefenceID)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("INSERT INTO denunciations(reason, post_link, status, type, created_by_id, denounced_id, question_id, answer_id, created_at)
                                         VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");

            $stmt->bindValue(1, $denunciation->getReason());
            $stmt->bindValue(2, $denunciation->getPostLink());
            $stmt->bindValue(3, $denunciation->getStatus());
            $stmt->bindValue(4, $denunciation->getType());
            $stmt->bindValue(5, $denunciation->getCreatedById());
            $stmt->bindValue(6, $denunciation->getDenouncedId());
            $stmt->bindValue(7, $denunciation->getQuestionId());
            $stmt->bindValue(8, $denunciation->getAnswerId());

            $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        $idQuestion = $this->getQuestionId();

        if (!empty($idQuestion)) {
            try {
                $stmt = $connection->prepare("UPDATE questions SET is_denounced = ?, updated_at = NOW()
                                             WHERE id = $idQuestion");

                $stmt->bindValue(1, true);

                $stmt->execute();
                $_SESSION['statusPositive'] = "Questão denunciada, logo ela será avaliada.";
                header('Location: /project/private/student/pages/preferences/preference.page.php?preference=' . $prefenceID);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }

    public function listNewDenunciations()
    {

        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT de.id, de.reason, de.post_link, de.status, de.type, criated.first_name AS 'creator', 
                                            denounced.first_name AS 'denounced', de.denounced_id, de.question_id, criated.surname AS 'surname_creator', 
                                            denounced.surname AS 'surname_denounced' FROM denunciations de

                                            INNER JOIN students criated
                                            ON de.created_by_id = criated.user_id
                                            INNER JOIN students denounced
                                            ON de.denounced_id = denounced.user_id
                                            
                                            WHERE status = 'Nova'    
                                            ORDER BY de.created_at DESC
                                        ");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildNewDenunciationList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function buildNewDenunciationList($result)
    {
        $denunciations = [];

        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            $denunciation = new Denunciation();
            $denunciation->id = $row['id'];
            $denunciation->reason = $row['reason'];
            $denunciation->link = $row['post_link'];
            $denunciation->status = $row['status'];
            $denunciation->type = $row['type'];
            $denunciation->denouncedId = $row['denounced_id'];
            $denunciation->questionId = $row['question_id'];
            $denunciation->surnameCreator = $row['surname_creator'];
            $denunciation->surnameDenounced = $row['surname_denounced'];
            $denunciation->creator = $row['creator'];
            $denunciation->denounced = $row['denounced'];

            array_push($denunciations, $denunciation);
        }

        $this->setResultBuildListNew($denunciations);
        return $denunciations;
    }

    public function countNewDenunciations()
    {
        $resultBuildListNew = $this->getResultBuildListNew();

        $totalNew = count($resultBuildListNew);
        return "Total (" . $totalNew . ")";
    }

    public function moveToAnalysis(Denunciation $denunciation, int $id)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("UPDATE denunciations SET status = ?, updated_at = NOW()
                                         WHERE id = $id");

            $stmt->bindValue(1, $denunciation->getStatus());

            $stmt->execute();

            $_SESSION['statusPositive'] = "Denúncia movida para <strong>Em análise<strong>.";
            header('Location: /project/private/adm/pages/denunciation/list-denunciation.page.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function listAnalysisDenunciations()
    {

        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT de.id, de.reason, de.post_link, de.status, de.type, criated.first_name AS 'creator', 
                                            denounced.first_name AS 'denounced', de.denounced_id, de.question_id, criated.surname AS 'surname_creator', 
                                            denounced.surname AS 'surname_denounced', de.answer_id FROM denunciations de

                                            INNER JOIN students criated
                                            ON de.created_by_id = criated.user_id
                                            INNER JOIN students denounced
                                            ON de.denounced_id = denounced.user_id
                                            
                                            WHERE status = 'Em análise'    
                                            ORDER BY de.created_at DESC
                                        ");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildAnalysisDenunciationList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function buildAnalysisDenunciationList($result)
    {
        $denunciations = [];

        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            $denunciation = new Denunciation();
            $denunciation->id = $row['id'];
            $denunciation->reason = $row['reason'];
            $denunciation->link = $row['post_link'];
            $denunciation->status = $row['status'];
            $denunciation->type = $row['type'];
            $denunciation->surnameCreator = $row['surname_creator'];
            $denunciation->surnameDenounced = $row['surname_denounced'];
            $denunciation->denouncedId = $row['denounced_id'];
            $denunciation->questionId = $row['question_id'];
            $denunciation->answerId = $row['answer_id'];
            $denunciation->creator = $row['creator'];
            $denunciation->denounced = $row['denounced'];

            array_push($denunciations, $denunciation);
        }

        $this->setResultBuildListAnalysis($denunciations);
        return $denunciations;
    }

    public function countAnalysisDenunciations()
    {
        $resultBuildListAnalysis = $this->getResultBuildListAnalysis();

        $totalAnlysis = count($resultBuildListAnalysis);
        return "Total (" . $totalAnlysis . ")";
    }

    public function getContextsForModal()
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT id, name FROM denunciationshascontexts

                                            ORDER BY name
                                        ");
            $stmt->execute();
            $result = $stmt->fetchAll();

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function moveResolved(Denunciation $denunciation, int $id, $questionID = '', $answerId = '', $userId = '')
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("UPDATE denunciations SET status = ?, conclusion = ?, context_id = ?, updated_at = NOW()
                                         WHERE id = $id");

            $stmt->bindValue(1, $denunciation->getStatus());
            $stmt->bindValue(2, $denunciation->getConclusion());
            $stmt->bindValue(3, $denunciation->getContext());

            $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        if($this->getType() == "Pergunta"){
            if ($this->getContext() == 1) {
                try {
    
                    $stmt = $connection->prepare("UPDATE questions SET is_blocked = ?, denunciation_id = ?
                                                 WHERE id = $questionID");
    
                    $stmt->bindValue(1, true);
                    $stmt->bindValue(2, $id);
    
                    $stmt->execute();
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
        }

        if($this->getType() == "Resposta"){
            if ($this->getContext() == 1) {
                try {
    
                    $stmt = $connection->prepare("UPDATE answers SET is_blocked = ?, denunciation_id = ?
                                                 WHERE id = $answerId");
    
                    $stmt->bindValue(1, true);
                    $stmt->bindValue(2, $id);
    
                    $stmt->execute();
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
        }

        if($this->getType() == "Perfil"){
            if ($this->getContext() == 1) {
                try {
    
                    $stmt = $connection->prepare("UPDATE users SET is_blocked = ?, denunciation_id = ?
                                                 WHERE id = $userId");
    
                    $stmt->bindValue(1, true);
                    $stmt->bindValue(2, $id);
    
                    $stmt->execute();
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
        }

        $_SESSION['statusPositive'] = "Denúncia resolvida para <strong>Resolvidas<strong>.";
        header('Location: /project/private/adm/pages/denunciation/list-denunciation.page.php');
    }

    public function listResolvedDenunciations()
    {

        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT de.id, de.reason, de.post_link, de.status, de.type, criated.first_name AS 'creator', 
                                            denounced.first_name AS 'denounced', de.conclusion, con.name, de.denounced_id, de.question_id,
                                            criated.surname AS 'surname_creator', denounced.surname AS 'surname_denounced' FROM denunciations de

                                            INNER JOIN students criated
                                            ON de.created_by_id = criated.user_id
                                            INNER JOIN students denounced
                                            ON de.denounced_id = denounced.user_id
                                            INNER JOIN denunciationshascontexts con
                                            ON con.id = de.context_id
                                            
                                            WHERE status = 'Resolvida'    
                                            ORDER BY de.updated_at DESC
                                        ");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildResolvedDenunciationList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function buildResolvedDenunciationList($result)
    {
        $denunciations = [];

        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            $denunciation = new Denunciation();
            $denunciation->id = $row['id'];
            $denunciation->reason = $row['reason'];
            $denunciation->link = $row['post_link'];
            $denunciation->status = $row['status'];
            $denunciation->type = $row['type'];
            $denunciation->denouncedId = $row['denounced_id'];
            $denunciation->questionId = $row['question_id'];
            $denunciation->surnameCreator = $row['surname_creator'];
            $denunciation->surnameDenounced = $row['surname_denounced'];
            $denunciation->creator = $row['creator'];
            $denunciation->denounced = $row['denounced'];
            $denunciation->conclusion = $row['conclusion'];
            $denunciation->context = $row['name'];

            array_push($denunciations, $denunciation);
        }

        $this->setResultBuildListResolved($denunciations);
        return $denunciations;
    }

    public function countResolvedDenunciations()
    {
        $resultBuildListResolved = $this->getResultBuildListResolved();

        $totalResolved = count($resultBuildListResolved);
        return "Total (" . $totalResolved . ")";
    }

    public function listSearchDenunciations($search)
    {
        $connection = Connection::connection();
        
        try {
            $all1 = $connection->prepare("SELECT de.id, de.reason, de.post_link, de.status, de.type, de.denounced_id,
                                        criated.first_name AS 'creator', criated.surname AS 'surname_creator', denounced.first_name AS 'denounced', 
                                        denounced.surname AS 'surname_denounced', de.conclusion, con.name, de.question_id
                                        FROM denunciations de

                                        INNER JOIN students criated
                                        ON de.created_by_id = criated.user_id
                                        INNER JOIN students denounced
                                        ON de.denounced_id = denounced.user_id
                                        INNER JOIN denunciationshascontexts con
                                        ON con.id = de.context_id
                                                                                    
                                        WHERE (reason LIKE '%$search%' 
                                        OR criated.first_name LIKE '%$search%' 
                                        OR denounced.first_name LIKE '%$search%') 
                                        ");
            $all1->execute();
            $all = $all1->fetchAll(PDO::FETCH_ASSOC);

            $lines = $all1->rowCount();

            if ($lines == 00) {
                $_SESSION['statusNegative'] = "Não existem registros.";
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }

        try {
            $parse1 = $connection->prepare("SELECT de.id, de.reason, de.post_link, de.status, de.type, criated.first_name AS 'creator', 
                                            de.denounced_id, criated.surname AS 'surname_creator', denounced.first_name AS 'denounced',
                                            denounced.surname AS 'surname_denounced', de.question_id FROM denunciations de

                                            INNER JOIN students criated
                                            ON de.created_by_id = criated.user_id
                                            INNER JOIN students denounced
                                            ON de.denounced_id = denounced.user_id
                                            
                                            WHERE (reason LIKE '%$search%' 
                                            OR criated.first_name LIKE '%$search%' 
                                            OR denounced.first_name LIKE '%$search%') 
                                        ");
            $parse1->execute();
            $parse = $parse1->fetchAll(PDO::FETCH_ASSOC);

            $lines = $parse1->rowCount();

            if ($lines == 00) {
                $_SESSION['statusNegative'] = "Não existem registros.";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $this->buildSearchDenunciationList($parse, $all);
    }

    private function buildSearchDenunciationList($parse, $all)
    {
        $denunciations = [];

        function comparator($object1, $object2)
        {
            return $object1['reason'] < $object2['reason'];
        }

        $compare = array_merge($parse, $all);

        usort($compare, 'comparator');

        for ($i = 0; $i < count($compare); $i++) {
            $row = $compare[$i];
            $denunciation = new Denunciation();
            $denunciation->id = $row['id'];
            $denunciation->reason = $row['reason'];
            $denunciation->link = $row['post_link'];
            $denunciation->status = $row['status'];
            $denunciation->type = $row['type'];
            $denunciation->denouncedId = $row['denounced_id'];
            $denunciation->questionId = $row['question_id'];
            $denunciation->creator = $row['creator'];
            $denunciation->surnameCreator = $row['surname_creator'];
            $denunciation->denounced = $row['denounced'];
            $denunciation->surnameDenounced = $row['surname_denounced'];
            $denunciation->conclusion = $row['conclusion'] ?? '';
            $denunciation->context = $row['name'] ?? '';

            array_push($denunciations, $denunciation);
        }

        $this->setResultBuildListSearch($denunciations);
        return $denunciations;
    }

    public function countSearchDenunciations()
    {
        $resultBuildListSearch = $this->getResultBuildListSearch();

        $totalSearch = count($resultBuildListSearch);
        return "Resultado da pesquisa (" . $totalSearch . ")";
    }
}
