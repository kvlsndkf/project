<?php
require_once('/xampp/htdocs' . '/project/classes/denunciations/Denunciation.class.php');

if(isset($_POST['register'])){
    $denunciation = new Denunciation();

    $option = $_POST['denunciation'];
    $linkQuestion = $_POST['post_link'];
    $idCreator = $_POST['createdBy'];
    $idDenouncied = $_POST['denounciedId'];
    $idAnswer = $_POST['answerId'];
    $status = "Nova";

    $denunciation->setReason($option);
    $denunciation->setPostLink($linkQuestion);
    $denunciation->setCreatedById($idCreator);
    $denunciation->setDenouncedId($idDenouncied);
    $denunciation->setAnswerId($idAnswer);
    $denunciation->setStatus($status);
    $denunciation->registerDenunciation($denunciation);
}