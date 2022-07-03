<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Module.class.php');

session_start();

$id = $_GET['id'];

$connection = Connection::connection();
$stmt = $connection->prepare("SELECT * FROM modules WHERE id = $id");
$stmt->execute();
$module = new Module();
$module->deleteModule($id);