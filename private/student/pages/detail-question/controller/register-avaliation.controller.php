<?php
// header('Location: /project/views/pages/login/login-page.php');
require_once('/xampp/htdocs' . '/project/classes/answers/Answer.class.php');

if(isset($_POST['stars'])){
    
    $answerID = $_POST['answerId'];
    $questionID = $_POST['questionId'];
    $personAvaliationID = $_POST['studentId'];

    $answer = new Answer();
    $answer->setAvaliation($_POST['stars']);
    $answer->registerAvaliation($answer, $questionID, $answerID, $personAvaliationID);
}