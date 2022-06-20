<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-student.controller.php');
require_once('/xampp/htdocs' . '/project/classes/researches/Search.class.php');
require_once('/xampp/htdocs' . '/project/classes/answers/Answer.class.php');

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
} catch (Exception $e) {
    echo $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

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

<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="../../../../libs/dist/magnific-popup.css">

<!-- JavaScript -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<div class="wrapper">

    <body>
        <!-- Barra de pesquisa -->
        <!-- <form action="./search.page.php" method="get">
            <input type="text" name="search" id="" placeholder="Encontre perguntas, pessoas ou materiais" value="<?php echo $searchResult; ?>" autocomplete="off">
            <input type="submit" value="pesquisar">
        </form> -->

        <!-- Perfil do canto -->
        <nav class="feed-leftbar">
            <div class="leftbar-top">

                <a href="#" class="feed-logo">
                    <img src="../../../../views/images/logo/logo-help.svg" alt="" class="logo-heelp-img">
                    <h4 class="logo-heelp-text normal-22-black-title-1">heelp!</h4>
                </a>

                <ul class="feed-ul">

                    <li class="sidebar-li leftbar-li">
                        <a href="./home.page.php" class="sidebar-a-items leftbar-a">
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
                                    <div class="drop-edit-exclud-option-about pedir-heelp-button-a">
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
            <div class="feed-div">
<!-- Tabs navs -->
<ul class="nav nav-tabs nav-fill mb-3" id="ex1" role="tablist">
    <li class="nav-item" role="presentation">
        <?php $styleBadgeQuestions = count($searchQuestions) != 0 ? 'badge bg-primary ms-2' : 'd-none'; ?>
        <a class="nav-link active" id="ex2-tab-1" data-mdb-toggle="tab" href="#ex2-tabs-1" role="tab" aria-controls="ex2-tabs-1" aria-selected="true">
            Perguntas
            <span class="<?php echo $styleBadgeQuestions; ?>"><?php echo count($searchQuestions); ?>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <?php $styleBadgeProfiles = count($searchProfiles) != 0 ? 'badge bg-primary ms-2' : 'd-none'; ?>
        <a class="nav-link" id="ex2-tab-2" data-mdb-toggle="tab" href="#ex2-tabs-2" role="tab" aria-controls="ex2-tabs-2" aria-selected="false">
            Perfis
            <span class="<?php echo $styleBadgeProfiles; ?>"><?php echo count($searchProfiles); ?>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <?php $styleBadgeMaterials = count($searchMaterials) != 0 ? 'badge bg-primary ms-2' : 'd-none'; ?>
        <a class="nav-link" id="ex2-tab-3" data-mdb-toggle="tab" href="#ex2-tabs-3" role="tab" aria-controls="ex2-tabs-3" aria-selected="false">
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
        <div class="<?php echo $listQuestions; ?>">

            <?php for ($i = 0; $i < count($searchQuestions); $i++) {
                $row = $searchQuestions[$i] ?>

                <div>
                    <?php echo $row->created; ?> •
                    <?php echo $row->course; ?> •
                    <?php echo $row->category; ?> •
                    <?php echo $row->subject; ?>
                </div>

                <!-- Create the editor container -->
                <div class="ql-snow ql-editor2">
                    <div class="ql-editor2">
                        <?php echo $row->question; ?>
                    </div>
                </div>

                <?php $countAnswersOfQuestion = Answer::countAnswers($row->questionId); ?>

                <p>
                    <?php echo $countAnswersOfQuestion; ?>
                </p>

                <a href="<?php echo $row->linkQuestion; ?>" target="_blank">
                    <button>Ver</button>
                </a>

                <hr>

            <?php } ?>
        </div>

        <div class="<?php echo $notFound; ?>">
            <img src="../../images/not-found.svg" alt="Nada encontrado">
            Nenhum resultado para <strong>"<?php echo $searchResult; ?>"</strong>
            Dica: Tente usar palavras chaves diferentes
        </div>

    </div>
    <div class="tab-pane fade" id="ex2-tabs-2" role="tabpanel" aria-labelledby="ex2-tab-2">

        <?php

        if (count($searchProfiles) == 0) {
            $notFound = 'd-block';
            $listProfiles = 'd-none';
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
                    $displayProfileStudent = 'd-bolck';
                }
                ?>

                <!-- Perfil aluno ⬇️ -->
                <div class="<?php echo $displayProfileStudent; ?>">

                    <div>
                        <img src="<?php echo $row->photoStudent; ?>" alt="<?php echo $row->firstName; ?>" width="100">
                    </div>

                    <div>
                        <?php echo $row->firstName; ?> <?php echo $row->surname; ?>
                    </div>

                    <div>
                        <?php echo $row->module; ?> •
                        <?php echo $row->course; ?> •
                        <?php echo $row->school; ?>
                    </div>

                    <div>
                        <a href="<?php echo $row->linkStudent; ?>" target="_blank">
                            <button>Ver</button>
                        </a>
                    </div>

                    <hr>
                </div>

                <!-- Perfil escola ⬇️ -->
                <div class="<?php echo $displayProfileSchool; ?>">

                    <div>
                        <img src="<?php echo $row->schoolPhoto; ?>" alt="<?php echo $row->schoolName; ?>" width="100">
                    </div>

                    <div>
                        <?php echo $row->schoolName; ?>
                    </div>

                    <div>
                        <?php echo $row->address; ?>, São Paulo
                    </div>

                    <div>
                        <a href="<?php echo $row->schoolLink; ?>" target="_blank">
                            <button>Ver</button>
                        </a>
                    </div>

                    <hr>
                </div>
            <?php } ?>

        </div>

        <div class=" <?php echo $notFound; ?>">
            <img src="../../images/not-found.svg" alt="Nada encontrado">
            Nenhum resultado para <strong>"<?php echo $searchResult; ?>"</strong>.
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

        <!-- Lista de questões ⬇️ -->
        <div class="<?php echo $listMaterials; ?>">

            <?php for ($i = 0; $i < count($searchMaterials); $i++) {
                $row = $searchMaterials[$i] ?>

                <div>
                    <?php echo $row->created; ?> •
                    <?php echo $row->course; ?> •
                    <?php echo $row->category; ?> •
                    <?php echo $row->subject; ?>
                </div>

                <!-- Create the editor container -->
                <div class="ql-snow ql-editor2">
                    <div class="ql-editor2">
                        <?php echo $row->question; ?>
                    </div>
                </div>

                <?php $countAnswersOfQuestion = Answer::countAnswers($row->questionId); ?>

                <p>
                    <?php echo $countAnswersOfQuestion; ?>
                </p>

                <a href="<?php echo $row->linkQuestion; ?>" target="_blank">
                    <button>Ver</button>
                </a>

                <hr>

            <?php } ?>
        </div>

        <div class="<?php echo $notFound; ?>">
            <img src="../../images/not-found.svg" alt="Nada encontrado">
            Nenhum resultado para <strong>"<?php echo $searchResult; ?>"</strong>.
        </div>

    </div>
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

<!-- Tabs content -->

<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.js"></script>
</body>

</html>