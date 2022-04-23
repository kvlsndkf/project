<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Module.class.php');

session_start();

if(isset($_POST['register'])){
    $module = new Module();
    $module->setName($_POST['name']);
    $module->registerModule($module);
}