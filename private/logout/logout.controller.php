<?php
session_start();

unset($_SESSION['idUser']);
unset($_SESSION['typeUser']);

session_destroy();
header("location: /project/views/pages/login/login-page.php");
?>