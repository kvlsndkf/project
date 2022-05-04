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
    //methods
    public function registerSchool($school)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("INSERT INTO schools(name, address, have_account, about, github, linkedin, facebook, instagram, photo, created_at)
                                         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");

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
                if(!empty($idSchool)){
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
}
