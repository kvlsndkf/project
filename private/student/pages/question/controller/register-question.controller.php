<?php
require_once('/xampp/htdocs' . '/project/classes/questions/Question.class.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Course.class.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Subject.class.php');
require_once('/xampp/htdocs' . '/project/classes/categories/Category.class.php');
require_once('/xampp/htdocs' . '/project/classes/users/Student.class.php');

if (isset($_POST['question'])) {
    $course = new Course();
    $course = $_POST['course'];

    $subject = new Subject();
    $subject = $_POST['subject'];

    $category = new Category();
    $category = $_POST['category'];

    $question = new Question();

    $xp = $category === "Apoio" ? 100 : 300;

    $textQuestion = $_POST['textQuestion'];

    $userID = $_SESSION['idUser'];

    $student = new Student();
    $studentID = $student->getStudentByUserID($userID);

    if (!isset($course)) {
        $_SESSION['statusNegative'] = "Selecione um curso para continuar.";
        return header('Location: /project/views/pages/question/question.page.php');
    }

    if (!isset($subject)) {
        $_SESSION['statusNegative'] = "Selecione uma matéria para continuar.";
        return header('Location: /project/views/pages/question/question.page.php');
    }

    if (!isset($category)) {
        $_SESSION['statusNegative'] = "Selecione uma categoria para continuar.";
        return header('Location: /project/views/pages/question/question.page.php');
    }

    if (!isset($textQuestion) || empty($textQuestion)) {
        $_SESSION['statusNegative'] = "Escreva uma pergunta para continuar.";
        return header('Location: /project/private/student/pages/question/question.page.php');
    }

    $question->setXp($xp);
    $question->setQuestion($textQuestion);
    $question->setCourse($course);
    $question->setSubject($subject);
    $question->setCategory($category);
    $question->setStudent($studentID[0]['id']);
    $question->registerQuestion($question);
}
