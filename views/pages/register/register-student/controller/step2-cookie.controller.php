<?php
require_once('/xampp/htdocs' . '/project/classes/cookies/Cookie.class.php');

session_start();

if(isset($_POST['step2'])){
    $firstName = $_POST['firstName'];
    $surname = $_POST['surname'];

    $nameSchool = $_POST['nameSchool'];
    $nameCourse = $_POST['nameCourse'];
    $nameModule = $_POST['nameModule'];

    if(!isset($nameSchool)){
        $_SESSION['statusNegative'] = "Selecione uma Etec para continuar.";
        return header('Location: /project/views/pages/register/register-student/step2-register-student.page.php');
    }

    if(!isset($nameModule)){
        $_SESSION['statusNegative'] = "Selecione um módulo para continuar.";
        return header('Location: /project/views/pages/register/register-student/step2-register-student.page.php');
    }

    $linkedin = $_POST['linkedin'];
    $github = $_POST['github'];
    $facebook = $_POST['facebook'];
    $instagram = $_POST['instagram'];
    
    Cookie::writer('firstName', $firstName);
    Cookie::writer('surname', $surname);

    Cookie::writer('nameSchool', $nameSchool);
    Cookie::writer('nameCourse', $nameCourse);
    Cookie::writer('nameModule', $nameModule);

    isset($_POST['linkedin']) ? Cookie::writer('linkedin', $linkedin) : '';
    isset($_POST['github']) ? Cookie::writer('github', $github) : '';
    isset($_POST['facebook']) ? Cookie::writer('facebook', $facebook) : '';
    isset($_POST['linkedin']) ? Cookie::writer('instagram', $instagram) : '';

    header('Location:../step3-register-student.page.php');
}