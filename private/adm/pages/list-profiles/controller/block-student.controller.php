<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/users/StudentController.class.php');

session_start();

if (isset($_POST['block'])) {
    $student = new StudentController();

    $userID = $_GET['userID'];

    $reason = $_POST['reason'];
    $student->setReason($reason);
    $student->blockUser($student, $userID);
}
