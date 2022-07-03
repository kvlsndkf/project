<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-student.controller.php');
require_once('/xampp/htdocs' . '/project/classes/researches/Search.class.php');
require_once('/xampp/htdocs' . '/project/classes/answers/Answer.class.php');
require_once('/xampp/htdocs' . '/project/classes/preferences/Preference.class.php');
require_once('/xampp/htdocs' . '/project/classes/rankings/Ranking.class.php');

try {
    $idUser = $_SESSION['idUser'];
    $searchResult = $_GET['search'];

    if (empty($searchResult)) {
        header('Location: /project/private/student/pages/home/home.page.php');
    }

    $search = new Search();
    $searchQuestions = $search->searchQuestions($searchResult);
    $searchProfiles = $search->searchProfiles($searchResult);
    $searchMaterials = $search->searchMaterials($searchResult);

    $student = new StudentMethods();
    $studentLogged = $student->getStudentByUserID($idUser);
    $studentPerfil = $student->getDataStudentByID($studentLogged[0]['id']);
    $studentId = $student->getStudentByUserID($idUser);

    $listPreferences = Preference::getPreferencesUser($idUser);

    $ranking = new Ranking();
    $colocationTotal = $ranking->colocationTotal();
    $positionRankingAll = $ranking->colocationTotalAll($studentLogged[0]['id']);

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
    <title>Pesquisa sobre <?php echo $searchResult; ?> | Heelp</title>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.css" rel="stylesheet" />

    <!-- Include stylesheet -->
    <link href="../../../style/editor-style/editor.style.css" rel="stylesheet">
    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="../../../../libs/dist/magnific-popup.css">

    <!-- JavaScript -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- Include stylesheet -->
    <link href="../../../style/editor-style/editor.style.css" rel="stylesheet">

    <!-- Animation Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Estilos -->
    <link rel="stylesheet" href="../../../../views/styles/style.global.css">
    <link rel="stylesheet" href="../../../../views/styles/fonts.style.css">
    <link rel="stylesheet" href="../../../style/modal-about.style.css">
    <link rel="stylesheet" href="../../../adm/pages/register/register.styles.css">
    <link rel="stylesheet" href="../../../adm/pages/register/registration panel/registration-panel-style.css">
    <link rel="stylesheet" href="../../styles/feed.style.css">
    <link rel="stylesheet" href="../../../../views/styles/colors.style.css">
    <link rel="stylesheet" href="./style.search.css">

    <!-- FAVICON  -->
    <link rel="shortcut icon" href="../../../../views/images/favicon/favicon-16x16.png" type="image/x-icon">

</head>

<div class="wrapper">

    <body>

        <!-- Perfil do canto -->
        <nav class="feed-leftbar">
            <div class="leftbar-top">

                <a href="../home/home.page.php" class="feed-logo">
                    <img src="../../../../views/images/logo/logo-help.svg" alt="" class="logo-heelp-img">
                    <h4 class="logo-heelp-text normal-22-black-title-1">heelp!</h4>
                </a>

                <ul class="feed-ul">

                    <li class="sidebar-li leftbar-li">
                        <a href="../home/home.page.php" class="sidebar-a-items leftbar-a">
                            <img class="leftbar-icon" src="../../../../views/images/components/dashboard-img.svg" alt="" style="margin-left: 3px;">
                            <p class="normal-18-bold-title-2 leftbar-text">Feed</p>
                        </a>
                    </li>

                    <li class="sidebar-li leftbar-li">
                        <a href="../feed-following/feed-following.page.php?userID=<?php echo $idUser; ?>" class="sidebar-a-items leftbar-a">
                            <img class="leftbar-icon" src="../../../../views/images/components/following-icon.svg" alt="">
                            <p class="leftbar-text normal-18-bold-title-2">Seguindo</p>
                        </a>
                        <hr class="sidebar-linha leftbar-linha">
                    </li>

                    <li class="sidebar-li my-leftbar-li">
                        <p class="my-leftbar-categoria normal-14-bold-p">Para você</p>
                    </li>

                    <!-- Lista de preferências ⬇️ -->
                    <?php for ($i = 0; $i < count($listPreferences); $i++) {
                        $row = $listPreferences[$i] ?>

                        <a href="../preferences/preference.page.php?preference=<?php echo $row->id; ?>">
                            <div class="d-flex question-info pref-sidebar-a-items" style="padding-top: 6px; padding-bottom: 6px;">

                                <img src="<?php echo $row->photo; ?>" alt="<?php echo $row->name; ?>" style="margin-right: 8px; margin-left: 3px;" width="32px">

                                <p class="white-text question-p normal-16-bold-title-3 text-truncate" style="width: 15vw;">
                                    <?php echo $row->name; ?>
                                </p>
                            </div>
                        </a>

                    <?php } ?>

                    <li class="sidebar-li leftbar-li">
                        <a href="../question/question.page.php" class="pedir-heelp-button-a normal-14-bold-p">
                            <div class="my-leftbar-button-div">
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

                </div>


                <div class="bottom-xp-div">
                    <p class="normal-12-medium-tiny white-text bottom-xp-text">
                        <?php echo $studentPerfil->xp; ?>
                        xp
                    </p>
                </div>


                <a class="normal-16-bold-title-3 white-text bottom-name text-truncate" href="../detail-perfil-student/detail-perfil-student.page.php?idStudent=<?php echo $studentPerfil->id; ?>" target="_blank" style="max-width: 100%;">
                    <?php echo $studentPerfil->firstName;
                    echo " " . $studentPerfil->surname; ?>
                </a>

            </div>
        </nav>

        <div class="corpo-feed">
            <div class="feed-div">

                <a href="../question/question.page.php" class="pedir-heelp-responsive">
                    <div class="pedir-heelp-responsive">
                        <svg class="pedir-heelp-respo-img" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="398px" height="397px">
                            <image class="pedir-heelp-respo-img" x="0px" y="0px" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAY4AAAGNCAMAAAAxTmbgAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAA7VBMVEUAAAD///////////////////////////////////////////////////////////////////////////////////////////+wm/fd1Pvo4/3Sxvr////////Sxvr08f7////o4/3////////////o4/3///////+7qfiwm/bd1Pzo4/3o4v3////////d1Pz////o4v3o4/3o4v3o4/3////o4v3////////////////////o4/3////////////////////////////o4v3o4/3SxvrSxvrSxvr08f7////////o4/3///////8sZ6vxAAAATnRSTlMAACAwQGCAn6+/z99QEG+Q739fcI+gT7AUCwsjlIICHpcErs5ZBdHGAwMZIhGYniOcBDINIYgZq7FniqIb3It5bnWZg0ECOTQdZnGsTH03kZewAAAAAWJLR0QB/wIt3gAAAAd0SU1FB+YEGQ4hNQTqECAAAAsJSURBVHja7Z2HgurIEUVBEUkIxPDe4LS21znnsI7rsM42//85FgzMA0ZZ1V23pXt+gFs6093VrWZYLDTxPM8PgiA8EZ2JL6ySO9JsFMkD1095+czTp6/LGEEZR/VxWCUvH30YbqJtHCdJ+YyOoGRZmiSreFt6KiV5ufZzk3WwDjfbuPzz1n7KI/ykSSknDHx3zXh+GMWrrNB+lMKUYqJ14JCW/OQhnZqGB4p0Fa197UfdZmK9iR2ek/pTSsEcKXkwMxMfyFabQPvx36vYJROfnFpJIgwl3mb2Kq4kG+VdS7Cd6QRVR7ZVGyTBlsOigixW6LjyXapdNy7Zk91ZK0i0K0YntjZp5RsOjA5kT1Zk7LhidCTbmZ6zKKMXhoVQRl8MTlkBNxkDMCTEYzc1kNjAjLXhPDWcHYcGFJnoAOHQGM1eTEYea9cyBaRWEI8NlQgyE9YTJyohCoGWd6ddxJQY3WG9065gWrwbZ4OLuDDxCBk5dxvipIMvAuV8r2GAwT5owwgDfXDdMMSg9YM9lTEG9Ffcbxik9/5jo5142vTcn3s8GTFK0etqHE8NTZP1aa/e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" />
                        </svg>
                        <p class="pedir-heelp-respo-p">+</p>
                    </div>
                </a>

                <!-- Barra de pesquisa -->
                <form action="./search.page.php" method="get" class="search-form">
                    <input type="text" name="search" id="" placeholder="Encontre perguntas, pessoas ou materiais" class="my-search-input" value="<?php echo $searchResult; ?>" autocomplete="off">
                    <input type="submit" id="submit-search" value="🔍" class="my-search-submit">
                </form>
                <!-- Tabs navs -->
                <ul class="nav nav-tabs nav-fill mb-3" id="ex1" role="tablist">
                    <li class="nav-item" role="presentation">
                        <?php $styleBadgeQuestions = count($searchQuestions) != 0 ? 'badge bg-primary ms-2' : 'd-none'; ?>
                        <a class="nav-link active normal-14-bold-p question-p" id="ex2-tab-1" data-mdb-toggle="tab" href="#ex2-tabs-1" role="tab" aria-controls="ex2-tabs-1" aria-selected="true">

                            Perguntas
                            <span class="<?php echo $styleBadgeQuestions; ?>"><?php echo count($searchQuestions); ?>


                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <?php $styleBadgeProfiles = count($searchProfiles) != 0 ? 'badge bg-primary ms-2' : 'd-none'; ?>
                        <a class="nav-link normal-14-bold-p question-p" id="ex2-tab-2" data-mdb-toggle="tab" href="#ex2-tabs-2" role="tab" aria-controls="ex2-tabs-2" aria-selected="false">

                            Perfis
                            <span class="<?php echo $styleBadgeProfiles; ?>"><?php echo count($searchProfiles); ?>

                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <?php $styleBadgeMaterials = count($searchMaterials) != 0 ? 'badge bg-primary ms-2' : 'd-none'; ?>
                        <a class="nav-link normal-14-bold-p question-p" id="ex2-tab-3" data-mdb-toggle="tab" href="#ex2-tabs-3" role="tab" aria-controls="ex2-tabs-3" aria-selected="false">

                            Material de Apoio
                            <span class="<?php echo $styleBadgeMaterials; ?>"><?php echo count($searchMaterials); ?>

                        </a>
                    </li>
                </ul>
                <!-- Tabs navs -->

                <!-- Tabs content -->
                <div class="tab-content" id="ex2-content">
                    <div class="tab-pane fade show active" id="ex2-tabs-1" role="tabpanel" aria-labelledby="ex2-tab-1">

                        <?php
                        if (count($searchQuestions) == 0) {
                            $notFound = 'd-block';
                            $listQuestions = 'd-none';
                        } else {
                            $notFound = 'd-none';
                            $listQuestions = 'd-block';
                        }
                        ?>

                        <!-- Lista de questões ⬇️ -->
                        <div class="cont <?php echo $listQuestions; ?>">

                            <?php for ($i = 0; $i < count($searchQuestions); $i++) {
                                $row = $searchQuestions[$i] ?>

                                <div class="normal-12-medium-tiny gray-text-5 margin-bot-15">
                                    <?php echo $row->created; ?> •
                                    <?php echo $row->course; ?> •
                                    <?php echo $row->category; ?> •
                                    <?php echo $row->subject; ?>
                                </div>

                                <!-- Create the editor container -->
                                <div class="ql-snow ql-editor2">
                                    <div class="ql-editor2 white-text line-clamp-2">
                                        <p class="white-text line-clamp-2" style="font-weight: bolder;">
                                            <?php echo $row->question; ?>
                                        </p>
                                    </div>
                                </div>

                                <?php $countAnswersOfQuestion = Answer::countAnswers($row->questionId); ?>
                                <div class="question-footer">
                                    <?php
                                    $answer = new Answer();
                                    $countAnswersOfQuestion = $answer->countAnswers($row->questionId);

                                    $styleCounter = empty($countAnswersOfQuestion) ? 'question-footer-div' : 'question-answers my-question-footer-div';
                                    ?>
                                    <div class="<?php echo $styleCounter; ?>" id="respostaQuant">
                                        <p class="normal-14-bold-p white-text question-p">
                                            <?php echo $countAnswersOfQuestion; ?>
                                        </p>
                                    </div>
                                    <div>
                                        <a href="<?php echo $row->linkQuestion; ?>" target="_blank">
                                            <label class="see-btn pointer white-title normal-14-bold-p">
                                                <p class="normal-14-bold-p question-p white-text">
                                                    Ver
                                                </p>
                                            </label>
                                        </a>
                                    </div>
                                </div>


                                <hr class="w-100 my-hr">

                            <?php } ?>
                        </div>

                        <div class="not-found-container <?php echo $notFound; ?>">
                            <img src="../../images/not-found.svg" class="img-not-found" alt="Nada encontrado">
                            <p class="not-found-text-cont white-title normal-14-medium-p">
                            <p class="not-found-text-title white-title normal-14-medium-p">
                                Nenhum resultado para <span class="white-title">"<?php echo $searchResult; ?>"</span>.
                            </p>
                            <p class="not-found-text gray-text-6 normal-14-medium-p">
                                Dica: Tente usar palavras chaves diferentes
                            </p>
                            </p>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="ex2-tabs-2" role="tabpanel" aria-labelledby="ex2-tab-2">

                        <?php

                        if (count($searchProfiles) == 0) {
                            $notFound = 'd-flex';
                            $listProfiles = 'd-block';
                        } else {
                            $notFound = 'd-none';
                            $listProfiles = 'd-block';
                        }
                        ?>
                        <!-- Lista de perfis ⬇️ -->
                        <div class="<?php echo $listProfiles; ?>">

                            <?php for ($i = 0; $i < count($searchProfiles); $i++) {
                                $row = $searchProfiles[$i] ?>

                                <?php
                                if ($row->studentID == 0) {
                                    $displayProfileSchool = 'd-block';
                                    $displayProfileStudent = 'd-none';
                                } else {
                                    $displayProfileSchool = 'd-none';
                                    $displayProfileStudent = 'd-block';
                                }
                                ?>

                                <!-- Perfil aluno ⬇️ -->

                                <div class="<?php echo $displayProfileStudent; ?>">

                                    <div class="my-question-info">
                                        <a href="<?php echo $row->linkStudent; ?>">
                                            <div class="img-container">
                                                <img style="width: 75px; height: 75px; object-fit: cover; border-radius: 50px; margin-top: 25px; margin-bottom: 25px;" src="<?php echo $row->photoStudent; ?>" alt="<?php echo $row->firstName; ?>">
                                            </div>
                                        </a>
                                        <div class="q-i-t">
                                            <div class="question-info-text">

                                                <a href="<?php echo $row->linkStudent; ?>">
                                                    <div class="question-name question-about-a normal-14-medium-p">
                                                        <?php echo $row->firstName; ?> <?php echo $row->surname; ?>
                                                    </div>

                                                    <div class="question-about normal-12-medium-tiny" style="margin-top: 4px;">
                                                        <?php echo $row->module; ?> •
                                                        <?php echo $row->course; ?> •
                                                        <?php echo $row->school; ?>
                                                    </div>
                                                </a>

                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <a href="<?php echo $row->linkStudent; ?>" target="_blank">
                                                    <label class="see-btn white-title pointer normal-14-bold-p">
                                                        <p class="normal-14-bold-p question-p white-text">
                                                            Ver
                                                        </p>
                                                    </label>
                                                </a>

                                            </div>
                                        </div>
                                    </div>

                                    <hr class="my-hr w-100">
                                </div>

                                <!-- Perfil escola ⬇️ -->
                                <div class="<?php echo $displayProfileSchool; ?>">

                                    <div class="my-question-info">

                                        <a href="<?php echo $row->schoolLink; ?>">
                                            <div>
                                                <img style="width: 70px; height: 70px; object-fit: cover; border-radius: 50px; margin-right: 8px; margin-top: 25px; margin-bottom: 25px;" src="<?php echo $row->schoolPhoto; ?>" alt="<?php echo $row->schoolName; ?>" width="100">
                                            </div>
                                        </a>
                                        <div class="q-i-t">
                                            <div class="question-info-text">
                                                <a href="<?php echo $row->schoolLink; ?>">
                                                    <div class="question-name question-about-a normal-14-medium-p">
                                                        <?php echo $row->schoolName; ?>
                                                    </div>

                                                    <div class="question-about normal-12-medium-tiny" style="margin-top: 4px;">
                                                        <?php echo $row->address; ?>, São Paulo
                                                    </div>
                                                </a>
                                            </div>
                                            <div class=" d-flex justify-content-end">
                                                <a href="<?php echo $row->schoolLink; ?>" target="_blank">
                                                    <label class="see-btn white-title pointer normal-14-bold-p">
                                                        <p class="normal-14-bold-p question-p white-text">
                                                            Ver
                                                        </p>
                                                    </label>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                    <hr class="w-100 my-hr">
                                </div>

                            <?php } ?>

                        </div>

                        <div class="not-found-container <?php echo $notFound; ?>">
                            <img src="../../images/not-found.svg" class="img-not-found" alt="Nada encontrado">
                            <p class="not-found-text-cont white-title normal-14-medium-p">
                            <p class="not-found-text-title white-title normal-14-medium-p">
                                Nenhum resultado para <span class="white-title">"<?php echo $searchResult; ?>"</span>.
                            </p>
                            <p class="not-found-text gray-text-6 normal-14-medium-p">
                                Dica: Tente usar palavras chaves diferentes
                            </p>
                            </p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="ex2-tabs-3" role="tabpanel" aria-labelledby="ex2-tab-3">

                        <?php
                        if (count($searchMaterials) == 0) {
                            $notFound = 'd-block';
                            $listMaterials = 'd-none';
                        } else {
                            $notFound = 'd-none';
                            $listMaterials = 'd-block';
                        }
                        ?>

                        <!-- Lista de materiais ⬇️ -->
                        <div class="cont <?php echo $listMaterials; ?>">

                            <?php for ($i = 0; $i < count($searchMaterials); $i++) {
                                $row = $searchMaterials[$i] ?>

                                <div class="normal-12-medium-tiny gray-text-5 margin-bot-15">
                                    <?php echo $row->created; ?> •
                                    <?php echo $row->course; ?> •
                                    <?php echo $row->category; ?> •
                                    <?php echo $row->subject; ?>
                                </div>

                                <!-- Create the editor container -->
                                <div class="ql-snow ql-editor2">
                                    <div class="ql-editor2 gray-text-7 whitney-16-medium-text line-clamp-2">
                                        <?php echo $row->question; ?>
                                    </div>
                                </div>

                                <?php $countAnswersOfQuestion = Answer::countAnswers($row->questionId); ?>
                                <div class="question-footer">
                                    <?php
                                    $answer = new Answer();
                                    $countAnswersOfQuestion = $answer->countAnswers($row->questionId);

                                    $styleCounter = empty($countAnswersOfQuestion) ? 'question-footer-div' : 'question-answers my-question-footer-div';
                                    ?>
                                    <div class="<?php echo $styleCounter; ?>" id="respostaQuant">
                                        <p class="normal-14-bold-p white-text question-p">
                                            <?php echo $countAnswersOfQuestion; ?>
                                        </p>

                                    </div>

                                    <a href="<?php echo $row->linkQuestion; ?>" target="_blank">
                                        <label class="see-btn white-title pointer normal-14-bold-p">Ver</label>
                                    </a>
                                </div>
                                <hr class="w-100 my-hr">

                            <?php } ?>
                        </div>

                        <div class="not-found-container d-flex <?php echo $notFound; ?>">
                            <img src="../../images/not-found.svg" class="img-not-found" alt="Nada encontrado">
                            <p class="not-found-text-cont white-title normal-14-medium-p">
                            <p class="not-found-text-title white-title normal-14-medium-p">
                                Nenhum resultado para <span class="white-title">"<?php echo $searchResult; ?>"</span>.
                            </p>
                            <p class="not-found-text gray-text-6 normal-14-medium-p">
                                Dica: Tente usar palavras chaves diferentes
                            </p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="feed-leftbar feed-rightbar">
            <ul class="rightbar-ul">
                <li class="rightbar-li">
                    <a href="../../../logout/logout.controller.php" class="white-text logout-a">
                        <div class="logout-div">
                            <p class="normal-14-bold-p question-p">
                                Sair
                            </p>
                        </div>
                    </a>
                    <hr class="detail-question-hr">
                </li>
                <li class="rightbar-li">
                    <p class="leftbar-categoria normal-14-bold-p">Ranking de usuários</p>
                </li>

                <div>
                    <!-- Tabs navs -->
                    <ul class="nav nav-tabs nav-fill ranking-ul mb-3" id="ex1" role="tablist">
                        <li class="nav-item ranking-li" role="presentation">

                            <a class="nav-link ranking-a active whitney-10-bold-tiny" id="ex2-tab-11" data-mdb-toggle="tab" href="#ex2-tabs-11" role="tab" aria-controls="ex2-tabs-11" aria-selected="true">Todos</a>
                        </li>
                        <li class="nav-item ranking-li" role="presentation">
                            <a class="nav-link ranking-a whitney-10-bold-tiny" id="ex2-tab-12" data-mdb-toggle="tab" href="#ex2-tabs-12" role="tab" aria-controls="ex2-tabs-12" aria-selected="false">Seguindo</a>

                        </li>
                    </ul>
                    <!-- Tabs navs -->

                    <!-- Tabs content -->
                    <div class="tab-content" id="ex2-content">

                        <div class="tab-pane fade show active" id="ex2-tabs-11" role="tabpanel" aria-labelledby="ex2-tab-11">


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

                                        <a href="<?php echo $row->linkProfile; ?>">
                                            <img src="<?php echo $row->photo; ?>" alt="<?php echo $row->name; ?>" style="width: 40px; height: 40px; border-radius: 40px; object-fit: cover; margin-right: 10px;">
                                        </a>
                                        <a href="<?php echo $row->linkProfile; ?>">
                                            <p class="question-p white-text text-truncate normal-14-bold-p" style="max-width: 100px;">
                                                <?php echo $row->name; ?>
                                            </p>
                                        </a>

                                    </div>

                                    <span class="<?php echo $badgeColor; ?>"> <?php echo $row->xp; ?>xp</span>
                                </div>

                            <?php } ?>

                        </div>
                        <div class="tab-pane fade" id="ex2-tabs-12" role="tabpanel" aria-labelledby="ex2-tab-12">


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

                                        <a href="<?php echo $row['profile_link']; ?>">
                                            <img src="<?php echo $row['photo']; ?>" alt="<?php echo $row['first_name']; ?>" style="width: 40px; height: 40px; border-radius: 40px; object-fit: cover; margin-right: 10px;">
                                        </a>
                                        <a href="<?php echo $row['profile_link']; ?>">
                                            <p class="question-p white-text text-truncate normal-14-bold-p" style="max-width: 100px">
                                                <?php echo $row['first_name']; ?>
                                            </p>
                                        </a>

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
                Copyright © Cold Wolf - 2022. Todos os direitos reservados
            </p>
        </nav>

        <nav class="feed-bottombar">
            <a href="../home/home.page.php" class="bottombar-a">
                <img src="../../../../views/images/components/dashboard-img.svg" alt="">
            </a>
            <a href="../feed-following/feed-following.page.php?userID=<?php echo $idUser; ?>" class="bottombar-a">
                <img src="../../../../views/images/components/following-icon.svg" alt="">
            </a>
            <!-- <a href="#" class="bottombar-a">
                <img src="../../../../views/images/components/notifications-icon.svg" alt="">
            </a> -->
            <a href="../detail-perfil-student/detail-perfil-student.page.php?idStudent=<?php echo $studentPerfil->id; ?>" class="bottombar-a" target="_blank">
                <img src="<?php echo $studentPerfil->photo; ?>" alt="<?php echo $studentPerfil->firstName; ?>" style="width: 25px; height: 25px; border-radius: 22px; object-fit: cover;">
            </a>
        </nav>
</div>

<!-- Tabs content -->

<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.js"></script>
</body>

</html>