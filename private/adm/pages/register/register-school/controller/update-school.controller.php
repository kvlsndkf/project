<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/schools/School.class.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Teacher.class.php');

session_start();

if (isset($_POST['update'])) {

    if (!isset($_POST['createAccount'])) {
        $school = new School();

        $school->setName($_POST['updateName']);
        $school->setAddress(($_POST['address']));
        $school->setInSpCity($_POST['districtSchool'] ?? '');
        $school->setNotInSpCity($_POST['citySchool'] ?? '');
        $school->setHaveAccount(isset($_POST['createAccount']));

        $id = $_GET['updateSchool'];

        $school->updateSchool($school, $id);
    }

    if (isset($_POST['createAccount'])) {

        if (!is_uploaded_file($_FILES['updatePhoto']['tmp_name'])) {
            $oldPhoto = $_POST['oldPhoto'];

            $teacher = new Teacher();
            $teacher = $_POST['idTeachers'];

            $school = new School();
            $school->setName($_POST['updateName']);
            $school->setAddress(($_POST['address']));
            $school->setInSpCity($_POST['districtSchool'] ?? '');
            $school->setNotInSpCity($_POST['citySchool'] ?? '');
            $school->setHaveAccount(($_POST['createAccount']));
            $school->setAbout($_POST['about']);
            $school->setGithub($_POST['github']);
            $school->setLinkedin($_POST['linkedin']);
            $school->setFacebook($_POST['facebook']);
            $school->setInstagram($_POST['instagram']);

            $id = $_GET['updateSchool'];

            $school->setTeacher($teacher);
            $school->setPhoto($oldPhoto);
            $school->updateSchool($school, $id);
        } else {
            $schoolPhoto = $_FILES['updatePhoto'];
            $namePhoto = $schoolPhoto['name'];
            $nameId = uniqid();
            $extensionPhoto = strtolower(pathinfo($namePhoto, PATHINFO_EXTENSION));

            if ($schoolPhoto['size'] > 2097152) {
                $_SESSION['statusAlert'] = "Arquivo muito grande. Máximo: 2MB.";
                header('Location: /project/private/adm/pages/register/register-school/list-school.page.php');
            }

            if ($schoolPhoto['error']) {
                $_SESSION['statusNegative'] = "Falha ao enviar arquivo.";
                header('Location: /project/private/adm/pages/register/register-school/list-school.page.php');
            }

            if ($extensionPhoto != "jpg" && $extensionPhoto != "jpeg" && $extensionPhoto != "png") {
                $_SESSION['statusAlert'] = "Tipo de arquivo incorreto. Permitidos: jpg, jpeg e png.";
                header('Location: /project/private/adm/pages/register/register-school/list-school.page.php');
            }

            if (!isset($_SESSION['statusAlert']) && !isset($_SESSION['statusNegative'])) {
                $pathToSave = "/project/private/adm/pages/register/upload/schools/" . $nameId . "." . $extensionPhoto;
                $path = "/xampp/htdocs/project/private/adm/pages/register/upload/schools/" . $nameId . "." . $extensionPhoto;
                $success = move_uploaded_file($schoolPhoto["tmp_name"], $path);

                if ($success) {
                    $teacher = new Teacher();
                    $teacher = $_POST['idTeachers'];

                    $school = new School();
                    $school->setName($_POST['updateName']);
                    $school->setAddress(($_POST['address']));
                    $school->setInSpCity($_POST['districtSchool'] ?? '');
                    $school->setNotInSpCity($_POST['citySchool'] ?? '');
                    $school->setHaveAccount(($_POST['createAccount']));
                    $school->setAbout($_POST['about']);
                    $school->setGithub($_POST['github']);
                    $school->setLinkedin($_POST['linkedin']);
                    $school->setFacebook($_POST['facebook']);
                    $school->setInstagram($_POST['instagram']);
                    $school->setPhoto($pathToSave);

                    $id = $_GET['updateSchool'];

                    $school->setTeacher($teacher);
                    $school->updateSchool($school, $id);
                } else {
                    $_SESSION['statusNegative'] = "Falha ao carregar a imagem, tente novamente...";
                    header('Location: /project/private/adm/pages/register/register-school/list-school.page.php');
                }
            }
        }
    }
}
