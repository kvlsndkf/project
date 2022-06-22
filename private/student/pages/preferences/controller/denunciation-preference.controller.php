<?php
require_once('/xampp/htdocs' . '/project/classes/denunciations/Denunciation.class.php');

if(isset($_POST['register'])){
    $denunciation = new Denunciation();

    $option = $_POST['denunciation'];
    $linkQuestion = $_POST['post_link'];
    $idCreator = $_POST['createdBy'];
    $idDenouncied = $_POST['denounciedId'];
    $idQuestion = $_POST['questionId'];
    $idPreference = $_POST['preference'];
    $status = "Nova";

    $denunciation->setReason($option);
    $denunciation->setPostLink($linkQuestion);
    $denunciation->setCreatedById($idCreator);
    $denunciation->setDenouncedId($idDenouncied);
    $denunciation->setQuestionId($idQuestion);
    $denunciation->setStatus($status);
    $denunciation->registerDenunciationPreference($denunciation, $idPreference);
}