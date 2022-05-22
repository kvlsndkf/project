<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/schools/School.class.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Teacher.class.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Course.class.php');

session_start();


if (isset($_POST['register'])) {
    if (isset($_FILES['photo']) && isset($_POST['name'])) {
        $coursePhoto = $_FILES['photo'];
        $namePhoto = $coursePhoto['name'];
        $nameId = uniqid();
        $extensionPhoto = strtolower(pathinfo($namePhoto, PATHINFO_EXTENSION));

        if ($coursePhoto['size'] > 2097152) {
            $_SESSION['statusAlert'] = "Arquivo muito grande. Máximo: 2MB.";
            header('Location: /project/private/adm/pages/register/register-course/form-register-course.page.php');
        }

        if ($coursePhoto['error']) {
            $_SESSION['statusNegative'] = "Falha ao enviar arquivo.";
            header('Location: /project/private/adm/pages/register/register-course/form-register-course.page.php');
        }

        if ($extensionPhoto != "jpg" && $extensionPhoto != "jpeg" && $extensionPhoto != "png") {
            $_SESSION['statusAlert'] = "Tipo de arquivo incorreto. Permitidos: jpg, jpeg e png.";
            header('Location: /project/private/adm/pages/register/register-course/form-register-course.page.php');
        }

        if (is_null($_SESSION['statusAlert']) && is_null($_SESSION['statusNegative'])) {
            $pathToSave = "/project/private/adm/pages/register/upload/courses/" . $nameId . "." . $extensionPhoto;
            $path = "/xampp/htdocs/project/private/adm/pages/register/upload/courses/" . $nameId . "." . $extensionPhoto;
            $success = move_uploaded_file($coursePhoto["tmp_name"], $path);

            if ($success) {
                $teacher = new Teacher();
                $teacher = $_POST['idTeachers'];

                $school = new School();
                $school = $_POST['idSchools'];

                $course = new Course();
                $course->setName($_POST['name']);
                $course->setAbout($_POST['about']);

                $course->setPhoto($pathToSave);
                $course->setTeacher($teacher);
                $course->setSchool($school);
                $course->registerCourse($course);
            } else {
                $_SESSION['statusNegative'] = "Falha ao carregar a imagem, tente novamente...";
                header('Location: /project/private/adm/pages/register/register-course/form-register-course.page.php');
            }
        }
    }
}
