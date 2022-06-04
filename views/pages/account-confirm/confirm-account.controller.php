<?php
require_once('/xampp/htdocs' . '/project/classes/inheritances/User.class.php');

session_start();
ob_start();

$key = filter_input(INPUT_GET, "key", FILTER_UNSAFE_RAW);

if(!empty($key)){
    $student = new User();
    $student->validateEmailUser($key);
} else{
    $_SESSION['statusNegative'] = "Chave de confirmação inválida.";
    return header('Location: /project/views/pages/login/login-page.php');
}