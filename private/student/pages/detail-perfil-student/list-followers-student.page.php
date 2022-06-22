<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-student.controller.php');
require_once('/xampp/htdocs' . '/project/classes/followers/Follow.class.php');
require_once('/xampp/htdocs' . '/project/classes/users/StudentMethods.class.php');

try {
    $idUser = $_SESSION['idUser'];
    $idFollower = $_GET['idFollowers'];

    $student = new StudentMethods();
    $studentSession = $student->getStudentByUserID($idUser);
    $studentPerfil = $student->getDataStudentByID($studentSession[0]['id']);

    $follower = new Follow();
    $listFollowers = $follower->listFollowers($idFollower);
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
    <title>Seguidores | Heelp!</title>

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

            <div class="feed-div">

                <div class="profile-div" style="padding: 20px;">


                    <label class="normal-16-bold-title-3 white-text question-p question-info">
                        <a onclick="history.back()" style="margin-right: 25px;">
                            <img src="../../../../views/images/components/arrow-back.svg" alt="">
                        </a>

                        Seguidores

                    </label>

                    <hr class="detail-question-hr">

                    <!-- Lista de seguidores ⬇️ -->
                    <?php for ($i = 0; $i < count($listFollowers); $i++) {
                        $row = $listFollowers[$i] ?>

                        <div class="question-footer following-profile" style="margin-bottom: 30px; margin-top: 30px; flex-wrap: wrap;">

                            <div class="question-info following-profile" style="flex-wrap: wrap;">

                                <a href=" <?php echo $row->linkProfile; ?>" style="margin-bottom: 5pxs;">
                                    <img src="<?php echo $row->photo; ?>" alt="<?php echo $row->firstName; ?>" width="100" height="100" style="border-radius: 100px; object-fit: cover; margin-right: 10px;">
                                </a>

                                <div class="following-profile">

                                    <a href=" <?php echo $row->linkProfile; ?>" class="normal-16-bold-title-3 white-text question-p">
                                        <?php echo $row->firstName;
                                        echo " " . $row->surname; ?>
                                    </a>

                                    <p class="question-about margin-bot-15 normal-12-medium-tiny">
                                        <?php echo $row->module; ?> •
                                        <?php echo $row->course; ?> •
                                        <?php echo $row->school; ?>
                                    </p>


                                </div>

                            </div>

                            <?php
                            $checkFollow = $follower->checkFollower($idUser, $row->userId);
                            $textButton = $checkFollow == false ? 'Seguir' : 'Deixar de seguir';
                            $displayFollow = $studentSession[0]['id'] == $row->studentId ? 'd-none' : '';
                            ?>
                            <div class="<?php echo $displayFollow; ?> following-profile stop-following" style="margin-top: 15px;">
                                <form class="stop-following" action="./controller/list-followers-user.controller.php?idfollower=<?php echo $idUser; ?>&idFollowing=<?php echo $row->userId; ?>&idPerfil=<?php echo $idFollower; ?>" method="post">
                                    <input type="submit" class="normal-14-bold-p follow-profile-submit" id="follow" value="<?php echo $textButton; ?>" name="follow">
                                </form>
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

</body>

</html>