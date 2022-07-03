<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Teacher.class.php');

session_start();

if (isset($_POST['register'])) {
    if (isset($_FILES['photo']) && isset($_POST['name'])) {
        $teacherPhoto = $_FILES['photo'];
        $namePhoto = $teacherPhoto['name'];
        $nameId = uniqid();
        $extensionPhoto = strtolower(pathinfo($namePhoto, PATHINFO_EXTENSION));

        if ($teacherPhoto['size'] > 2097152) {
            $_SESSION['statusAlert'] = "Arquivo muito grande. Máximo: 2MB.";
            header('Location: /project/private/adm/pages/register/register-teacher/form-register-teacher.page.php');
        }

        if ($teacherPhoto['error']) {
            $_SESSION['statusNegative'] = "Falha ao enviar arquivo.";
            header('Location: /project/private/adm/pages/register/register-teacher/form-register-teacher.page.php');
        }

        if ($extensionPhoto != "jpg" && $extensionPhoto != "jpeg" && $extensionPhoto != "png") {
            $_SESSION['statusAlert'] = "Tipo de arquivo incorreto. Permitidos: jpg, jpeg e png.";
            header('Location: /project/private/adm/pages/register/register-teacher/form-register-teacher.page.php');
        }

        if (is_null($_SESSION['statusAlert']) && is_null($_SESSION['statusNegative'])) {
            $pathToSave = "/project/private/adm/pages/register/upload/teachers/" . $nameId . "." . $extensionPhoto;
            $path = "/xampp/htdocs/project/private/adm/pages/register/upload/teachers/" . $nameId . "." . $extensionPhoto;
            $success = move_uploaded_file($teacherPhoto["tmp_name"], $path);

            if ($success) {
                $teacher = new Teacher();
                $teacher->setName($_POST['name']);
                $teacher->setPhoto($pathToSave);
                $teacher->registerTeacher($teacher);
            } else {
                $_SESSION['statusNegative'] = "Falha ao carregar a imagem, tente novamente...";
                header('Location: /project/private/adm/pages/register/register-teacher/form-register-teacher.page.php');
            }
        }
    }
}
