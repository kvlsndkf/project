<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/inheritances/Social.class.php');

class User extends Social
{
    //attributes
    public string $email;
    public string $password;
    public string $photo;
    public string $typeUser;
    public bool $isConfirmed;
    public bool $isBlocked;
    public string $profileLink;
    public string $blockingReason;
    public string $blockedAt;
    public string $createdAt;
    public string $updatedAt;
    public array $preferences;

    //getters and setters
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    //----------------------------
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    //----------------------------
    public function getPhoto()
    {
        return $this->photo;
    }
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }
    //----------------------------
    public function getTypeUser()
    {
        return $this->typeUser;
    }
    public function setTypeUser($typeUser)
    {
        $this->typeUser = $typeUser;
    }
    //----------------------------
    public function getIsConfirmed()
    {
        return $this->isConfirmed;
    }
    public function setIsConfirmed($isConfirmed)
    {
        $this->isConfirmed = $isConfirmed;
    }
    //----------------------------
    public function getIsBlocked()
    {
        return $this->isBlocked;
    }
    public function setIsBlocked($isBlocked)
    {
        $this->isBlocked = $isBlocked;
    }
    //----------------------------
    public function getProfileLink()
    {
        return $this->profileLink;
    }
    public function setProfileLink($profileLink)
    {
        $this->profileLink = $profileLink;
    }
    //----------------------------
    public function getBlockingReason()
    {
        return $this->blockingReason;
    }
    public function setBlockingReason($blockingReason)
    {
        $this->blockingReason = $blockingReason;
    }
    //----------------------------
    public function getBlockedAt()
    {
        return $this->blockedAt;
    }
    public function setBlockedAt($blockedAt)
    {
        $this->blockedAt = $blockedAt;
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
    public function getPreferences()
    {
        return $this->preferences;
    }
    public function setPreferences($preferences)
    {
        $this->preferences = $preferences;
    }
    //----------------------------
    //methods

    public function login($email, $password){
        $connection = Connection::connection();

        $stmt = $connection->prepare("SELECT id, email, password, type_user, is_confirmed, is_blocked FROM users WHERE email LIKE'%$email%'");
        $stmt->execute();
        $listUser = $stmt->fetch(PDO::FETCH_BOTH);

        if ($stmt->rowCount() > 0) {
            if(password_verify($password, $listUser['password'])){

                if($listUser['is_confirmed'] == false){
                    $_SESSION['statusNegative'] = "Conta não confirmada.";
                    return header('Location: /project/views/pages/login/login-page.php');
                } 

                if($listUser['is_blocked'] == true){
                    $_SESSION['statusNegative'] = "Conta bloqueada.";
                    return header('Location: /project/views/pages/login/login-page.php');
                }

                if($listUser['type_user'] === 'student'){
                    session_start();
                    $idStudent = $listUser['id'];
                    $typeUser = $listUser['type_user'];

                    $_SESSION['idUser'] = $idStudent;
                    $_SESSION['typeUser'] = $typeUser;

                    return header('Location: /project/private/student/pages/home/home.page.php');
                }

                if($listUser['type_user'] === 'administrator'){
                    session_start();
                    $idAdministrator = $listUser['id'];
                    $typeUser = $listUser['type_user'];

                    $_SESSION['idUser'] = $idAdministrator;
                    $_SESSION['typeUser'] = $typeUser;

                    return header('Location: /project/private/adm/pages/dashboard/dashboard.page.php');
                }

                //se não for nenhum dos dois será a empresa parceira.
                echo json_encode($listUser);
            } else{
                $_SESSION['statusNegative'] = "Senha incorreta.";
                header('Location: /project/views/pages/login/login-page.php');
            }
        } else {
            $_SESSION['statusNegative'] = "Usuário não existe, faça o cadastro.";
            header('Location: /project/views/pages/login/login-page.php');
        }
    }
}