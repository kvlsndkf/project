<?php
require_once('/xampp/htdocs' . '/project/classes/cookies/Cookie.class.php');
require_once('/xampp/htdocs' . '/project/classes/users/Student.class.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Course.class.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Module.class.php');
require_once('/xampp/htdocs' . '/project/classes/schools/School.class.php');

if(isset($_POST['step4'])){
    
    //--------------------------------------
    //table users
    $email = Cookie::reader('email');
    $password = Cookie::reader('password');
    $photo = Cookie::reader('photoUser');
    $typeUser = 'student';
    $github = Cookie::reader('github') ?? '';
    $linkedin = Cookie::reader('linkedin') ?? '';
    $facebook = Cookie::reader('facebook') ?? '';
    $instagram = Cookie::reader('instagram') ?? '';

    //---------------------------------------
    //table student
    $firstName = Cookie::reader('firstName');
    $surname = Cookie::reader('surname');
    $courseName = Cookie::reader('nameCourse');
    $moduleName = Cookie::reader('nameModule');

    $course = new Course();
    $idCourse = $course->getIdCourseByName($courseName);

    $module = new Module();
    $idModule = $module->getIdModuleByName($moduleName);

    //---------------------------------------
    //table preferences
    $preferences = $_POST['idCourses'] ?? [];
    $arrayCourse = array($idCourse);
    
    $arrayPreferences = array_merge($preferences, $arrayCourse);
    
    //---------------------------------------
    //table school
    $schoolName = Cookie::reader('nameSchool');

    $school = new School();
    $idSchool = $school->getIdSchoolByName($schoolName);

    //---------------------------------------
    //set users
    $student = new Student();
    $student->setEmail($email);
    $student->setPassword(password_hash($password, PASSWORD_DEFAULT));
    $student->setPhoto($photo);
    $student->setTypeUser($typeUser);
    $student->setGithub($github);
    $student->setLinkedin($linkedin);
    $student->setFacebook($facebook);
    $student->setInstagram($instagram);

    //---------------------------------------
    //set preferences
    $student->setPreferences($arrayPreferences);

    //---------------------------------------
    //set student
    $student->setFirstName($firstName);
    $student->setSurname($surname);
    $student->setCourseId($idCourse);
    $student->setModuleId($idModule);

    //---------------------------------------
    //set school
    $student->setSchoolId($idSchool);

    //---------------------------------------
    //action
    $student->registerStudent($student);

    //---------------------------------------
    //drop cookie
    Cookie::delete('email');
    Cookie::delete('password');
    Cookie::delete('confirm-password');
    Cookie::delete('photoUser');
    Cookie::delete('github');
    Cookie::delete('linkedin');
    Cookie::delete('facebook');
    Cookie::delete('instagram');
    Cookie::delete('firstName');
    Cookie::delete('surname');
    Cookie::delete('nameCourse');
    Cookie::delete('nameModule');
    Cookie::delete('nameSchool');
}