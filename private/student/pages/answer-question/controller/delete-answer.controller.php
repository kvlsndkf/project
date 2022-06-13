<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/answers/Answer.class.php');

session_start();

$answerID = $_GET['idAnswer'];
$questionID = $_GET['idQuestion'];
$studentID = $_GET['idStudent'];

$answer = new Answer();

$connection = Connection::connection();
$stmt = $connection->prepare("SELECT * FROM answers WHERE id = $answerID");
$stmt->execute();
$rowsAnswer = $stmt->fetch(PDO::FETCH_ASSOC);

$pathPhoto = $rowsAnswer['photo'];
$pathDocument = $rowsAnswer['document'];

$answer->deleteAnswer($answerID, $pathPhoto, $pathDocument, $questionID, $studentID);
