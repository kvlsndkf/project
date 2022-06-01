<?php
require_once('/xampp/htdocs' . '/project/classes/inheritances/User.class.php');

session_start();

if(!isset($_SESSION['idUser'])){
    unset($_SESSION['idUser']);
    session_destroy();
    header('Location: /project/views/pages/login/login-page.php');
} 

if($_SESSION['typeUser'] != 'administrator'){
    unset($_SESSION['idUser']);
    unset($_SESSION['typeUser']);
    header('Location: /project/views/pages/login/login-page.php');
}