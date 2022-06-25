<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/users/Student.class.php');

if (isset($_POST['update'])) {
    
    $studentID = $_GET['idStudentLogged'];
    $userId = $_GET['idUser'];

    if (is_uploaded_file($_FILES['updatePhoto']['tmp_name'])) {
        $studentPhoto = $_FILES['updatePhoto'];
        $namePhoto = $studentPhoto['name'];
        $nameId = uniqid();
        $extensionPhoto = strtolower(pathinfo($namePhoto, PATHINFO_EXTENSION));

        if ($studentPhoto['size'] > 2097152) {
            $_SESSION['statusAlert'] = "Arquivo muito grande. Máximo: 2MB.";
            header('Location: /project/private/student/pages/detail-perfil-student/update-perfil-student.page.php?idStudentLogged=' . $studentID);
        }

        if ($studentPhoto['error']) {
            $_SESSION['statusNegative'] = "Falha ao enviar arquivo.";
            header('Location: /project/private/student/pages/detail-perfil-student/update-perfil-student.page.php?idStudentLogged=' . $studentID);
        }

        if ($extensionPhoto != "jpg" && $extensionPhoto != "jpeg" && $extensionPhoto != "png") {
            $_SESSION['statusAlert'] = "Tipo de arquivo incorreto. Permitidos: jpg, jpeg e png.";
            header('Location: /project/private/student/pages/detail-perfil-student/update-perfil-student.page.php?idStudentLogged=' . $studentID);
        }

        if (!isset($_SESSION['statusAlert']) && !isset($_SESSION['statusNegative'])) {
            $pathToSave = "/project/views/pages/register/upload/student/" . $nameId . "." . $extensionPhoto;
            $path = "/xampp/htdocs/project/views/pages/register/upload/student/" . $nameId . "." . $extensionPhoto;
            $success = move_uploaded_file($studentPhoto["tmp_name"], $path);

            if ($success) {
                $student = new Student();
                $student->setPhoto($pathToSave);
                $student->setFirstName($_POST['firstName']);
                $student->setSurname($_POST['surname']);
                $student->setModuleId($_POST['module']);
                $student->setLinkedin($_POST['linkedin']);
                $student->setGithub($_POST['github']);
                $student->setFacebook($_POST['facebook']);
                $student->setInstagram($_POST['instagram']);

                if (!empty($_POST['oldPassword'])) {
                    $password = $student->checkPassword($_POST['oldPassword'], $_POST['newPassword'], $_POST['passwordConfirm'], $userId);

                    if ($password != true) {
                        $_SESSION['statusNegative'] = $password;
                        header('Location: /project/private/student/pages/detail-perfil-student/update-perfil-student.page.php?idStudentLogged=' . $studentID);
                    } else {
                        $student->setPassword(password_hash($_POST['newPassword'], PASSWORD_DEFAULT));
                        $student->updateStudent($student, $studentID);
                    }
                } else {
                    $student->updateStudent($student, $studentID);
                }
            } else {
                $_SESSION['statusNegative'] = "Falha ao carregar a imagem, tente novamente...";
                header('Location: /project/private/student/pages/detail-perfil-student/update-perfil-student.page.php?idStudentLogged=' . $studentID);
            }
        }
    } else {
        if (is_string($_POST['firstName'])) {
            $oldPhoto = $_POST['oldPhoto'];
            $student = new Student();
            $student->setPhoto($oldPhoto);
            $student->setFirstName($_POST['firstName']);
            $student->setSurname($_POST['surname']);
            $student->setModuleId($_POST['module']);
            $student->setLinkedin($_POST['linkedin']);
            $student->setGithub($_POST['github']);
            $student->setFacebook($_POST['facebook']);
            $student->setInstagram($_POST['instagram']);

            if (!empty($_POST['oldPassword'])) {
                $password = $student->checkPassword($_POST['oldPassword'], $_POST['newPassword'], $_POST['passwordConfirm'], $userId);
                
                if (!is_null($password)) {
                    $_SESSION['statusNegative'] = $password;
                    header('Location: /project/private/student/pages/detail-perfil-student/update-perfil-student.page.php?idStudentLogged=' . $studentID);
                } else {
                    $student->setPassword(password_hash($_POST['newPassword'], PASSWORD_DEFAULT));
                    $student->updateStudent($student, $studentID);
                }
            } else {
                $password = $student->getOldPassword($userId);
                $student->setPassword($password['password']);
                $student->updateStudent($student, $studentID);
            }
        }
    }
}
