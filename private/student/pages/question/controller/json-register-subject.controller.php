<?php
require_once('/xampp/htdocs' . '/project/classes/schools/Subject.class.php');

$subject = new Subject();

if(isset($_GET['course'])){
    $id = $_GET['course'];

    $list['subject'] = $subject->selectSubjectsByCourse($id);
}

echo json_encode($list);