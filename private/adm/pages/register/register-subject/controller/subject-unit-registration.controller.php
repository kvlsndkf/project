<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Subject.class.php');

session_start();

if(isset($_POST['register'])){
    $subject = new Subject();
    $subject->setName($_POST['name']);
    $subject->registerSubject($subject);
}