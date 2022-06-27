<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/denunciations/denunciation.class.php');

session_start();

if (isset($_POST['resolveDenunciation'])) {
    $denunciation = new Denunciation();

    $id = $_GET['denunciationID'];
    $questionID = $_GET['questionID'] ?? '';
    $type = $_GET['type'];
    $answerID = $_GET['answerId'] ?? '';
    $userID = $_GET['denounced'] ?? '';

    $denunciation->setStatus("Resolvida");
    $denunciation->setContext($_POST['context']);
    $denunciation->setConclusion($_POST['conclusion']);
    $denunciation->setType($type);
    $denunciation->moveResolved($denunciation, $id, $questionID, $answerID, $userID);
}