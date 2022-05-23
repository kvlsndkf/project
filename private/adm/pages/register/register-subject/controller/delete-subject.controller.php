<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Subject.class.php');

session_start();

$id = $_GET['id'];

$connection = Connection::connection();
$stmt = $connection->prepare("SELECT * FROM subjects WHERE id = $id");
$stmt->execute();
$subject = new Subject();
$subject->deleteSubject($id);