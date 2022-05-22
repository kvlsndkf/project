<?php
require_once('/xampp/htdocs' . '/project/classes/schools/Course.class.php');

$course = new Course();

if(isset($_GET['idCourse'])){
    $id = $_GET['idCourse'];

    $list['course'] = $course->listCourseForModal($id);
    $list['teachers'] = $course->selectTeachersUsedByCourse($id);
    $list['schools'] = $course->selectSchoolsUsedByCourse($id);
    $list['subjects'] = $course->selectSubjectsUsedByCourse($id);
}

echo json_encode($list);