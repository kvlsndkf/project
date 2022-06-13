<?php
require_once('/xampp/htdocs' . '/project/classes/questions/Question.class.php');
require_once('/xampp/htdocs' . '/project/classes/answers/Answer.class.php');
require_once('/xampp/htdocs' . '/project/classes/users/StudentMethods.class.php');

session_start();

if (isset($_POST['answer'])) {
    $answer = new Answer();

    //question
    $questionID = $_GET['idQuestion'];

    //id creator answer
    $userID = $_SESSION['idUser'];

    echo "oi";

    $student = new StudentMethods();
    $creatorAnswerID = $student->getStudentByUserID($userID);

    $textAnswer = $_POST['textAnswer'];


    if (!isset($textAnswer) || empty($textAnswer)) {
        $_SESSION['statusNegative'] = "Escreva uma resposta para continuar.";
        return header('Location: /project/private/student/pages/answer-question/answer-question.page.php?idQuestion=' . $questionID);
    }

    //photo
    if (!empty($_FILES['photo']['name'])) {

        $answerPhoto = $_FILES['photo'];
        $namePhoto = $answerPhoto['name'];
        $nameId = uniqid();
        $extensionPhoto = strtolower(pathinfo($namePhoto, PATHINFO_EXTENSION));

        if ($answerPhoto['size'] > 2097152) {
            $_SESSION['statusAlert'] = "Arquivo muito grande. Máximo: 2MB.";
            return header('Location: /project/private/student/pages/answer-question/answer-question.page.php?idQuestion=' . $questionID);
        }

        if ($answerPhoto['error']) {
            $_SESSION['statusNegative'] = "Falha ao enviar arquivo.";
            return header('Location: /project/private/student/pages/answer-question/answer-question.page.php?idQuestion=' . $questionID);
        }

        if ($extensionPhoto != "jpg" && $extensionPhoto != "jpeg" && $extensionPhoto != "png") {
            $_SESSION['statusAlert'] = "Tipo de arquivo incorreto. Permitidos: jpg, jpeg e png.";
            return header('Location: /project/private/student/pages/answer-question/answer-question.page.php?idQuestion=' . $questionID);
        }

        if (!isset($_SESSION['statusAlert']) && !isset($_SESSION['statusNegative'])) {
            $pathToSave = "/project/private/student/pages/answer-question/upload/images/" . $nameId . "." . $extensionPhoto;
            $path = "/xampp/htdocs/project/private/student/pages/answer-question/upload/images/" . $nameId . "." . $extensionPhoto;
            $success = move_uploaded_file($answerPhoto["tmp_name"], $path);

            if ($success) {
                $answer->setPhoto($pathToSave);
            } else {
                $_SESSION['statusNegative'] = "Falha ao carregar a imagem, tente novamente...";
                return header('Location: /project/private/student/pages/answer-question/answer-question.page.php?idQuestion=' . $questionID);
            }
        }
    }

    //document
    if (!empty($_FILES['document']['name'])) {

        $answerDocument = $_FILES['document'];
        $nameDocument = $answerDocument['name'];
        $answer->setNameDocument($nameDocument);
        $nameId = uniqid();
        $extensionDocument = strtolower(pathinfo($nameDocument, PATHINFO_EXTENSION));

        if ($answerDocument['size'] > 2097152) {
            $_SESSION['statusAlert'] = "Arquivo muito grande. Máximo: 2MB.";
            return header('Location: /project/private/student/pages/answer-question/answer-question.page.php?idQuestion=' . $questionID);
        }

        if ($answerDocument['error']) {
            $_SESSION['statusNegative'] = "Falha ao enviar documento.";
            return header('Location: /project/private/student/pages/answer-question/answer-question.page.php?idQuestion=' . $questionID);
        }

        if ($extensionDocument != "pdf" && $extensionDocument != "txt" && $extensionDocument != "doc" && $extensionDocument != "ppt" && $extensionDocument != "xml" && $extensionDocument != "xlsx" && $extensionDocument != "pptx" && $extensionDocument != "docx") {
            $_SESSION['statusAlert'] = "Tipo de arquivo incorreto. Permitidos: pdf, txt, doc, docx, xml, xlsx, ppt e pptx.";
            return header('Location: /project/private/student/pages/answer-question/answer-question.page.php?idQuestion=' . $questionID);
        }
        if (is_null($_SESSION['statusAlert']) && is_null($_SESSION['statusNegative'])) {
            $pathToSave = "/project/private/student/pages/answer-question/upload/docs/" . $nameId . "." . $extensionDocument;
            $path = "/xampp/htdocs/project/private/student/pages/answer-question/upload/docs/" . $nameId . "." . $extensionDocument;
            $success = move_uploaded_file($answerDocument["tmp_name"], $path);

            if ($success) {
                $answer->setDocument($pathToSave);
            } else {
                $_SESSION['statusNegative'] = "Falha ao carregar a imagem, tente novamente...";
                return header('Location: /project/private/student/pages/answer-question/answer-question.page.php?idQuestion=' . $questionID);
            }
        }
    }

    //answer
    $answer->setIdQuestion($questionID);
    $answer->setCreatorAnswer($creatorAnswerID[0]['id']);
    $answer->setAnswer($textAnswer);
    $answer->setAvaliation(0);
    $answer->setLikeAnswer(0);
    $answer->registerAnswer($answer);
}
