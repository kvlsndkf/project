<?php
require_once('/xampp/htdocs' . '/project/classes/cookies/Cookie.class.php');
require_once('/xampp/htdocs' . '/project/classes/users/Student.class.php');

session_start();

if (isset($_POST['step1'])) {

    $email = $_POST['email'];

    if(isset($_POST['email'])){
        $connection = Connection::connection();
        $verifyEmail = $connection->prepare("SELECT email FROM users WHERE email LIKE'%$email%'");
        $verifyEmail->execute();

        if ($verifyEmail->rowCount() > 0) {
            $_SESSION['statusNegative'] = "Usuário já existente, faça o cadastro novamente.";
            return header('Location: /project/views/pages/register/register-profile/register-profile.pages.php');
        } else{
            Cookie::writer('email', $email);
        }
    }

    if ($_POST['password'] != $_POST['confirm-password']) {
        return header('Location:../step1-register-student.page.php');
    }

    $password =  $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    Cookie::writer('password', $password);
    Cookie::writer('confirm-password', $confirmPassword);
    header('Location:../step2-register-student.page.php');
}