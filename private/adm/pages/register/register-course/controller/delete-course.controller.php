<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Course.class.php');

session_start();

$id = $_GET['id'];

$connection = Connection::connection();
$stmt = $connection->prepare("SELECT * FROM courses WHERE id = $id");
$stmt->execute();
$rowCat = $stmt->fetch(PDO::FETCH_ASSOC);

$path = $rowCat['photo'];
$course = new Course();
$course->deleteCourse($id, $path);