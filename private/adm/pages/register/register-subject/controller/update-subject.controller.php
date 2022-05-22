<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Subject.class.php');

session_start();

if(isset($_POST['update'])){
    $subject = new Subject();
    $subject->setName($_POST['updateName']);
    $id = $_GET['updateSubject'];
    $subject->updateSubject($subject, $id);
}