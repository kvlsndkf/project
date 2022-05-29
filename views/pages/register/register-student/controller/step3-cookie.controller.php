<?php
require_once('/xampp/htdocs' . '/project/classes/cookies/Cookie.class.php');

session_start();

if (isset($_POST['step3'])) {

    if (!is_null(Cookie::reader('photoUser'))) {
        $oldPhoto = $_POST['oldPhoto'];
        Cookie::writer('photoUser', $oldPhoto);
        
        return header('Location:../step4-register-student.page.php');
    }

    $newPhoto = $_FILES['photo'];
    $namePhoto = $newPhoto['name'];

    $nameId = uniqid();
    $extensionPhoto = strtolower(pathinfo($namePhoto, PATHINFO_EXTENSION));

    if ($newPhoto['size'] > 2097152) {
        $_SESSION['statusAlert'] = "Arquivo muito grande. Máximo: 2MB.";
        header('Location: /project/views/pages/register/register-student/step3-register-student.page.php');
    }

    if ($newPhoto['error']) {
        $_SESSION['statusNegative'] = "Falha ao enviar arquivo.";
        header('Location: /project/views/pages/register/register-student/step3-register-student.page.php');
    }

    if ($extensionPhoto != "jpg" && $extensionPhoto != "jpeg" && $extensionPhoto != "png") {
        $_SESSION['statusAlert'] = "Tipo de arquivo incorreto. Permitidos: jpg, jpeg e png.";
        header('Location: /project/views/pages/register/register-student/step3-register-student.page.php');
    }

    if (is_null($_SESSION['statusAlert']) && is_null($_SESSION['statusNegative'])) {
        $pathToSave = "/project/views/pages/register/upload/student/" . $nameId . "." . $extensionPhoto;
        $path = "/xampp/htdocs/project/views/pages/register/upload/student/" . $nameId . "." . $extensionPhoto;
        $success = move_uploaded_file($newPhoto["tmp_name"], $path);

        if ($success) {
            $newPhotoUser = $pathToSave;
            Cookie::writer('photoUser', $newPhotoUser);

            header('Location:../step4-register-student.page.php');
        } else {
            $_SESSION['statusNegative'] = "Falha ao carregar a imagem, tente novamente...";
            header('Location: /project/views/pages/register/register-student/step3-register-student.page.php');
        }
    }
}
