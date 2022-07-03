<?php
require_once('/xampp/htdocs' . '/project/classes/denunciations/Denunciation.class.php');

session_start();

if(isset($_POST['register'])){
    $denunciation = new Denunciation();

    $option = $_POST['denunciation'];
    $linkQuestion = $_POST['post_link'];
    $idCreator = $_POST['createdBy'];
    $idDenouncied = $_POST['denounciedId'];
    $idAnswer = $_POST['answerId'];
    $status = "Nova";
    $idQuestion = $_POST['questionId'];

    $denunciation->setReason($option);
    $denunciation->setPostLink($linkQuestion);
    $denunciation->setCreatedById($idCreator);
    $denunciation->setDenouncedId($idDenouncied);
    $denunciation->setAnswerId($idAnswer);
    $denunciation->setStatus($status);
    $denunciation->setType("Resposta");
    $denunciation->setQuestionId($idQuestion);
    $denunciation->registerDenunciationAnswer($denunciation);
}