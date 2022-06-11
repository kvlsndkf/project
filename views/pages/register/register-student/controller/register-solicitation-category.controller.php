<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/solicitations/Solicitation.class.php');

session_start();

if(isset($_POST['register'])){
    $solicitations = new Solicitation();
    $solicitations->setContact($_POST['contact']);
    $solicitations->setCategory($_POST['selectCategory_id']);
    $solicitations->setTitle($_POST['title']);
    $solicitations->setDescription($_POST['description']);
    $solicitations->setStatus("Nova");
    $solicitations->registerSolicitation($solicitations);
}


