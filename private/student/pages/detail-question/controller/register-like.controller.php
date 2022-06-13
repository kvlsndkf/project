<?php
require_once('/xampp/htdocs' . '/project/classes/answers/Answer.class.php');

if(isset($_POST['studentId'])){
    
    $answerID = $_POST['answerId'];
    $questionID = $_POST['questionId'];
    $personLikeID = $_POST['studentId'];

    $answer = new Answer();
    $answer->registerLike($questionID, $answerID, $personLikeID);
}