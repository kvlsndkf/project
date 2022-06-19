<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-student.controller.php');
require_once('/xampp/htdocs' . '/project/classes/questions/Question.class.php');
require_once('/xampp/htdocs' . '/project/classes/answers/Answer.class.php');
require_once('/xampp/htdocs' . '/project/classes/users/StudentMethods.class.php');

try {
    $id = $_GET['idQuestion'];
    $question = new Question();
    $listDetailsQuestions = $question->listDetailsQuestion($id);
    $creatorQuestion = $question->getCreatorQuestionById($id);
    $questionHasAnswers = $question->hasAnswers($id);

    $idUser = $_SESSION['idUser'];


    $student = new StudentMethods();
    $studentId = $student->getStudentByUserID($idUser);
    $userCreatorQuestion = $student->getUserByStudentID($creatorQuestion[0]['student_id']);

    $userCreatorAnswer = $student->getUserByStudentID($creatorQuestion[0]['student_id']);

    $studentPerfil = $student->getDataStudentByID($studentId[0]['id']);

    $answer = new Answer();
    $listAnswers = $answer->listAnswer($id, $studentId);
} catch (Exception $e) {
    echo $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../../views/images/favicon/favicon-16x16.png" type="image/x-icon">
    <title>Pergunta sobre <?php echo $listDetailsQuestions->subject; ?> | Heelp!</title>

    <!-- Include stylesheet -->
    <link href="../../../style/editor-style/editor.style.css" rel="stylesheet">

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="../../../../libs/dist/magnific-popup.css">

    <!-- CSS Avaliation -->
    <link rel="stylesheet" href="./style/avaliation.style.css">

    <!-- CSS Like -->
    <link rel="stylesheet" href="./style/like.style.css">

    <!-- Estilos -->
    <link rel="stylesheet" href="../../../../views/styles/style.global.css">
    <link rel="stylesheet" href="../../../../views/styles/fonts.style.css">
    <link rel="stylesheet" href="../../../style/modal-about.style.css">
    <link rel="stylesheet" href="../../../adm/pages/register/register.styles.css">
    <link rel="stylesheet" href="../../../adm/pages/register/registration panel/registration-panel-style.css">
    <link rel="stylesheet" href="../../styles/feed.style.css">

</head>

<body>

    <div class="wrapper">

        <nav class="feed-leftbar">

            <div class="leftbar-top">

                <a href="#" class="feed-logo">
                    <img src="../../../../views/images/logo/logo-help.svg" alt="" class="logo-heelp-img">
                    <h4 class="logo-heelp-text normal-22-black-title-1">heelp!</h4>
                </a>

                <ul class="feed-ul">

                    <li class="sidebar-li leftbar-li">
                        <a href="../home/home.page.php" class="sidebar-a-items leftbar-a">
                            <img class="leftbar-icon" src="../../../../views/images/components/dashboard-img.svg" alt="">
                            <p class="normal-18-bold-title-2 leftbar-text">Feed</p>
                        </a>
                    </li>

                    <li class="sidebar-li leftbar-li">
                        <a href="#" class="sidebar-a leftbar-a">
                            <img class="leftbar-icon" src="../../../../views/images/components/following-icon.svg" alt="">
                            <p class="leftbar-text normal-18-bold-title-2">Seguindo</p>
                        </a>
                    </li>

                    <li class="sidebar-li leftbar-li">
                        <a href="#" class="sidebar-a leftbar-a">
                            <img class="leftbar-icon" src="../../../../views/images/components/notifications-icon.svg" alt="">
                            <p class="leftbar-text normal-18-bold-title-2">Notificações</p>
                        </a>
                        <hr class="sidebar-linha leftbar-linha">
                    </li>

                    <li class="sidebar-li leftbar-li">
                        <p class="leftbar-categoria normal-14-bold-p">Para você</p>
                    </li>

                    <li class="sidebar-li leftbar-li">
                        <a href="../question/question.page.php" class="pedir-heelp-button-a normal-14-bold-p">
                            <div class="leftbar-button-div">
                                <p class="sidebar-button-text">Pedir um heelp!</p>
                            </div>
                        </a>
                    </li>

                </ul>


            </div>

            <div class="leftbar-bottom">

                <div class="bottom-header">

                    <a href="../detail-perfil-student/detail-perfil-student.page.php?idStudent=<?php echo $studentPerfil->id; ?>" target="_blank">
                        <div class="bottom-photo-div">
                            <img src="<?php echo $studentPerfil->photo; ?>" alt="<?php echo $studentPerfil->firstName; ?>" class="bottom-photo-img">
                        </div>
                    </a>

                    <!-- Mais Opções -->
                    <div class="drop-edit-exclud-about drop-leftbar">
                        <img src="../../../../views/images/components/three-dots.svg">

                        <!-- Parte do Update e Delete -->
                        <div class="drop-edit-exclud-content-about drop-leftbar-content">
                            <a href="../detail-perfil-student/update-perfil-student.page.php?idStudentLogged=<?php echo $studentPerfil->id; ?>" target="_blank" class="drop-edit-exclud-a">
                                <div class="drop-edit-exclud-option-about">
                                    <img src="../../../../views/images/components/settings-icon.svg" class="drop-edit-exclud-img">
                                    <p class="drop-edit-exclud-text-about normal-14-bold-p">Configurações</p>
                                </div>
                            </a>
                            <div class=" pedir-heelp-button-a">
                                <a href="../../../logout/logout.controller.php" class="drop-edit-exclud-a pedir-heelp-button-a">
                                    <div class="drop-edit-exclud-option-about pedir-heelp-button-a drop-sair">
                                        <img src="../../../../views/images/components/logout-icon.svg" class="drop-edit-exclud-img">
                                        <p class="drop-edit-exclud-text-about normal-14-bold-p">Sair</p>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>

                </div>


                <div class="bottom-xp-div">
                    <p class="normal-12-medium-tiny white-text bottom-xp-text">
                        <?php echo $studentPerfil->xp; ?>
                        xp
                    </p>
                </div>


                <a class="normal-16-bold-title-3 white-text bottom-name" href="../detail-perfil-student/detail-perfil-student.page.php?idStudent=<?php echo $studentPerfil->id; ?>" target="_blank">
                    <?php echo $studentPerfil->firstName;
                    echo " " . $studentPerfil->surname; ?>
                </a>

            </div>

        </nav>
        <div class="corpo-feed">

            <!-- Mensagem de sucesso ⬇️ -->
            <?php if (isset($_SESSION['statusPositive']) && $_SESSION != '') { ?>

                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </symbol>
                </svg>

                <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    <div>
                        <strong>Tudo certo!</strong>
                        <?php echo $_SESSION['statusPositive']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            <?php unset($_SESSION['statusPositive']);
            } ?>

            <!-- Mensagem de erro ⬇️ -->
            <?php if (isset($_SESSION['statusNegative']) && $_SESSION != '') { ?>

                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </symbol>
                </svg>

                <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div>
                        <strong>Ops...</strong>
                        <?php echo $_SESSION['statusNegative']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            <?php unset($_SESSION['statusNegative']);
            } ?>

            <div class="feed-div">

                <div class="space-between-header">

                    <p class="margin-60">
                        <span class="badge rounded-pill bg-primary"> <?php echo $listDetailsQuestions->course; ?></span>

                        <?php
                        if ($listDetailsQuestions->category === "Erro") {
                            $styleError = 'badge rounded-pill bg-danger';
                            $styleQuestion = 'd-none';
                            $styleHelp = 'd-none';
                        }

                        if ($listDetailsQuestions->category === "Dúvida") {
                            $styleError = 'd-none';
                            $styleQuestion = 'badge rounded-pill bg-info';
                            $styleHelp = 'd-none';
                        }

                        if ($listDetailsQuestions->category === "Apoio") {
                            $styleError = 'd-none';
                            $styleQuestion = 'd-none';
                            $styleHelp = 'badge rounded-pill bg-success';
                        }
                        ?>
                        <span class="<?php echo $styleError; ?>"> <?php echo $listDetailsQuestions->category; ?></span>
                        <span class="<?php echo $styleQuestion; ?>"> <?php echo $listDetailsQuestions->category; ?></span>
                        <span class="<?php echo $styleHelp; ?>"> <?php echo $listDetailsQuestions->category; ?></span>
                        <span class="badge rounded-pill bg-little-blue"> <?php echo $listDetailsQuestions->subject; ?></span>
                    </p>


                    <?php
                    $creatorQuestionID = $creatorQuestion[0]['student_id'];
                    $studentID = $studentId[0]['id'];

                    $styleDelete = $creatorQuestionID == $studentID ? '' : 'd-none';
                    $styleDeleteDisplay = $questionHasAnswers || $listDetailsQuestions->isDenounced != false ? 'd-none' : '';

                    $styleDenunciationQuestion = $creatorQuestionID == $studentID ? 'd-none' : '';
                    ?>

                    <!-- Mais Opções -->
                    <div class="drop-edit-exclud-about drop-edit-exclud-about2">
                        <img src="../../../../views/images/components/three-dots.svg">

                        <!-- Parte do Update e Delete -->
                        <div class="drop-edit-exclud-content-about">
                            <a href="" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $listDetailsQuestions->id; ?>" class="drop-edit-exclud-a <?php echo $styleDenunciationQuestion; ?>">
                                <div class="drop-edit-exclud-option-about">
                                    <img src="../../../../views/images/components/denunciar-icon.svg" class="drop-edit-exclud-img">
                                    <p class="drop-edit-exclud-text-about normal-14-bold-p">Denunciar</p>
                                </div>
                            </a>
                            <a href="<?php echo $listDetailsQuestions->linkQuestion; ?>" class="d-none drop-edit-exclud-a" id="linkQuestion">Link
                                <div class="drop-edit-exclud-option-about">
                                    <img src="../../../../views/images/components/link-icon.svg" class="drop-edit-exclud-img">
                                    <p class="drop-edit-exclud-text-about normal-14-bold-p">Copiar Link</p>
                                </div>
                            </a>
                            <a class="drop-edit-exclud-a">
                                <div class="drop-edit-exclud-option-about">
                                    <img src="../../../../views/images/components/link-icon.svg" class="drop-edit-exclud-img">
                                    <span onclick="copyLink()" id="spanLink" class="drop-edit-exclud-text-about normal-14-bold-p">
                                        Copiar link
                                    </span>
                                </div>
                            </a>
                            <div class="<?php echo $styleDelete; ?> <?php echo $styleDeleteDisplay; ?> pedir-heelp-button-a">
                                <a href="../question/controller/delete-question.controller.php?id=<?php echo $listDetailsQuestions->id; ?>" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete" class="drop-edit-exclud-a pedir-heelp-button-a">
                                    <div class="drop-edit-exclud-option-about pedir-heelp-button-a">
                                        <img src="../../../../views/images/components/delete-bin.svg" class="drop-edit-exclud-img">
                                        <p class="drop-edit-exclud-text-about normal-14-bold-p">Excluir</p>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="question-info">

                    <a href="<?php echo $listDetailsQuestions->linkProfile; ?>" target="_blank">
                        <img src="<?php echo $listDetailsQuestions->photo; ?>" alt="<?php echo $listDetailsQuestions->firstName; ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50px; margin-right: 8px;">
                    </a>
                    <div class="question-info-text">
                        <a href="<?php echo $listDetailsQuestions->linkProfile; ?>" target="_blank" class="question-name question-about-a normal-14-medium-p">
                            <?php echo $listDetailsQuestions->firstName; ?>
                            <?php echo $listDetailsQuestions->surname; ?>
                        </a>


                        <div class="question-about normal-12-medium-tiny">
                            <?php echo $listDetailsQuestions->created; ?>
                            •
                            <?php echo $listDetailsQuestions->module; ?>
                            •
                            <?php echo $listDetailsQuestions->school; ?>
                        </div>
                    </div>

                </div>

                <div class="question-core">
                    <!-- Create the editor container -->
                    <div class="ql-snow ql-editor2">
                        <div class="ql-editor2 question-text-div">
                            <span class="question-text-p white-text line-clamp-2 whitney-16-medium-text" id="questionText-<?php echo $listDetailsQuestions->id; ?>">
                                <?php echo $listDetailsQuestions->question; ?>
                            </span>
                            
                            <button class="read-btn-question normal-14-bold-p" id="readMore-newMessages-<?php echo $listDetailsQuestions->id; ?>" onclick="document.querySelector('#questionText-<?php echo $listDetailsQuestions->id; ?>').classList.remove('line-clamp-2');
                            document.querySelector('#readLess-newMessages-<?php echo $listDetailsQuestions->id; ?>').style.display = 'inline';
                            document.querySelector('#readMore-newMessages-<?php echo $listDetailsQuestions->id; ?>').style.display = 'none';">
                                Ler mais...
                            </button>

                            <button class="read-btn-question normal-14-bold-p" id="readLess-newMessages-<?php echo $listDetailsQuestions->id; ?>" onclick="document.querySelector('#questionText-<?php echo $listDetailsQuestions->id; ?>').classList.add('line-clamp-2');
                            document.querySelector('#readLess-newMessages-<?php echo $listDetailsQuestions->id; ?>').style.display = 'none';
                            document.querySelector('#readMore-newMessages-<?php echo $listDetailsQuestions->id; ?>').style.display = 'inline';">
                                Ler menos...
                            </button>

                            <!-- JS Read More Text -->
                            <script>
                                var questionText = document.getElementById('questionText-<?php echo $listDetailsQuestions->id; ?>');

                                var readMoreNew = document.getElementById('readMore-newMessages-<?php echo $listDetailsQuestions->id; ?>');
                                var readLessNew = document.getElementById('readLess-newMessages-<?php echo $listDetailsQuestions->id; ?>');

                                //se o tamanho da mensagem passar o tamanho da caixa de texto, ou seja, com mais de 2 linhas
                                if (questionText.scrollHeight > questionText.offsetHeight) {

                                    // Se ele estiver com o ..., precisa ter o "ler mais"
                                    if (questionText.classList.contains("line-clamp-2")) {
                                        readMoreNew.style.display = "inline";
                                        readLessNew.style.display = "none";
                                    }

                                    //se o texto nao tem mais de 2 linhas, nao precisa ter botão
                                } else {
                                    readLessNew.style.display = "none";
                                    readMoreNew.style.display = "none";
                                }
                            </script>
                        </div>
                    </div>

                    <?php $styleImageQuestion = !empty($listDetailsQuestions->image) ? '' : 'd-none'; ?>
                    <p class="<?php echo $styleImageQuestion; ?>  image-question">
                        <a href="<?php echo $listDetailsQuestions->image; ?>" class="image-link question-img">
                            <img src="<?php echo $listDetailsQuestions->image; ?>" alt="<?php echo $listDetailsQuestions->firstName; ?>" style="width: 150px;">
                        </a>
                    </p>

                    <?php $styleDocumentQuestion = !empty($listDetailsQuestions->document) ? '' : 'd-none'; ?>
                    <p class="<?php echo $styleDocumentQuestion; ?> document-question">
                        <span class="document-icon">
                            <img src="../../../../views/images/components/file-icon.svg">
                        </span>
                        <span class="normal-14-medium-p white-text text-truncate document-name">
                            <?php echo $listDetailsQuestions->documentName; ?>
                        </span>
                        <a href="<?php echo $listDetailsQuestions->document; ?>" class="download-file-button" download="<?php echo $listDetailsQuestions->documentName; ?>">
                            <img src="../../../../views/images/components/download-icon.svg" alt="">
                        </a>
                    </p>

                    <div class="question-footer">

                        <?php
                        $answer = new Answer();
                        $totalAnswersOfQuestion = $answer->countAnswers($listDetailsQuestions->id);

                        $styleCounter = empty($totalAnswersOfQuestion) ? 'question-footer-div' : 'question-answers question-footer-div';
                        ?>
                        <div class="<?php echo $styleCounter; ?>" id="respostaQuant">
                            <p class="normal-14-bold-p white-text question-p">
                                <?php echo $totalAnswersOfQuestion; ?>
                            </p>

                        </div>

                        <a class="question-give-heelp-a pedir-heelp-button-a" href="../answer-question/answer-question.page.php?idQuestion=<?php echo $listDetailsQuestions->id; ?>">
                            <div class="question-toAnswer question-footer-div">

                                <p class="normal-14-bold-p question-p white-text">Dar um help</p>
                                <img src="../../../../views/images/components/upper-line.svg" class="upper-line">
                                <img src="../../../../views/images/components/star-icon.svg" class="xp-star">
                                <p class="normal-14-bold-p question-p yellow-text"> <?php echo $listDetailsQuestions->xp; ?> xp </p>

                            </div>
                        </a>

                    </div>
                </div>

                <!-- Modal Question -->
                <div class="modal fade" id="modal-<?php echo $listDetailsQuestions->id; ?>" tabindex="-1" aria-labelledby="modalLabel-<?php echo $listDetailsQuestions->id; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel-<?php echo $listDetailsQuestions->id; ?>">Relatar um problema</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Nos ajude a entender o problema, o que está acontecendo com esse post?

                                <form action="../question/controller/denunciation-question.controller.php" method="post">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="denunciation" id="radio1-<?php echo $listDetailsQuestions->id; ?>" value="Não tenho interesse nesse post" required>
                                        <label class="form-check-label" for="radio1-<?php echo $listDetailsQuestions->id; ?>">
                                            Não tenho interesse nesse post
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="denunciation" id="radio2-<?php echo $listDetailsQuestions->id; ?>" value="É suspeito ou está enviando span">
                                        <label class="form-check-label" for="radio2-<?php echo $listDetailsQuestions->id; ?>">
                                            É suspeito ou está enviando span
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="denunciation" id="radio3-<?php echo $listDetailsQuestions->id; ?>" value="É abusivo ou nocivo">
                                        <label class="form-check-label" for="radio3-<?php echo $listDetailsQuestions->id; ?>">
                                            É abusivo ou nocivo
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="denunciation" id="radio4-<?php echo $listDetailsQuestions->id; ?>" value="As informações são enganosas">
                                        <label class="form-check-label" for="radio4-<?php echo $listDetailsQuestions->id; ?>">
                                            As informações são enganosas
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="denunciation" id="radio5-<?php echo $listDetailsQuestions->id; ?>" value="Manifesta intenções de automutilação ou suicídio">
                                        <label class="form-check-label" for="radio5-<?php echo $listDetailsQuestions->id; ?>">
                                            Manifesta intenções de automutilação ou suicídio
                                        </label>
                                    </div>

                                    <div>
                                        <input type="hidden" name="post_link" id="" value="<?php echo $listDetailsQuestions->linkQuestion; ?>">
                                        <input type="hidden" name="createdBy" id="" value="<?php echo $idUser; ?>">
                                        <input type="hidden" name="denounciedId" id="" value="<?php echo $userCreatorQuestion[0]['user_id']; ?>">
                                        <input type="hidden" name="questionId" id="" value="<?php echo $listDetailsQuestions->id; ?>">
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="register" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="detail-question-hr">

                <p class="normal-18-bold-title-2 white-text question-p">
                    Respostas
                </p>

                <hr class="detail-question-hr">

                <?php $styleListAnswers = !empty($listAnswers) ? '' : 'd-none';

                ?>
                <div class="<?php echo $styleListAnswers; ?>">

                    <!-- Lista de respostas ⬇️ -->
                    <?php for ($i = 0; $i < count($listAnswers); $i++) {
                        $row = $listAnswers[$i] ?>

                        <?php
                        $creatorAnswer = $answer->getAnswerCreatorById($row->id, $id);
                        $creatorAnswerID = $creatorAnswer[0]['answer_creator_id'];
                        $studentID = $studentId[0]['id'];

                        $styleDeleteAnswer = $creatorAnswerID == $studentID ? '' : 'd-none';

                        $styleAnswerDisplay = $row->isDenounced != false ? 'd-none' : '';

                        $styleDenunciationAnswer = $creatorAnswerID == $studentID ? 'd-none' : '';
                        ?>

                        <div class="space-between-header">

                            <div class="question-info">
                                <a href="<?php echo $row->linkProfile; ?>" target="_blank">
                                    <img src="<?php echo $row->photo; ?>" alt="<?php echo $row->firstName; ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50px; margin-right: 8px;">
                                </a>
                                <div class="question-info-text">
                                    <a href="<?php echo $row->linkProfile; ?>" target="_blank" class="question-name question-about-a normal-14-medium-p">
                                        <?php echo $row->firstName; ?>
                                        <?php echo $row->surname; ?>
                                    </a>
                                    <div class="question-about normal-12-medium-tiny">
                                        <?php echo $row->created; ?>
                                        •
                                        <?php echo $row->module; ?>
                                        •
                                        <?php echo $row->school; ?>
                                    </div>
                                </div>
                            </div>

                            <a href="../answer-question/controller/delete-answer.controller.php?idAnswer=<?php echo $row->id; ?>&idQuestion=<?php echo $listDetailsQuestions->id; ?>&idStudent=<?php echo $studentID; ?>" data-bs-toggle="modal" data-bs-target="#confirm-delete-answer" class="delete-answer delete-answer-a">
                                <div class="<?php echo $styleDeleteAnswer; ?> <?php echo $styleAnswerDisplay; ?> delete-answer-div">
                                    <img src="../../../../views/images/components/delete-bin.svg" alt="">
                                </div>
                            </a>

                            <a href="" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $row->id; ?>" class="<?php echo $styleDenunciationAnswer; ?> delete-answer delete-answer-a">
                                <div class="delete-answer-div">
                                    <img src="../../../../views/images/components/denunciar-icon.svg" alt="">
                                </div>
                            </a>

                        </div>

                        <div class="question-core">
                            <!-- Create the editor container -->
                            <div class="ql-snow ql-editor2">
                                <div class="ql-editor2">
                                    <span class="question-text-p white-text line-clamp-2 whitney-16-medium-text" id="questionText-<?php echo $row->id; ?>">
                                        <?php echo $row->answer; ?>
                                    </span>

                                    <button class="read-btn-question normal-14-bold-p" id="readMore-newMessages-<?php echo $row->id; ?>" onclick="document.querySelector('#questionText-<?php echo $row->id; ?>').classList.remove('line-clamp-2');
                            document.querySelector('#readLess-newMessages-<?php echo $row->id; ?>').style.display = 'inline';
                            document.querySelector('#readMore-newMessages-<?php echo $row->id; ?>').style.display = 'none';">
                                        Ler mais...
                                    </button>

                                    <button class="read-btn-question normal-14-bold-p" id="readLess-newMessages-<?php echo $row->id; ?>" onclick="document.querySelector('#questionText-<?php echo $row->id; ?>').classList.add('line-clamp-2');
                            document.querySelector('#readLess-newMessages-<?php echo $row->id; ?>').style.display = 'none';
                            document.querySelector('#readMore-newMessages-<?php echo $row->id; ?>').style.display = 'inline';">
                                        Ler menos...
                                    </button>

                                    <!-- JS Read More Text -->
                                    <script>
                                        var questionText = document.getElementById('questionText-<?php echo $row->id; ?>');

                                        var readMoreNew = document.getElementById('readMore-newMessages-<?php echo $row->id; ?>');
                                        var readLessNew = document.getElementById('readLess-newMessages-<?php echo $row->id; ?>');

                                        //se o tamanho da mensagem passar o tamanho da caixa de texto, ou seja, com mais de 2 linhas
                                        if (questionText.scrollHeight > questionText.offsetHeight) {

                                            // Se ele estiver com o ..., precisa ter o "ler mais"
                                            if (questionText.classList.contains("line-clamp-2")) {
                                                readMoreNew.style.display = "inline";
                                                readLessNew.style.display = "none";
                                            }

                                            //se o texto nao tem mais de 2 linhas, nao precisa ter botão
                                        } else {
                                            readLessNew.style.display = "none";
                                            readMoreNew.style.display = "none";
                                        }
                                    </script>

                                </div>
                            </div>

                            <?php $styleImageAnswer = !empty($row->image) ? '' : 'd-none'; ?>
                            <p class="<?php echo $styleImageAnswer; ?> image-question">
                                <a href="<?php echo $row->image; ?>" class="image-link question-img">
                                    <img src="<?php echo $row->image; ?>" alt="<?php echo $row->firstName; ?>" style="width: 150px;">
                                </a>
                            </p>

                            <?php $styleDocumentAnswer = !empty($row->document) ? '' : 'd-none'; ?>
                            <p class="<?php echo $styleDocumentAnswer; ?> document-question">
                                <span class="document-icon">
                                    <img src="../../../../views/images/components/file-icon.svg">
                                </span>
                                <span class="normal-14-medium-p white-text text-truncate document-name">
                                    <?php echo $row->documentName; ?>
                                </span>
                                <a href="<?php echo $row->document; ?>" class="download-file-button" download="<?php echo $row->documentName; ?>">
                                    <img src="../../../../views/images/components/download-icon.svg" alt="">
                                </a>
                            </p>



                            <?php
                            $checkLiked = $answer->checkLikeCreator($listDetailsQuestions->id, $row->id, $studentId[0]['id']);
                            $styleLike = $checkLiked == false ? '' : 'heart';
                            ?>
                            <div class="functions-answer">
                                <div class="like-answer">

                                    <div class="<?php echo $styleLike; ?>" id="like-<?php echo $row->id; ?>" data-like-student="<?php echo $studentId[0]['id']; ?>" data-like-question="<?php echo $listDetailsQuestions->id; ?>" data-like-answer="<?php echo $row->id; ?>" onclick="like(<?php echo $row->id; ?>)" style="width: 20px; margin-right: 3px; padding: 0;">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewbox="0 0 50 50">
                                            <path d="M21.95 40.2 19.3 37.75Q13.1 32 8.55 26.775Q4 21.55 4 15.85Q4 11.35 7.025 8.325Q10.05 5.3 14.5 5.3Q17.05 5.3 19.55 6.525Q22.05 7.75 24 10.55Q26.2 7.75 28.55 6.525Q30.9 5.3 33.5 5.3Q37.95 5.3 40.975 8.325Q44 11.35 44 15.85Q44 21.55 39.45 26.775Q34.9 32 28.7 37.75L26.05 40.2Q25.2 41 24 41Q22.8 41 21.95 40.2Z" />
                                        </svg>
                                    </div>

                                    <p class="normal-14-bold-p question-p" style="color: var(--fuchsia); margin-top: 2px;">
                                        <?php $totalLike = !empty($row->totalLike) ? $row->totalLike : 0;
                                        echo $totalLike; ?>
                                    </p>

                                </div>

                                <div class="avaliation-answer">

                                    <?php $styleEmptyAvaliation = $row->stars === 0 ? '' : 'd-none' ?>
                                    <p>
                                    <div class="avaliacao <?php echo $styleEmptyAvaliation; ?>">
                                        <div class="star-icon ativo" data-icon="1" data-student="<?php echo $studentId[0]['id']; ?>" data-question="<?php echo $listDetailsQuestions->id; ?>" data-answer="<?php echo $row->id; ?>" onclick="avaliation(this)"></div>
                                        <div class="star-icon" data-icon="2" data-student="<?php echo $studentId[0]['id']; ?>" data-question="<?php echo $listDetailsQuestions->id; ?>" data-answer="<?php echo $row->id; ?>" onclick="avaliation(this)"></div>
                                        <div class="star-icon" data-icon="3" data-student="<?php echo $studentId[0]['id']; ?>" data-question="<?php echo $listDetailsQuestions->id; ?>" data-answer="<?php echo $row->id; ?>" onclick="avaliation(this)"></div>
                                        <div class="star-icon" data-icon="4" data-student="<?php echo $studentId[0]['id']; ?>" data-question="<?php echo $listDetailsQuestions->id; ?>" data-answer="<?php echo $row->id; ?>" onclick="avaliation(this)"></div>
                                        <div class="star-icon" data-icon="5" data-student="<?php echo $studentId[0]['id']; ?>" data-question="<?php echo $listDetailsQuestions->id; ?>" data-answer="<?php echo $row->id; ?>" onclick="avaliation(this)"></div>
                                    </div>
                                    </p>


                                    <?php
                                    $styleAvaliation = $row->stars != 0 ? '' : 'd-none';

                                    $styleStar1 = $row->stars === 1 ? 'ativo' : '';
                                    $styleStar2 = $row->stars === 2 ? 'ativo' : '';
                                    $styleStar3 = $row->stars === 3 ? 'ativo' : '';
                                    $styleStar4 = $row->stars === 4 ? 'ativo' : '';
                                    $styleStar5 = $row->stars === 5 ? 'ativo' : '';
                                    ?>

                                    <div class="avaliacao <?php echo $styleAvaliation; ?>">
                                        <div class="star-icon <?php echo $styleStar1; ?>" data-icon="1" data-student="<?php echo $studentId[0]['id']; ?>" data-question="<?php echo $listDetailsQuestions->id; ?>" data-answer="<?php echo $row->id; ?>" onclick="avaliation(this)"></div>
                                        <div class="star-icon <?php echo $styleStar2; ?>" data-icon="2" data-student="<?php echo $studentId[0]['id']; ?>" data-question="<?php echo $listDetailsQuestions->id; ?>" data-answer="<?php echo $row->id; ?>" onclick="avaliation(this)"></div>
                                        <div class="star-icon <?php echo $styleStar3; ?>" data-icon="3" data-student="<?php echo $studentId[0]['id']; ?>" data-question="<?php echo $listDetailsQuestions->id; ?>" data-answer="<?php echo $row->id; ?>" onclick="avaliation(this)"></div>
                                        <div class="star-icon <?php echo $styleStar4; ?>" data-icon="4" data-student="<?php echo $studentId[0]['id']; ?>" data-question="<?php echo $listDetailsQuestions->id; ?>" data-answer="<?php echo $row->id; ?>" onclick="avaliation(this)"></div>
                                        <div class="star-icon <?php echo $styleStar5; ?>" data-icon="5" data-student="<?php echo $studentId[0]['id']; ?>" data-question="<?php echo $listDetailsQuestions->id; ?>" data-answer="<?php echo $row->id; ?>" onclick="avaliation(this)"></div>
                                    </div>

                                    <p class="normal-14-bold-p question-p avaliation-text" style="color: var(--yellow);" style="top: 5px;">
                                        <span class="functions-answer-text avaliation-text">
                                            <?php echo $row->avaliation; ?>

                                            (
                                            <?php
                                            $totalAvaliation = !empty($row->totalAvaliation) ? $row->totalAvaliation : 0;
                                            echo $totalAvaliation;
                                            ?>
                                            )
                                        </span>
                                    </p>

                                </div>

                            </div>

                        </div>

                        <!-- Modal Answer-->
                        <div class="modal fade" id="modal-<?php echo $row->id; ?>" tabindex="-1" aria-labelledby="modalLabel-<?php echo $row->id; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel-<?php echo $row->id; ?>">Relatar um problema</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Nos ajude a entender o problema, o que está acontecendo com esse post?

                                        <form action="../answer-question/controller/denunciation-answer.controller.php" method="post">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="denunciation" id="radio1-<?php echo $row->id; ?>" value="Não tenho interesse nesse post" required>
                                                <label class="form-check-label" for="radio1-<?php echo $row->id; ?>">
                                                    Não tenho interesse nesse post
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="denunciation" id="radio2-<?php echo $row->id; ?>" value="É suspeito ou está enviando span">
                                                <label class="form-check-label" for="radio2-<?php echo $row->id; ?>">
                                                    É suspeito ou está enviando span
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="denunciation" id="radio3-<?php echo $row->id; ?>" value="É abusivo ou nocivo">
                                                <label class="form-check-label" for="radio3-<?php echo $row->id; ?>">
                                                    É abusivo ou nocivo
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="denunciation" id="radio4-<?php echo $row->id; ?>" value="As informações são enganosas">
                                                <label class="form-check-label" for="radio4-<?php echo $row->id; ?>">
                                                    As informações são enganosas
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="denunciation" id="radio5-<?php echo $row->id; ?>" value="Manifesta intenções de automutilação ou suicídio">
                                                <label class="form-check-label" for="radio5-<?php echo $row->id; ?>">
                                                    Manifesta intenções de automutilação ou suicídio
                                                </label>
                                            </div>

                                            <div>
                                                <input type="hidden" name="post_link" id="" value="<?php echo $listDetailsQuestions->linkQuestion; ?>">
                                                <input type="hidden" name="createdBy" id="" value="<?php echo $idUser; ?>">
                                                <input type="hidden" name="denounciedId" id="" value="<?php echo $creatorAnswerID; ?>">
                                                <input type="hidden" name="answerId" id="" value="<?php echo $row->id; ?>">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="register" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="detail-question-hr">
                    <?php } ?>
                </div>

            </div>
        </div>

        <nav class="feed-leftbar feed-rightbar">
            <ul class="rightbar-ul">
                <li class="rightbar-li">
                    <p class="leftbar-categoria normal-14-bold-p">Desafios</p>
                </li>
                <hr class="sidebar-linha leftbar-linha">
                <li class="rightbar-li">
                    <p class="leftbar-categoria normal-14-bold-p">Ranking de usuários</p>
                </li>
            </ul>
            <p class="whitney-12-regular-tiny copyright-text">
                Copyright © Cold Wolf - 2022. Todos os direitos reservados. • <a href="#" class="copyright-text">Fale conosco</a>
            </p>
        </nav>

        <nav class="feed-bottombar">
            <a href="../home/home.page.php" class="bottombar-a">
                <img src="../../../../views/images/components/dashboard-img.svg" alt="">
            </a>
            <a href="#" class="bottombar-a">
                <img src="../../../../views/images/components/following-icon.svg" alt="">
            </a>
            <a href="#" class="bottombar-a">
                <img src="../../../../views/images/components/notifications-icon.svg" alt="">
            </a>
            <a href="../detail-perfil-student/detail-perfil-student.page.php?idStudent=<?php echo $studentPerfil->id; ?>" class="bottombar-a" target="_blank">
                <img src="<?php echo $studentPerfil->photo; ?>" alt="<?php echo $studentPerfil->firstName; ?>" style="width: 25px; height: 25px; border-radius: 22px; object-fit: cover;">
            </a>
        </nav>
    </div>



    <!-- JS JQuery ⬇️ -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- JS Bootstrap ⬇️ -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <!-- JS Modal Excluir ⬇️ -->
    <script src="../../js/delete-answer-question.js"></script>

    <!-- jQuery 1.7.2+ or Zepto.js 1.0+ -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <!-- Magnific Popup core JS file -->
    <script src="../../../../libs/dist/jquery.magnific-popup.js"></script>

    <script>
        $(document).ready(function() {
            $('.image-link').magnificPopup({
                type: 'image'
            });
        });
    </script>

    <script>
        function copyLink() {
            const link = document.getElementById("linkQuestion");
            const span = document.getElementById("spanLink");

            navigator.clipboard.writeText(link.href);

            span.innerText = "Copiado!";
            setTimeout(() => {
                span.innerText = "Copiar link";
            }, 1150);
        }
    </script>

    <script>
        async function avaliation(e) {
            const stars = document.querySelectorAll('.star-icon');

            var classStar = e.classList;

            const answer = e.getAttribute('data-answer');

            stars.forEach(function(star) {
                if (star.getAttribute('data-answer') === answer) {
                    star.classList.remove('ativo');
                }
            });
            classStar.add('ativo');


            const avaliationStars = e.getAttribute('data-icon');
            const student = e.getAttribute('data-student');
            const question = e.getAttribute('data-question');

            const avaliation = {
                stars: avaliationStars,
                studentId: student,
                questionId: question,
                answerId: answer
            }

            const headers = new Headers();

            const formData = new FormData();
            Object.keys(avaliation).forEach((key) => {
                formData.append(key, avaliation[key]);
            });

            const option = {
                method: 'POST',
                body: formData
            }

            const request = new Request('./controller/register-avaliation.controller.php', option);

            await fetch(request);

        }
    </script>

    <script>
        async function like(id) {
            const like = document.getElementById(`like-${id}`);

            var classLike = like.classList;

            if (!classLike.contains('heart')) {
                like.classList.add('heart');
            } else {
                like.classList.remove('heart');
            }

            const answer = like.getAttribute('data-like-answer');
            const student = like.getAttribute('data-like-student');
            const question = like.getAttribute('data-like-question');

            const likeRequest = {
                studentId: student,
                questionId: question,
                answerId: answer
            }

            const headersLike = new Headers();

            const formDataLike = new FormData();
            Object.keys(likeRequest).forEach((key) => {
                formDataLike.append(key, likeRequest[key]);
            });

            const optionLike = {
                method: 'POST',
                body: formDataLike
            }

            const requestLike = new Request('./controller/register-like.controller.php', optionLike);

            await fetch(requestLike);

        }
    </script>
</body>

</html>