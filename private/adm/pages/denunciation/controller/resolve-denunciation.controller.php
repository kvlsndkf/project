<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/denunciations/denunciation.class.php');

session_start();

if (isset($_POST['resolveDenunciation'])) {
    $denunciation = new Denunciation();

    $id = $_GET['denunciationID'];

    $denunciation->setStatus("Resolvida");
    $denunciation->setContext($_POST['context']);
    $denunciation->setConclusion($_POST['conclusion']);
    $denunciation->moveResolved($denunciation, $id);
}