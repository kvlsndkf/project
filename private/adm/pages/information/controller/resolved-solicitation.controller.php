<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/solicitations/Solicitation.class.php');

session_start();

if (isset($_POST['register'])) {
    $solicitation = new Solicitation();

    $id = $_GET['idSolicitation'];

    echo json_encode($id);

    $solicitation->setStatus("Resolvida");
    $solicitation->setContext($_POST['context_id']);
    $solicitation->setConclusion($_POST['conclusion']);
    $solicitation->resolvedSolicitation($solicitation, $id);
}