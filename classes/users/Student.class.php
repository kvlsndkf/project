<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/inheritances/User.class.php');
require_once('/xampp/htdocs' . '/project/classes/users/StudentMethods.class.php');

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once('/xampp/htdocs' . '/project/libs/vendor/autoload.php');

class Student extends User
{
    //attributes
    public int $id;
    public string $firstName;
    public string $surname;
    public int $xp;
    public int $userId;
    public int $courseId;
    public int $moduleId;
    public int $schoolId;

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
    public function getFirstName()
    {
        return $this->firstName;
    }
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }
    //----------------------------
    public function getSurname()
    {
        return $this->surname;
    }
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }
    //----------------------------
    public function getUserId()
    {
        return $this->userId;
    }
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
    //----------------------------
    public function getCourseId()
    {
        return $this->courseid;
    }
    public function setCourseId($courseid)
    {
        $this->courseid = $courseid;
    }
    //----------------------------
    public function getModuleId()
    {
        return $this->moduleid;
    }
    public function setModuleId($moduleid)
    {
        $this->moduleid = $moduleid;
    }
    //----------------------------
    public function getSchoolId()
    {
        return $this->schoolId;
    }
    public function setSchoolId($schoolId)
    {
        $this->schoolId = $schoolId;
    }
    //----------------------------
    public function getXp()
    {
        return $this->xp;
    }
    public function setXp($xp)
    {
        $this->xp = $xp;
    }
    //----------------------------

    public function registerStudent(Student $student)
    {
        $connection = Connection::connection();

        $key = password_hash($this->getEmail() . date("Y-m-d H:i:s"), PASSWORD_DEFAULT);

        try {
            $connection->beginTransaction();
            $stmt = $connection->prepare("INSERT INTO users(email, password, photo, type_user, key_confirm, github, linkedin, facebook, instagram, created_at)
                                             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
            $stmt->bindValue(1, $student->getEmail());
            $stmt->bindValue(2, $student->getPassword());
            $stmt->bindValue(3, $student->getPhoto());
            $stmt->bindValue(4, $student->getTypeUser());
            $stmt->bindValue(5, $key);
            $stmt->bindValue(6, $student->getGithub());
            $stmt->bindValue(7, $student->getLinkedin());
            $stmt->bindValue(8, $student->getFacebook());
            $stmt->bindValue(9, $student->getInstagram());

            $stmt->execute();

            $idUser = $connection->lastInsertId();
            $this->setId($idUser);
            $connection->commit();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        try {
            $idUser = $this->getId();
            $preferences = $this->getPreferences();

            for ($i = 0; $i < count($preferences); $i++) {
                if (!empty($idUser)) {
                    $stmt = $connection->prepare("INSERT INTO usershaspreferences(created_at, user_id, preference_id)
                                                    VALUES (NOW(), ?, ?)");

                    $stmt->bindValue(1, $idUser);
                    $stmt->bindValue(2, $preferences[$i]);

                    $stmt->execute();
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        try {
            if (!empty($idUser)) {
                $connection->beginTransaction();
                $stmt = $connection->prepare("INSERT INTO students(first_name, surname, xp, created_at, user_id, course_id, module_id)
                                                VALUES (?, ?, ?, NOW(), ?, ?, ?)");

                $stmt->bindValue(1, $student->getFirstName());
                $stmt->bindValue(2, $student->getSurname());
                $stmt->bindValue(3, $student->getXp());
                $stmt->bindValue(4, $idUser);
                $stmt->bindValue(5, $student->getCourseId());
                $stmt->bindValue(6, $student->getModuleId());

                $stmt->execute();

                $idStudent = $connection->lastInsertId();
                $this->setId($idStudent);
                $connection->commit();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        try {
            $idStudent = $this->getId();

            if (!empty($idStudent)) {
                $stmt = $connection->prepare("INSERT INTO schoolshasstudents(created_at, student_id, school_id)
                                                VALUES (NOW(), ?, ?)");

                $stmt->bindValue(1, $idStudent);
                $stmt->bindValue(2, $student->getSchoolId());

                $stmt->execute();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        try {
            $connection = Connection::connection();


            $linkProfile = "/project/private/student/pages/detail-perfil-student/detail-perfil-student.page.php?idStudent=" . $idStudent;

            $insetLink = $connection->prepare("UPDATE users SET profile_link = ?
                                                WHERE id = $idUser");

            $insetLink->bindValue(1, $linkProfile);
            $insetLink->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        try {
            $email = $this->getEmail();
            $name = $this->getFirstName();
            $surname = $this->getSurname();

            return $this->sendEmail($email, $name, $surname, $key);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function sendEmail($email, $name, $surname, $key)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'heelp.suporte@gmail.com';
            $mail->Password   = 'help.sUporte@2022';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->CharSet    = 'UTF-8';

            //Recipients
            $mail->setFrom('heelp.suporte@gmail.com', 'Heelp!');
            $mail->addAddress($email, $name);

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Confirmação de Email';
            $mail->Body    = "
            <div style='background-color: #E9E0EE; padding: 20px 20px; font-family: Arial, Helvetica, sans-serif;'>

                <div style='text-align:center; margin-top:30px; margin-bottom: 40px;'>
                    <img src='https://images2.imgbox.com/f4/82/H35t54LD_o.png' style='width: 100px;'>
                </div>

                <p style='font-weight: bold; font-size:20px; color:#303030;'>
                    Olá $name $surname!
                </p> 

                <p style='color:#4F5660;'>
                    Obrigado por querer participar da maior rede de <strong>Etequianos!</strong> É um prazer ter você aqui com a gente!
                </p>

                <div style='color:#4F5660;'>
                    Estamos enviando o link para a ativação da sua conta:
                </div>

                <a href='http://localhost/project/views/pages/account-confirm/confirm-account.controller.php?key=$key'>
                    <button style='padding: 12px 30px; margin-top: 20px; background-color:#8080FF; color:#ffffff; font-weight: bold; border-radius:4px; border:none; margin-bottom: 20px; cursor:pointer;'>Ativar conta</button>
                </a>

            </div>

            <div style='padding: 10px 20px; background-color:#8080FF; color:#ffffff; font-family: Arial, Helvetica, sans-serif;'>

                <p style='font-size:14px;'>
                    Caso não consiga acessar pelo botão, entre pelo link: 
                    <a href='http://localhost/project/views/pages/account-confirm/confirm-account.controller.php?key=$key' style='color:#404EED;'> 
                        http://localhost/project/views/pages/account-confirm/confirm-account.controller.php?key=$key
                    </a>
                <p/>

                <p style='font-size:12px; color:#DCDDDE;'>
                    O Heelp é uma plataforma institucional, com intuito de ajudar os alunos das Etecs com as dúvidas das suas atividades. É pedindo e dando Heelp que você se destaca!
                </p>

                <div style='height:0.75px; background-color:#DCDDDE;'></div>

                <p style='font-size:12px; color:#DCDDDE;'>Feito por <a href='' style='color:#404EED;'>Cold Wolf</a></p>
            </div>
            ";

            $mail->send();

            $_SESSION['statusPositive'] = "Entre no seu email <strong>$email</strong>, para confirmar a sua conta!";
            return header('Location: /project/views/pages/login/login-page.php');
        } catch (Exception $e) {
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            $_SESSION['statusNegative'] = "Falha ao enviar o email.";
            return header('Location: /project/views/pages/login/login-page.php');
        }
    }

    public function updateStudent(Student $student, int $id)
    {
        $connection = Connection::connection();

        $idUser = StudentMethods::getUserByStudentID($id);

        $userid = $idUser[0]['user_id'];

        try {
            $stmt = $connection->prepare("UPDATE users SET photo = ?, password = ?, github = ?, linkedin = ?, facebook = ?, instagram = ?, updated_at = NOW()
                                         WHERE id = $userid");

            $stmt->bindValue(1, $student->getPhoto());
            $stmt->bindValue(2, $student->getPassword());
            $stmt->bindValue(3, $student->getGithub());
            $stmt->bindValue(4, $student->getLinkedin());
            $stmt->bindValue(5, $student->getFacebook());
            $stmt->bindValue(6, $student->getInstagram());

            $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        try {
            $stmt = $connection->prepare("UPDATE students SET first_name = ?, surname = ?, module_id = ?, updated_at = NOW()
                                         WHERE id = $id");

            $stmt->bindValue(1, $student->getFirstName());
            $stmt->bindValue(2, $student->getSurname());
            $stmt->bindValue(3, $student->getModuleId());

            $stmt->execute();

            $_SESSION['statusPositive'] = "Módulo atualizado com sucesso.";
            header('Location: /project/private/student/pages/detail-perfil-student/detail-perfil-student.page.php?idStudent=' . $id);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function checkPassword($oldPassword, $newPassword, $confirmPassword, $idUser)
    {
        $connection = Connection::connection();

        $stmt = $connection->prepare("SELECT password FROM users WHERE id = $idUser");
        $stmt->execute();
        $listUser = $stmt->fetch(PDO::FETCH_BOTH);

        try {
            if (password_verify($oldPassword, $listUser['password'])) {

                if ($oldPassword != $newPassword) {

                    if ($newPassword === $confirmPassword) {
                        return null;
                    }

                    return "Senhas não coincidem";
                } else {
                    return "Escolha uma nova senha diferente da antiga.";
                }
            } else {
                return "Senha antiga incorreta";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getOldPassword($idUser)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT password FROM users WHERE id = $idUser");
            $stmt->execute();
            $listUser = $stmt->fetch(PDO::FETCH_BOTH);


            return $listUser;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
