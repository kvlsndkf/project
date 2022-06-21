<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-student.controller.php');
require_once('/xampp/htdocs' . '/project/classes/preferences/Preference.class.php');
require_once('/xampp/htdocs' . '/project/classes/answers/Answer.class.php');
require_once('/xampp/htdocs' . '/project/classes/questions/Question.class.php');
require_once('/xampp/htdocs' . '/project/classes/users/StudentMethods.class.php');

try {
    $preferenceID = $_GET['preference'];
    $idUser = $_SESSION['idUser'];

    $preference = new Preference();
    $listPreference = $preference->listPrefereces($preferenceID);
    $detailsPreference = $preference->getNamePreference($preferenceID);

    $question = new Question();

    $student = new StudentMethods();
    $studentId = $student->getStudentByUserID($idUser);
    $studentPerfil = $student->getDataStudentByID($studentId[0]['id']);
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
    <title>Feed <?php echo $detailsPreference->name; ?> | Heelp!</title>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.css" rel="stylesheet" />

    <!-- Include stylesheet -->
    <link href="../../../style/editor-style/editor.style.css" rel="stylesheet">

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

    <!-- Estilo do modal de denunciar -->
    <link rel="stylesheet" href="./modal.css">

    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="../../../../libs/dist/magnific-popup.css">

    <!-- JavaScript -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
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
                        <a href="../question/question.page.php" class="pedir-heelp-button-a normal-14-bold-p">
                            <div class="leftbar-button-div">
                                <p class="sidebar-button-text">Pedir um heelp!</p>
                            </div>
                        </a>
                    </li>

                </ul>


            </div>

            <!-- Perfil do canto
            <div>
                <p>
                    <a href="../../../logout/logout.controller.php">
                        sair
                    </a>

                    <a href="../detail-perfil-student/detail-perfil-student.page.php?idStudent=<?php echo $studentPerfil->id; ?>" target="_blank">
                        perfil
                    </a>

                    <a href="../detail-perfil-student/update-perfil-student.page.php?idStudentLogged=<?php echo $studentPerfil->id; ?>" target="_blank">
                        configurações
                    </a>
                </p>

                <p>
                    <a href="../detail-perfil-student/detail-perfil-student.page.php?idStudent=<?php echo $studentPerfil->id; ?>" target="_blank">
                        <img src="<?php echo $studentPerfil->photo; ?>" alt="<?php echo $studentPerfil->firstName; ?>" width="100">
                    </a>
                </p>

                <p>
                    <?php echo $studentPerfil->xp; ?>
                    xp
                </p>

                <p>
                    <a href="../detail-perfil-student/detail-perfil-student.page.php?idStudent=<?php echo $studentPerfil->id; ?>" target="_blank">
                        <?php echo $studentPerfil->firstName;
                        echo " " . $studentPerfil->surname; ?>
                    </a>
                </p>
            </div>
             -->
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
        <form action="../search/search.page.php" method="get">
            <input type="text" name="search" id="" placeholder="Encontre perguntas, pessoas ou materiais" autocomplete="off">
            <input type="submit" value="pesquisar">
        </form>

        <?php
        if (count($listPreference) == 0) {
            $styleNotFound = 'd-block';
            $stylePreferences = 'd-none';
        } else {
            $styleNotFound = 'd-none';
            $stylePreferences = 'd-block';
        }
        ?>

        <div class="<?php echo $styleNotFound; ?>">
            <img src="../../images/no-preferences.svg" class="img-not-found" alt="">
            <p class="">Sem posts relacionados a <strong><?php echo $detailsPreference->name; ?></strong></p>
        </div>

        <div class="<?php echo $stylePreferences; ?>">
            <!-- Lista de perguntas ⬇️ -->
            <?php for ($i = 0; $i < count($listPreference); $i++) {
                $row = $listPreference[$i] ?>

                <p>
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
                    <span class="badge rounded-pill bg-primary"> <?php echo $row->subject; ?></span>
                </p>

                <p>
                    <a href="<?php echo $row->linkQuestion; ?>" class="d-none" id="linkQuestion-<?php echo $row->id; ?>">Link</a>
                    <span onclick="copyLink(<?php echo $row->id; ?>)" id="spanLink-<?php echo $row->id; ?>">Copiar link</span>
                </p>

                <?php
                $creatorQuestion = $question->getCreatorQuestionById($row->id);
                $creatorQuestionID = $creatorQuestion[0]['student_id'];
                $studentID = $studentId[0]['id'];
                $hasAnswers = $question->hasAnswers($row->id);

                $styleDeleteDisplay = $hasAnswers ? 'd-none' : '';
                $styleDeleteQuestion = $creatorQuestionID == $studentID ? '' : 'd-none';
                ?>
                <p class="<?php echo $styleDeleteQuestion; ?> <?php echo $styleDeleteDisplay; ?>">
                    <a href="../question/controller/delete-question.controller.php?id=<?php echo $row->id; ?>" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete">
                        Excluir
                    </a>
                </p>

                <p>
                    <img src="<?php echo $row->photo; ?>" alt="<?php echo $row->firstName; ?>" style="width: 50px;">
                </p>

                <p>
                    <?php echo $row->firstName; ?>
                    <?php echo $row->surname; ?>
                </p>


                <p>
                    <?php echo $row->created; ?> •
                    <?php echo $row->module; ?> •
                    <?php echo $row->school; ?>
                </p>

                <!-- Create the editor container -->
                <div class="ql-snow ql-editor2">
                    <div class="ql-editor2">
                        <?php echo $row->question; ?>
                    </div>
                </div>

                <br>
                <br>

                <?php $styleImageQuestion = !empty($row->image) ? '' : 'd-none'; ?>
                <p class="<?php echo $styleImageQuestion; ?>">
                    <a href="<?php echo $row->image; ?>" class="image-link">
                        <img src="<?php echo $row->image; ?>" alt="<?php echo $row->firstName; ?>" style="width: 150px;">
                    </a>
                </p>

                <?php $styleDocumentQuestion = !empty($row->document) ? '' : 'd-none'; ?>
                <p class="<?php echo $styleDocumentQuestion; ?>">
                    <?php echo $row->documentName; ?>
                    <a href="<?php echo $row->document; ?>" download="<?php echo $row->documentName; ?>">
                        <button>download</button>
                    </a>
                </p>

                <p>
                    <?php
                    $answer = new Answer();
                    $totalAnswersOfQuestion = $answer->countAnswers($row->id);

                    echo $totalAnswersOfQuestion;
                    ?>
                </p>

                <p>
                    <a href="../detail-question/detail-question.page.php?idQuestion=<?php echo $row->id; ?>">
                        <button>Dar um help</button>
                    </a>
                    <?php echo $row->xp; ?> xp
                </p>

                <hr>
            <?php } ?>
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