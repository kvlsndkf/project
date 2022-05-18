<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/schools/School.class.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Teacher.class.php');

session_start();

if (isset($_POST['register'])) {
    if (!isset($_FILES['photo'])) {
        $school = new School();

        $school->setName($_POST['name']);
        $school->setAddress(($_POST['address']));
        $school->setInSpCity($_POST['districtSchool'] ?? '');
        $school->setNotInSpCity($_POST['citySchool'] ?? '');
        $school->setHaveAccount(isset($_POST['createAccount']));

        $school->registerSchool($school);
    }

    if (isset($_POST['createAccount']) && isset($_FILES['photo'])) {
        $schoolPhoto = $_FILES['photo'];
        $namePhoto = $schoolPhoto['name'];
        $nameId = uniqid();
        $extensionPhoto = strtolower(pathinfo($namePhoto, PATHINFO_EXTENSION));

        if ($schoolPhoto['size'] > 2097152) {
            $_SESSION['statusAlert'] = "Arquivo muito grande. Máximo: 2MB.";
            header('Location: /project/private/adm/pages/register/register-school/form-register-school.page.php');
        }

        if ($schoolPhoto['error']) {
            $_SESSION['statusNegative'] = "Falha ao enviar arquivo.";
            header('Location: /project/private/adm/pages/register/register-school/form-register-school.page.php');
        }

        if ($extensionPhoto != "jpg" && $extensionPhoto != "jpeg" && $extensionPhoto != "png") {
            $_SESSION['statusAlert'] = "Tipo de arquivo incorreto. Permitidos: jpg, jpeg e png.";
            header('Location: /project/private/adm/pages/register/register-school/form-register-school.page.php');
        }

        if (is_null($_SESSION['statusAlert']) && is_null($_SESSION['statusNegative'])) {
            $pathToSave = "/project/private/adm/pages/register/upload/schools/" . $nameId . "." . $extensionPhoto;
            $path = "/xampp/htdocs/project/private/adm/pages/register/upload/schools/" . $nameId . "." . $extensionPhoto;
            $success = move_uploaded_file($schoolPhoto["tmp_name"], $path);
            if ($success) {
                $teacher = new Teacher();
                $teacher = $_POST['idTeachers'];

                $school = new School();
                $school->setName($_POST['name']);
                $school->setAddress(($_POST['address']));
                $school->setInSpCity($_POST['districtSchool'] ?? '');
                $school->setNotInSpCity($_POST['citySchool'] ?? '');
                $school->setHaveAccount(($_POST['createAccount']));
                $school->setAbout($_POST['aboutForDatabase']);
                $school->setGithub($_POST['github']);
                $school->setLinkedin($_POST['linkedin']);
                $school->setFacebook($_POST['facebook']);
                $school->setInstagram($_POST['instagram']);
                $school->setPhoto($pathToSave);

                $school->setTeacher($teacher);
                $school->registerSchool($school);
            } else {
                $_SESSION['statusNegative'] = "Falha ao carregar a imagem, tente novamente...";
                header('Location: /project/private/adm/pages/register/register-school/form-register-school.page.php');
            }
        }
    }
}
