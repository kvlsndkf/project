<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/schools/School.class.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Teacher.class.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Course.class.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Subject.class.php');

session_start();

if (isset($_POST['update'])) {

    if (!is_uploaded_file($_FILES['updatePhoto']['tmp_name'])) {
        $oldPhoto = $_POST['oldPhoto'];

        $teacher = new Teacher();
        $teacher = $_POST['idTeachers'];

        $school = new School();
        $school = $_POST['idSchools'];

        $subject = new Subject();
        $subject = $_POST['idSubjects'];
        $course = new Course();
        $course->setName($_POST['updateName']);
        $course->setAbout($_POST['about']);

        $id = $_GET['updateCourse'];

        $course->setPhoto($oldPhoto);
        $course->setTeacher($teacher);
        $course->setSchool($school);
        $course->setSubject($subject);
        $course->updateCourse($course, $id);
    } else {
        $coursePhoto = $_FILES['updatePhoto'];
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

                $subject = new Subject();
                $subject = $_POST['idSubjects'];

                $course = new Course();
                $course->setName($_POST['updateName']);
                $course->setAbout($_POST['about']);

                $id = $_GET['updateCourse'];
                $course->setPhoto($pathToSave);
                $course->setTeacher($teacher);
                $course->setSchool($school);
                $course->setSubject($subject);
                $course->updateCourse($course, $id);
            } else {
                $_SESSION['statusNegative'] = "Falha ao carregar a imagem, tente novamente...";
                header('Location: /project/private/adm/pages/register/register-course/form-register-course.page.php');
            }
        }
    }
}
