<?php
require_once('/xampp/htdocs' . '/project/classes/schools/School.class.php');

$school = new School();

if(isset($_GET['idSchool'])){
    $id = $_GET['idSchool'];

    $list['school'] = $school->listSchoolForModal($id);
    $list['teachers'] = $school->selectTeachersUsedBySchool($id);
}

echo json_encode($list);