<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Subject.class.php');

session_start();

$connection = Connection::connection();

if (!empty($_FILES['subject-table-file']['tmp_name'])) {
    $subject = new Subject();

    $file = $_FILES['subject-table-file']['tmp_name'];
    $subject->batchRegistrationSubjects($file);
}
