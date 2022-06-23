<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/denunciations/denunciation.class.php');

session_start();

if (isset($_POST['moveDenunciation'])) {
    $denunciation = new Denunciation();

    $id = $_GET['denunciationID'];

    $denunciation->setStatus("Em análise");
    $denunciation->moveToAnalysis($denunciation, $id);
}