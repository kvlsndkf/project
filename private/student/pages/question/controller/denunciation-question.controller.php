<?php
require_once('/xampp/htdocs' . '/project/classes/denunciations/Denunciation.class.php');

session_start();

if(isset($_POST['register'])){
    $denunciation = new Denunciation();

    $option = $_POST['denunciation'];
    $linkQuestion = $_POST['post_link'];
    $idCreator = $_POST['createdBy'];
    $idDenouncied = $_POST['denounciedId'];
    $idQuestion = $_POST['questionId'];
    $status = "Nova";

    $denunciation->setReason($option);
    $denunciation->setPostLink($linkQuestion);
    $denunciation->setCreatedById($idCreator);
    $denunciation->setDenouncedId($idDenouncied);
    $denunciation->setQuestionId($idQuestion);
    $denunciation->setStatus($status);
    $denunciation->setType("Pergunta");
    $denunciation->registerDenunciation($denunciation);
}
