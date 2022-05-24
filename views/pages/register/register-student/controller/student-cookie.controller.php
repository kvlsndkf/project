<?php
require_once('/xampp/htdocs' . '/project/classes/cookies/Cookie.class.php');

if(isset($_POST['step1'])){

    if($_POST['password'] != $_POST['confirm-password']){
        return header('Location:../step1-register-student.page.php');
    }

    $email = $_POST['email'];
    $password =  $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    Cookie::writer('email', $email);
    Cookie::writer('password', $password);
    Cookie::writer('confirm-password', $confirmPassword);
    header('Location:../step2-register-student.page.php');
}

if(isset($_POST['step2'])){
    $firstName = $_POST['firstName'];
    $surname = $_POST['surname'];
    $linkedin = $_POST['linkedin'];
    $github = $_POST['github'];
    $facebook = $_POST['facebook'];
    $instagram = $_POST['instagram'];
    
    Cookie::writer('firstName', $firstName);
    Cookie::writer('surname', $surname);
    isset($_POST['linkedin']) ? Cookie::writer('linkedin', $linkedin) : '';
    isset($_POST['github']) ? Cookie::writer('github', $github) : '';
    isset($_POST['facebook']) ? Cookie::writer('facebook', $facebook) : '';
    isset($_POST['linkedin']) ? Cookie::writer('instagram', $instagram) : '';

    header('Location:../step3-register-student.page.php');
}