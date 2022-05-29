<?php
require_once('/xampp/htdocs' . '/project/classes/schools/Course.class.php');

$course = new Course();

if(isset($_GET['nameSchool'])){
    $name = $_GET['nameSchool'];

    $list['course'] = $course->selectCoursesUsedBySchool($name);
}

echo json_encode($list);