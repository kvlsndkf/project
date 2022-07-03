<?php
require_once('/xampp/htdocs' . '/project/classes/denunciations/Denunciation.class.php');

session_start();

if(isset($_POST['register'])){
    $denunciation = new Denunciation();

    $option = $_POST['denunciation'];
    $linkProfile = $_POST['post_link'];
    $idCreator = $_POST['createdBy'];
    $idDenouncied = $_POST['denounciedId'];
    $profileID = $_POST['idSudentProfile'];
    $status = "Nova";

    $denunciation->setReason($option);
    $denunciation->setPostLink($linkProfile);
    $denunciation->setCreatedById($idCreator);
    $denunciation->setDenouncedId($idDenouncied);
    $denunciation->setStatus($status);
    $denunciation->setType("Perfil");
    $denunciation->registerDenunciationProfile($denunciation, $profileID);
}