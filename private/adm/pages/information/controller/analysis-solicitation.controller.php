<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/solicitations/Solicitation.class.php');

session_start();

if (isset($_POST['analysisRequest'])) {
    $solicitation = new Solicitation();

    $id = $_GET['solicitationNewID'];

    $solicitation->setStatus("Análise");
    $solicitation->analysisSolicitation($solicitation, $id);
}