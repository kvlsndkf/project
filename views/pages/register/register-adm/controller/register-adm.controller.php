<?php
require_once('/xampp/htdocs' . '/project/classes/users/Administrator.class.php');

session_start();

if(isset($_POST['register'])){

    if($_POST['password'] != $_POST['password-confirm']){
        return header('Location: ');
    }

    $administrator = new Administrator();

    $administrator->setEmail($_POST['email']);
    $administrator->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
    $administrator->setTypeUser('administrator');
    $administrator->setIsConfirmed(true);
    $administrator->registerAdministrator($administrator);
}