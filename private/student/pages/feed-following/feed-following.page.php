<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-student.controller.php');
require_once('/xampp/htdocs' . '/project/classes/feed/Following.class.php');
require_once('/xampp/htdocs' . '/project/classes/answers/Answer.class.php');
require_once('/xampp/htdocs' . '/project/classes/questions/Question.class.php');
require_once('/xampp/htdocs' . '/project/classes/users/StudentMethods.class.php');
require_once('/xampp/htdocs' . '/project/classes/preferences/Preference.class.php');
require_once('/xampp/htdocs' . '/project/classes/rankings/Ranking.class.php');

try {
    $userID = $_GET['userID'];
    $idUser = $_SESSION['idUser'];

    $following = new Following();
    $feedFollowing = $following->listFeedFollowing($userID);

    $question = new Question();

    $listPreferences = Preference::getPreferencesUser($idUser);

    $student = new StudentMethods();
    $studentId = $student->getStudentByUserID($idUser);
    $studentPerfil = $student->getDataStudentByID($studentId[0]['id']);

    $ranking = new Ranking();
    $colocationTotal = $ranking->colocationTotal();
    $positionRankingAll = $ranking->colocationTotalAll($studentId[0]['id']);

    $colocationFollowers = $ranking->colocationFllowers($idUser);
    $positionBetweenFollowers = $ranking->colocationFllowersAll($idUser);
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
    <title>Feed Seguindo | Heelp!</title>

    <!-- Include stylesheet -->
    <link href="../../../style/editor-style/editor.style.css" rel="stylesheet">

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.css" rel="stylesheet" />

    <!-- Estilos -->
    <link rel="stylesheet" href="../../../../views/styles/style.global.css">
    <link rel="stylesheet" href="../../../../views/styles/fonts.style.css">
    <link rel="stylesheet" href="../../../style/modal-about.style.css">
    <link rel="stylesheet" href="../../../adm/pages/register/register.styles.css">
    <link rel="stylesheet" href="../../../adm/pages/register/registration panel/registration-panel-style.css">
    <link rel="stylesheet" href="../../styles/feed.style.css">

    <!-- Estilo do modal de denunciar -->
    <link rel="stylesheet" href="../home//modal.css">
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
                            <img class="leftbar-icon" src="../../../../views/images/components/filled-dashboard-img.svg" alt="">
                            <p class="normal-18-bold-title-2 leftbar-text-current">Feed</p>
                        </a>
                    </li>

                    <li class="sidebar-li leftbar-li">
                        <a href="../feed-following/feed-following.page.php?userID=<?php echo $idUser; ?>" class="sidebar-a leftbar-a">
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

                    <!-- Lista de preferências ⬇️ -->
                    <?php for ($i = 0; $i < count($listPreferences); $i++) {
                        $row = $listPreferences[$i] ?>

                        <a href="../preferences/preference.page.php?preference=<?php echo $row->id; ?>">
                            <div class="d-flex question-info margin-bot-15">
                                <img src="<?php echo $row->photo; ?>" alt="<?php echo $row->name; ?>" style="margin-right: 8px;" width="32px">
                                <p class="white-text question-p normal-16-bold-title-3 text-truncate">
                                    <?php echo $row->name; ?>
                                </p>
                            </div>
                        </a>

                    <?php } ?>

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

            <!-- Barra de pesquisa -->
            <!-- <form action="../search/search.page.php" method="get">
                <input type="text" name="search" id="" placeholder="Encontre perguntas, pessoas ou materiais" autocomplete="off">
                <input type="submit" value="pesquisar">
            </form> -->

            <div class="feed-div">


                <div class="<?php echo $stylePreferences; ?>">
                    <!-- Lista de perguntas ⬇️ -->
                    <?php for ($i = 0; $i < count($feedFollowing); $i++) {
                        $row = $feedFollowing[$i] ?>

                        <div class="space-between-header">

                            <p class="margin-60">
                                <span class="badge rounded-pill bg-primary"> <?php echo $row->course; ?></span>

                                <?php
                                if ($row->category === "Erro") {
                                    $styleError = 'badge rounded-pill bg-danger';
                                    $styleQuestion = 'd-none';
                                    $styleHelp = 'd-none';
                                }

                                if ($row->category === "Dúvida") {
                                    $styleError = 'd-none';
                                    $styleQuestion = 'badge rounded-pill bg-info';
                                    $styleHelp = 'd-none';
                                }

                                if ($row->category === "Material de Apoio") {
                                    $styleError = 'd-none';
                                    $styleQuestion = 'd-none';
                                    $styleHelp = 'badge rounded-pill bg-success';
                                }
                                ?>
                                <span class="<?php echo $styleError; ?>"> <?php echo $row->category; ?></span>
                                <span class="<?php echo $styleQuestion; ?>"> <?php echo $row->category; ?></span>
                                <span class="<?php echo $styleHelp; ?>"> <?php echo $row->category; ?></span>
                                <span class="badge rounded-pill bg-little-blue"> <?php echo $row->subject; ?></span>
                            </p>

                            <?php
                            $creatorQuestion = $question->getCreatorQuestionById($row->id);
                            $creatorQuestionID = $creatorQuestion[0]['student_id'];
                            $studentID = $studentId[0]['id'];
                            $hasAnswers = $question->hasAnswers($row->id);

                            $styleDeleteDisplay = $hasAnswers ? 'd-none' : '';
                            $styleDeleteQuestion = $creatorQuestionID == $studentID ? '' : 'd-none';
                            ?>

                            <!-- Mais Opções -->
                            <div class="drop-edit-exclud-about drop-edit-exclud-about2">
                                <img src="../../../../views/images/components/three-dots.svg">

                                <!-- Parte do Update e Delete -->
                                <div class="drop-edit-exclud-content-about">
                                    <a href="" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $row->id;
                                                                                                ?>" class="drop-edit-exclud-a <?php echo $styleDenunciationQuestion; ?>">
                                        <div class="drop-edit-exclud-option-about">
                                            <img src="../../../../views/images/components/denunciar-icon.svg" class="drop-edit-exclud-img">
                                            <p class="drop-edit-exclud-text-about normal-14-bold-p">Denunciar</p>
                                        </div>
                                    </a>
                                    <a href="<?php echo $row->linkQuestion; ?>" class="d-none drop-edit-exclud-a" id="linkQuestion-<?php echo $row->id; ?>">Link
                                        <div class="drop-edit-exclud-option-about">
                                            <img src="../../../../views/images/components/link-icon.svg" class="drop-edit-exclud-img">
                                            <p class="drop-edit-exclud-text-about normal-14-bold-p">Copiar Link</p>
                                        </div>
                                    </a>
                                    <a class="drop-edit-exclud-a">
                                        <div class="drop-edit-exclud-option-about">
                                            <img src="../../../../views/images/components/link-icon.svg" class="drop-edit-exclud-img">
                                            <span onclick="copyLink(<?php echo $row->id; ?>)" id="spanLink-<?php echo $row->id; ?>" class="drop-edit-exclud-text-about normal-14-bold-p">
                                                Copiar link
                                            </span>
                                        </div>
                                    </a>
                                    <div class="<?php echo $styleDeleteQuestion; ?> <?php echo $styleDeleteDisplay; ?> pedir-heelp-button-a">
                                        <a href="../question/controller/delete-question.controller.php?id=<?php echo $row->id; ?>" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete" class="drop-edit-exclud-a pedir-heelp-button-a">
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

                            <a href="<?php echo $row->linkProfile; ?>" target="_blank">
                                <img src="<?php echo $row->photo; ?>" alt="<?php echo $row->firstName; ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50px; margin-right: 8px;">
                            </a>

                            <div class="question-info-text">
                                <a href="<?php echo $row->linkProfile; ?>" class="question-name question-about-a normal-14-medium-p" target="_blank">
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

                        <div class="question-core">
                            <!-- Create the editor container -->
                            <div class="ql-snow ql-editor2">
                                <div class="ql-editor2">
                                    <span class="question-text-p white-text line-clamp-2 whitney-16-medium-text" id="questionText-<?php echo $row->id; ?>">
                                        <?php echo $row->question; ?>
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

                            <?php $styleImageQuestion = !empty($row->image) ? '' : 'd-none'; ?>
                            <p class="<?php echo $styleImageQuestion; ?> image-question">
                                <a href="<?php echo $row->image; ?>" class="image-link question-img">
                                    <img src="<?php echo $row->image; ?>" alt="<?php echo $row->firstName; ?>" style="width: 150px;">
                                </a>
                            </p>

                            <?php $styleDocumentQuestion = !empty($row->document) ? '' : 'd-none'; ?>
                            <p class="<?php echo $styleDocumentQuestion; ?> document-question">
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

                            <div class="question-footer">

                                <?php
                                $answer = new Answer();
                                $totalAnswersOfQuestion = $answer->countAnswers($row->id);

                                $styleCounter = empty($totalAnswersOfQuestion) ? 'question-footer-div' : 'question-answers question-footer-div';
                                ?>
                                <div class="<?php echo $styleCounter; ?>" id="respostaQuant">
                                    <p class="normal-14-bold-p white-text question-p">
                                        <?php echo $totalAnswersOfQuestion; ?>
                                    </p>
                                </div>

                                <a class="question-give-heelp-a pedir-heelp-button-a" href="../detail-question/detail-question.page.php?idQuestion=<?php echo $row->id; ?>">
                                    <div class="question-toAnswer question-footer-div">

                                        <p class="normal-14-bold-p question-p white-text">Dar um help</p>
                                        <img src="../../../../views/images/components/upper-line.svg" class="upper-line">
                                        <img src="../../../../views/images/components/star-icon.svg" class="xp-star">
                                        <p class="normal-14-bold-p question-p yellow-text"> <?php echo $row->xp; ?> xp </p>

                                    </div>
                                </a>

                            </div>

                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="modal-<?php echo $row->id; ?>" tabindex="-1" aria-labelledby="modalLabel-<?php echo $row->id; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content cor">
                                    <div class="container containerMO">
                                        <div class="modal-header border-bottom-0">
                                            <h5 class="modal-title" id="modalLabel-<?php echo $row->id; ?>">Relatar um problema</h5>
                                            <button id="botao" class="setaM"><img type="button" data-bs-dismiss="modal" aria-label="Close" src="../../../../views/images/components/x-button.svg" class="close fechar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="whitney-16-medium-text styleCor"> Nos ajude a entender o problema, o que está acontecendo com esse post? </p>

                                            <form action="../question/controller/denunciation-question.controller.php" method="post">
                                                <div class="form-check questionStyle">
                                                    <input class="form-check-input" type="radio" name="denunciation" id="radio1-<?php echo $row->id; ?>" value="Não tenho interesse nesse post" required>
                                                    <label class="form-check-label normal-12-medium-tiny styleCor" for="radio1-<?php echo $row->id; ?>">
                                                        Não tenho interesse nesse post
                                                    </label>
                                                </div>
                                                <div class="border-bottom"></div>
                                                <div class="form-check questionStyle">
                                                    <input class="form-check-input" type="radio" name="denunciation" id="radio2-<?php echo $row->id; ?>" value="É suspeito ou está enviando span">
                                                    <label class="form-check-label normal-12-medium-tiny styleCor" for="radio2-<?php echo $row->id; ?>">
                                                        É suspeito ou está enviando span
                                                    </label>
                                                </div>
                                                <div class="border-bottom"></div>
                                                <div class="form-check questionStyle">
                                                    <input class="form-check-input" type="radio" name="denunciation" id="radio3-<?php echo $row->id; ?>" value="É abusivo ou nocivo">
                                                    <label class="form-check-label normal-12-medium-tiny styleCor" for="radio3-<?php echo $row->id; ?>">
                                                        É abusivo ou nocivo
                                                    </label>
                                                </div>
                                                <div class="border-bottom"></div>
                                                <div class="form-check questionStyle">
                                                    <input class="form-check-input" type="radio" name="denunciation" id="radio4-<?php echo $row->id; ?>" value="As informações são enganosas">
                                                    <label class="form-check-label normal-12-medium-tiny styleCor" for="radio4-<?php echo $row->id; ?>">
                                                        As informações são enganosas
                                                    </label>
                                                </div>
                                                <div class="border-bottom"></div>
                                                <div class="form-check questionStyle">
                                                    <input class="form-check-input" type="radio" name="denunciation" id="radio5-<?php echo $row->id; ?>" value="Manifesta intenções de automutilação ou suicídio">
                                                    <label class="form-check-label normal-12-medium-tiny styleCor" for="radio5-<?php echo $row->id; ?>">
                                                        Manifesta intenções de automutilação ou suicídio
                                                    </label>
                                                </div>
                                                <div class="border-bottom"></div>
                                                <div>
                                                    <?php
                                                    $creatorQuestion = $question->getCreatorQuestionById($row->id);
                                                    $userCreatorQuestion = $student->getUserByStudentID($creatorQuestion[0]['student_id']);
                                                    ?>
                                                    <input type="hidden" name="post_link" id="" value="<?php echo $row->linkQuestion; ?>">
                                                    <input type="hidden" name="createdBy" id="" value="<?php echo $idUser; ?>">
                                                    <input type="hidden" name="denounciedId" id="" value="<?php echo $userCreatorQuestion[0]['user_id']; ?>">
                                                    <input type="hidden" name="questionId" id="" value="<?php echo $row->id; ?>">
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="botaoSubmit normal-14-bold-p" value="Enviar" name="register">Enviar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="feed-hr">
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


                <div>
                    <!-- Tabs navs -->
                    <ul class="nav nav-tabs nav-fill ranking-ul mb-3" id="ex1" role="tablist">
                        <li class="nav-item ranking-li" role="presentation">
                            <a class="nav-link ranking-a active whitney-10-bold-tiny" id="ex2-tab-1" data-mdb-toggle="tab" href="#ex2-tabs-1" role="tab" aria-controls="ex2-tabs-1" aria-selected="true">Todos</a>
                        </li>
                        <li class="nav-item ranking-li" role="presentation">
                            <a class="nav-link ranking-a whitney-10-bold-tiny" id="ex2-tab-2" data-mdb-toggle="tab" href="#ex2-tabs-2" role="tab" aria-controls="ex2-tabs-2" aria-selected="false">Seguindo</a>
                        </li>
                    </ul>
                    <!-- Tabs navs -->

                    <!-- Tabs content -->
                    <div class="tab-content" id="ex2-content">
                        <div class="tab-pane fade show active" id="ex2-tabs-1" role="tabpanel" aria-labelledby="ex2-tab-1">

                            <div class="ranking-position">
                                <img src="../../../../views/images/components/trophy-primary.svg" alt="">
                                <p class="question-p white-text normal-14-bold-p">
                                    Sua posição é <?php echo $positionRankingAll; ?>º
                                </p>
                                <img src="../../../../views/images/components/trophy-primary.svg" alt="">
                            </div>

                            <!-- Ranking total ⬇️ -->
                            <?php for ($i = 0; $i < count($colocationTotal); $i++) {
                                $row = $colocationTotal[$i];

                                if ($i === 0) {
                                    $displayMedal = 'd-block';
                                    $displayNumber = 'd-none';
                                    $iconMedal = '../../images/icons/gold.svg';
                                    $badgeColor = 'badge rounded-pill bg-gold';
                                } else if ($i === 1) {
                                    $displayNumber = 'd-none';
                                    $displayMedal = 'd-block';
                                    $iconMedal = '../../images/icons/silver.svg';
                                    $badgeColor = 'badge rounded-pill bg-silver';
                                } else if ($i === 2) {
                                    $displayNumber = 'd-none';
                                    $displayMedal = 'd-block';
                                    $iconMedal = '../../images/icons/bronze.svg';
                                    $badgeColor = 'badge rounded-pill bg-copper';
                                } else if ($i === 3) {
                                    $displayMedal = 'd-none';
                                    $displayNumber = 'd-block';
                                    $badgeColor = 'badge rounded-pill bg-little-blue';
                                    $number = '4º';
                                } else {
                                    $displayMedal = 'd-none';
                                    $displayNumber = 'd-block';
                                    $badgeColor = 'badge rounded-pill bg-little-blue';
                                    $number = '5º';
                                }
                            ?>
                                <div class="top-ranking" style="margin-top: 25px; margin-bottom: 25px;">
                                    <div class="question-info">
                                        <div class="<?php echo $displayMedal; ?>">
                                            <img src="<?php echo $iconMedal; ?>" alt="<?php echo $row->name; ?>">
                                        </div>
                                        <div class="<?php echo $displayNumber; ?> normal-14-bold-p question-p" style="color: var(--gray6); margin-right: 5px; margin-left: 5px;">
                                            <?php echo $number; ?>
                                        </div>
                                        <img src="<?php echo $row->photo; ?>" alt="<?php echo $row->name; ?>" style="width: 40px; height: 40px; border-radius: 40px; object-fit: cover; margin-right: 10px;">
                                        <p class="question-p white-text text-truncate normal-14-bold-p">
                                            <?php echo $row->name; ?>
                                        </p>
                                    </div>

                                    <span class="<?php echo $badgeColor; ?>"> <?php echo $row->xp; ?>xp</span>
                                </div>

                            <?php } ?>

                        </div>
                        <div class="tab-pane fade" id="ex2-tabs-2" role="tabpanel" aria-labelledby="ex2-tab-2">

                            <div class="ranking-position">
                                <img src="../../../../views/images/components/trophy-primary.svg" alt="">
                                <p class="question-p white-text normal-14-bold-p">
                                    Sua posição é <?php echo $positionBetweenFollowers; ?>º
                                </p>
                                <img src="../../../../views/images/components/trophy-primary.svg" alt="">
                            </div>

                            <!-- Ranking seguindo ⬇️ -->
                            <?php for ($i = 0; $i < count($colocationFollowers); $i++) {
                                $row = $colocationFollowers[$i];

                                if ($i === 0) {
                                    $displayNumber = 'd-none';
                                    $displayMedal = 'd-block';
                                    $iconMedal = '../../images/icons/gold.svg';
                                    $badgeColor = 'badge rounded-pill bg-gold';
                                } else if ($i === 1) {
                                    $displayNumber = 'd-none';
                                    $displayMedal = 'd-block';
                                    $iconMedal = '../../images/icons/silver.svg';
                                    $badgeColor = 'badge rounded-pill bg-silver';
                                } else if ($i === 2) {
                                    $displayNumber = 'd-none';
                                    $displayMedal = 'd-block';
                                    $iconMedal = '../../images/icons/bronze.svg';
                                    $badgeColor = 'badge rounded-pill bg-copper';
                                } else if ($i === 3) {
                                    $displayMedal = 'd-none';
                                    $displayNumber = 'd-block';
                                    $badgeColor = 'badge rounded-pill bg-little-blue';
                                    $number = '4º';
                                } else {
                                    $displayMedal = 'd-none';
                                    $displayNumber = 'd-block';
                                    $badgeColor = 'badge rounded-pill bg-little-blue';
                                    $number = '5º';
                                }
                            ?>


                                <div class="top-ranking" style="margin-top: 25px; margin-bottom: 25px;">
                                    <div class="question-info">
                                        <div class="<?php echo $displayMedal; ?>">
                                            <img src="<?php echo $iconMedal; ?>" alt="<?php echo $row['first_name']; ?>">
                                        </div>
                                        <div class="<?php echo $displayNumber; ?> normal-14-bold-p question-p" style="color: var(--gray6); margin-right: 5px; margin-left: 5px;">
                                            <?php echo $number; ?>
                                        </div>
                                        <img src="<?php echo $row['photo']; ?>" alt="<?php echo $row['first_name']; ?>" style="width: 40px; height: 40px; border-radius: 40px; object-fit: cover; margin-right: 10px;">
                                        <p class="question-p white-text text-truncate normal-14-bold-p">
                                            <?php echo $row['first_name']; ?>
                                        </p>
                                    </div>

                                    <span class="<?php echo $badgeColor; ?>"> <?php echo $row['xp']; ?>xp</span>
                                </div>

                            <?php } ?>

                        </div>
                    </div>
                    <!-- Tabs content -->
                </div>
            </ul>

            <p class="whitney-12-regular-tiny copyright-text">
                Copyright © Cold Wolf - 2022. Todos os direitos reservados. • <a href="#" class="copyright-text">Fale conosco</a>
            </p>
        </nav>

        <nav class="feed-bottombar">
            <a href="./home.page.php" class="bottombar-a">
                <img src="../../../../views/images/components/filled-dashboard-img.svg" alt="">
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

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.js"></script>

    <!-- JS Modal Excluir ⬇️ -->
    <script src="../../js/delete-question.js"></script>


    <script>
        function copyLink(id) {
            const link = document.getElementById(`linkQuestion-${id}`);
            const span = document.getElementById(`spanLink-${id}`);

            navigator.clipboard.writeText(link.href);

            span.innerText = "Copiado!";
            setTimeout(() => {
                span.innerText = "Copiar link";
            }, 1150);
        }
    </script>
</body>

</html>