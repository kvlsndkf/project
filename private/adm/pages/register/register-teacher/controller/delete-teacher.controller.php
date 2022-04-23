<?php
//header('Location: /project/private/adm/pages/register/register-teacher/list-teacher.page.php');
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Teacher.class.php');

session_start();

$id = $_GET['id'];

$connection = Connection::connection();
$stmt = $connection->prepare("SELECT * FROM teachers WHERE id = $id");
$stmt->execute();
$rowCat = $stmt->fetch(PDO::FETCH_ASSOC);

$path = $rowCat['photo'];
$teacher = new Teacher();
$teacher->deleteTeacher($id, $path);