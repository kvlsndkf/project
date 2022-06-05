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

    $xp = $category == 3 ? 100 : 300;

    $question = new Question();

    $textQuestion = $_POST['textQuestion'];

    $userID = $_SESSION['idUser'];

    $student = new Student();
    $studentID = $student->getStudentByUserID($userID);

    if (!isset($course)) {
        $_SESSION['statusNegative'] = "Selecione um curso para continuar.";
        return header('Location: /project/private/student/pages/question/question.page.php');
    }

    if (!isset($subject)) {
        $_SESSION['statusNegative'] = "Selecione uma matéria para continuar.";
        return header('Location: /project/private/student/pages/question/question.page.php');
    }

    if (!isset($category)) {
        $_SESSION['statusNegative'] = "Selecione uma categoria para continuar.";
        return header('Location: /project/private/student/pages/question/question.page.php');
    }

    if (!isset($textQuestion) || empty($textQuestion)) {
        $_SESSION['statusNegative'] = "Escreva uma pergunta para continuar.";
        return header('Location: /project/private/student/pages/question/question.page.php');
    }

    if (!empty($_FILES['photo']['name'])) {
        echo "oi p";
        $questionPhoto = $_FILES['photo'];
        $namePhoto = $questionPhoto['name'];
        $nameId = uniqid();
        $extensionPhoto = strtolower(pathinfo($namePhoto, PATHINFO_EXTENSION));

        if ($questionPhoto['size'] > 2097152) {
            $_SESSION['statusAlert'] = "Arquivo muito grande. Máximo: 2MB.";
            return header('Location: /project/private/student/pages/question/question.page.php');
        }

        if ($questionPhoto['error']) {
            $_SESSION['statusNegative'] = "Falha ao enviar arquivo.";
            return header('Location: /project/private/student/pages/question/question.page.php');
        }

        if ($extensionPhoto != "jpg" && $extensionPhoto != "jpeg" && $extensionPhoto != "png") {
            $_SESSION['statusAlert'] = "Tipo de arquivo incorreto. Permitidos: jpg, jpeg e png.";
            return header('Location: /project/private/student/pages/question/question.page.php');
        }

        if (!isset($_SESSION['statusAlert']) && !isset($_SESSION['statusNegative'])) {
            $pathToSave = "/project/private/student/pages/question/upload/images/" . $nameId . "." . $extensionPhoto;
            $path = "/xampp/htdocs/project/private/student/pages/question/upload/images/" . $nameId . "." . $extensionPhoto;
            $success = move_uploaded_file($questionPhoto["tmp_name"], $path);

            if ($success) {
                $question->setPhoto($pathToSave);
            } else {
                $_SESSION['statusNegative'] = "Falha ao carregar a imagem, tente novamente...";
                return header('Location: /project/private/student/pages/question/question.page.php');
            }
        }
    }

    if (!empty($_FILES['document']['name'])) {
        $questionDocument = $_FILES['document'];
        $nameDocument = $questionDocument['name'];
        $question->setNameDocument($nameDocument);
        $nameId = uniqid();
        $extensionDocument = strtolower(pathinfo($nameDocument, PATHINFO_EXTENSION));

        if ($questionDocument['size'] > 2097152) {
            $_SESSION['statusAlert'] = "Arquivo muito grande. Máximo: 2MB.";
            return header('Location: /project/private/student/pages/question/question.page.php');
        }

        if ($questionDocument['error']) {
            $_SESSION['statusNegative'] = "Falha ao enviar documento.";
            return header('Location: /project/private/student/pages/question/question.page.php');
        }

        if ($extensionDocument != "pdf" && $extensionDocument != "txt" && $extensionDocument != "doc" && $extensionDocument != "ppt" && $extensionDocument != "xml") {
            $_SESSION['statusAlert'] = "Tipo de arquivo incorreto. Permitidos: pdf, txt, doc, xml, e ppt.";
            return header('Location: /project/private/student/pages/question/question.page.php');
        }
        if (is_null($_SESSION['statusAlert']) && is_null($_SESSION['statusNegative'])) {
            $pathToSave = "/project/private/student/pages/question/upload/docs/" . $nameId . "." . $extensionDocument;
            $path = "/xampp/htdocs/project/private/student/pages/question/upload/docs/" . $nameId . "." . $extensionDocument;
            $success = move_uploaded_file($questionDocument["tmp_name"], $path);
            
            if ($success) {
                $question->setDocument($pathToSave);
            } else {
                $_SESSION['statusNegative'] = "Falha ao carregar a imagem, tente novamente...";
                return header('Location: /project/private/student/pages/question/question.page.php');
            }
        }
    }

    $question->setXp($xp);
    $question->setQuestion($textQuestion);
    $question->setCourse($course);
    $question->setSubject($subject);
    $question->setCategory($category);
    $question->setStudent($studentID[0]['id']);
    $question->registerQuestion($question);
}
