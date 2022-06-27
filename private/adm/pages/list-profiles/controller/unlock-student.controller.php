<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/users/StudentController.class.php');

session_start();

if (isset($_POST['unlock'])) {
    $student = new StudentController();
    
    $userID = $_GET['userID'];
    
    $student->unlockUser($userID);
}