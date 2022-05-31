<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/inheritances/User.class.php');

session_start();

if(isset($_POST['login'])){
    $user = new User();
   
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user->login($email, $password);
}