<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/questions/Question.class.php');

session_start();

$id = $_GET['id'];

$question = new Question();

$hasAnswers = $question->hasAnswers($id);

if ($hasAnswers == true) {
    $_SESSION['statusNegative'] = "Questão não pode ser apagada.";
    return header('Location: /project/private/student/pages/detail-question/detail-question.page.php?idQuestion=' . $id);

} else {
    $connection = Connection::connection();
    $stmt = $connection->prepare("SELECT * FROM questions WHERE id = $id");
    $stmt->execute();
    $rowsQuestion = $stmt->fetch(PDO::FETCH_ASSOC);

    $pathPhoto = $rowsQuestion['photo'];
    $pathDocument = $rowsQuestion['document'];

    $question->deleteQuestion($id, $pathPhoto, $pathDocument);
}