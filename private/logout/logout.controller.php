<?php
session_start();

unset($_SESSION['idUser']);
unset($_SESSION['typeUser']);

session_destroy();
header("location: /project/index.php");
?>