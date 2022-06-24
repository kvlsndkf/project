<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-student.controller.php');
require_once('/xampp/htdocs' . '/project/classes/schools/School.class.php');
require_once('/xampp/htdocs' . '/project/classes/users/StudentMethods.class.php');
require_once('/xampp/htdocs' . '/project/classes/preferences/Preference.class.php');

try {
    $idUser = $_SESSION['idUser'];
    $schoolID = $_GET['schoolID'];

    $school = new School();
    $profileSchool = $school->schoolProfile($schoolID);
    $studentsInSchool = $school->countStudentsInSchool($schoolID);
    $teachersInSchool = $school->countTeachersInSchool($schoolID);
    $coursesInSchool = $school->getCoursesInSchool($schoolID);

    $listTeachersInSchool = $school->listTeachersInSchool($schoolID);

    $student = new StudentMethods();
    $studentLogged = $student->getStudentByUserID($idUser);
    $studentPerfil = $student->getDataStudentByID($studentLogged[0]['id']);

    $listPreferences = Preference::getPreferencesUser($idUser);
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
    <title><?php echo $profileSchool->name; ?> | Heelp!</title>
    <link rel="shortcut icon" href="../../views/images/favicon/favicon-16x16.png" type="image/x-icon">

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
    <link rel="stylesheet" href="../../views/styles/style.global.css">
    <link rel="stylesheet" href="../../views/styles/fonts.style.css">
    <link rel="stylesheet" href="../style/modal-about.style.css">
    <link rel="stylesheet" href="../adm/pages/register/register.styles.css">
    <link rel="stylesheet" href="../adm/pages/register/registration panel/registration-panel-style.css">
    <link rel="stylesheet" href="../student/styles/feed.style.css">

</head>

<body>

    <div class="wrapper">

        <nav class="feed-leftbar">

            <div class="leftbar-top">

                <a href="#" class="feed-logo">
                    <img src="../../views/images/logo/logo-help.svg" alt="" class="logo-heelp-img">
                    <h4 class="logo-heelp-text normal-22-black-title-1">heelp!</h4>
                </a>

                <ul class="feed-ul">

                    <li class="sidebar-li leftbar-li">
                        <a href="../student/pages/home/home.page.php" class="sidebar-a-items leftbar-a">
                            <img class="leftbar-icon" src="../../views/images/components/dashboard-img.svg" alt="">
                            <p class="normal-18-bold-title-2 leftbar-text">Feed</p>
                        </a>
                    </li>

                    <li class="sidebar-li leftbar-li">
                        <a href="../feed-following/feed-following.page.php?userID=<?php echo $idUser; ?>" class="sidebar-a-items leftbar-a">
                            <img class="leftbar-icon" src="../../views/images/components/following-icon.svg" alt="">
                            <p class="leftbar-text normal-18-bold-title-2">Seguindo</p>
                        </a>
                        <hr class="sidebar-linha leftbar-linha">
                    </li>
                    <li class="sidebar-li leftbar-li">
                        <p class="leftbar-categoria normal-14-bold-p">Para você</p>
                    </li>
                    <!-- Lista de preferências ⬇️ -->
                    <?php for ($i = 0; $i < count($listPreferences); $i++) {
                        $row = $listPreferences[$i] ?>

                        <a href="../student/pages/preferences/preference.page.php?preference=<?php echo $row->id; ?>" class="preferences-a">
                            <div class="d-flex question-info margin-bot-15">
                                <img src="<?php echo $row->photo; ?>" alt="<?php echo $row->name; ?>" style="margin-right: 8px;">
                                <p class="white-text question-p normal-16-bold-title-3 text-truncate">
                                    <?php echo $row->name; ?>
                                </p>
                            </div>
                        </a>

                    <?php } ?>

                    <li class="sidebar-li leftbar-li">
                        <a href="../student/pages/question/question.page.php" class="pedir-heelp-button-a normal-14-bold-p">
                            <div class="leftbar-button-div">
                                <p class="sidebar-button-text">Pedir um heelp!</p>
                            </div>
                        </a>
                    </li>

                </ul>


            </div>

            <div class="leftbar-bottom">

                <div class="bottom-header">

                    <a href="../student/pages/detail-perfil-student/detail-perfil-student.page.php?idStudent=<?php echo $studentPerfil->id; ?>" target="_blank">
                        <div class="bottom-photo-div">
                            <img src="<?php echo $studentPerfil->photo; ?>" alt="<?php echo $studentPerfil->firstName; ?>" class="bottom-photo-img">
                        </div>
                    </a>

                    <!-- Mais Opções -->
                    <div class="drop-edit-exclud-about drop-leftbar">
                        <img src="../../views/images/components/three-dots.svg">

                        <!-- Parte do Update e Delete -->
                        <div class="drop-edit-exclud-content-about drop-leftbar-content">
                            <a href="../student/pages/detail-perfil-student/update-perfil-student.page.php?idStudentLogged=<?php echo $studentPerfil->id; ?>" target="_blank" class="drop-edit-exclud-a">
                                <div class="drop-edit-exclud-option-about">
                                    <img src="../../views/images/components/settings-icon.svg" class="drop-edit-exclud-img">
                                    <p class="drop-edit-exclud-text-about normal-14-bold-p">Configurações</p>
                                </div>
                            </a>
                            <div class=" pedir-heelp-button-a">
                                <a href="../logout/logout.controller.php" class="drop-edit-exclud-a pedir-heelp-button-a">
                                    <div class="drop-edit-exclud-option-about pedir-heelp-button-a drop-sair">
                                        <img src="../../views/images/components/logout-icon.svg" class="drop-edit-exclud-img">
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


                <a class="normal-16-bold-title-3 white-text bottom-name" href="../student/pages/detail-perfil-student/detail-perfil-student.page.php?idStudent=<?php echo $studentPerfil->id; ?>" target="_blank">
                    <?php echo $studentPerfil->firstName;
                    echo " " . $studentPerfil->surname; ?>
                </a>

            </div>

        </nav>

        <div class="corpo-feed">

            <div class="feed-div">


                <!-- Barra de pesquisa -->
                <form action="../student/pages/search/search.page.php" method="get" class="search-form">
                    <input type="text" name="search" id="" placeholder="Encontre perguntas, pessoas ou materiais" autocomplete="off" class="search-input">
                    <input type="submit" value="🔍" class="search-submit">
                </form>

                <div class="profile-div">

                    <div class="profile-top"></div>

                    <div style="padding: 20px;">
                        <img src="<?php echo $profileSchool->photo; ?>" alt="<?php echo $profileSchool->name; ?>" class="profile-pic-img margin-bot-15">

                        <p class="white-text question-p normal-16-bold-title-3">
                            <?php echo $profileSchool->name; ?>
                        </p>
                        <p class="question-about margin-bot-15 normal-12-medium-tiny">
                            <?php echo $profileSchool->address; ?>, São Paulo
                        </p>

                        <div class="question-info margin-bot-15">
                            <div class="profile-follows profile-follows-a" style="margin-right: 10px;">
                                <p class="normal-14-bold-p white-text question-p">
                                    <?php echo $studentsInSchool[0]['total']; ?>&nbsp
                                </p>
                                <p class="question-about normal-12-medium-tiny">
                                    alunos
                                </p>
                            </div>

                            <div class="profile-follows profile-follows-a">
                                <p class="normal-14-bold-p white-text question-p">
                                    <?php echo $teachersInSchool; ?>&nbsp
                                </p>
                                <p class="question-about normal-12-medium-tiny">
                                    professores
                                </p>
                            </div>
                        </div>

                        <p>
                            <?php $styleLinkedin = empty($profileSchool->linkedin) ? 'd-none' : ''; ?>
                            <a href="<?php echo $profileSchool->linkedin; ?>" class="<?php echo $styleLinkedin; ?>" target="_blank">
                                <img src="../adm/images/icons/linkedin.svg" alt="linkedin">
                            </a>

                            <?php $styleGithub = empty($profileSchool->github) ? 'd-none' : ''; ?>
                            <a href="<?php echo $profileSchool->github; ?>" class="<?php echo $styleGithub; ?>" target="_blank">
                                <img src="../adm/images/icons/github.svg" alt="github">
                            </a>

                            <?php $styleFacebook = empty($profileSchool->facebook) ? 'd-none' : ''; ?>
                            <a href="<?php echo $profileSchool->facebook; ?>" class="<?php echo $styleFacebook; ?>" target="_blank">
                                <img src="../adm/images/icons/facebook.svg" alt="facebook">
                            </a>

                            <?php $styleInstagram = empty($profileSchool->instagram) ? 'd-none' : ''; ?>
                            <a href="<?php echo $profileSchool->instagram; ?>" class="<?php echo $styleInstagram; ?>" target="_blank">
                                <img src="../adm/images/icons/instagram.svg" alt="instagram">
                            </a>
                        </p>

                    </div>

                    <!-- Tabs navs -->
                    <ul class="nav nav-tabs nav-fill mb-3" id="ex1" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="normal-14-bold-p question-p nav-link userProfile-a active" id="ex2-tab-1" data-mdb-toggle="tab" href="#ex2-tabs-1" role="tab" aria-controls="ex2-tabs-1" aria-selected="true">Sobre</a>
                        </li>
                        <li class="normal-14-bold-p question-p nav-item" role="presentation">
                            <a class="nav-link userProfile-a" id="ex2-tab-2" data-mdb-toggle="tab" href="#ex2-tabs-2" role="tab" aria-controls="ex2-tabs-2" aria-selected="false">Cursos</a>
                        </li>
                        <li class="normal-14-bold-p question-p nav-item" role="presentation">
                            <a class="nav-link userProfile-a" id="ex2-tab-3" data-mdb-toggle="tab" href="#ex2-tabs-3" role="tab" aria-controls="ex2-tabs-3" aria-selected="false">Professores</a>
                        </li>
                    </ul>
                    <!-- Tabs navs -->

                    <!-- Tabs content -->
                    <div class="tab-content padding-20" id="ex2-content">
                        <div class="tab-pane fade show active" id="ex2-tabs-1" role="tabpanel" aria-labelledby="ex2-tab-1">

                            <label class="normal-14-bold-p question-p" style="color: var(--gray6);">Sobre a Etec</label>

                            <p class="white-text whitney-16-medium-text about-school">
                                <?php echo $profileSchool->about; ?>
                            </p>

                        </div>
                        <div class="tab-pane fade" id="ex2-tabs-2" role="tabpanel" aria-labelledby="ex2-tab-2">

                            <!-- Lista de cursos ⬇️ -->
                            <label class="normal-14-bold-p question-p margin-bot-15" style="color: var(--gray6);">Cursos</label>
                            <?php for ($i = 0; $i < count($coursesInSchool); $i++) {
                                $row = $coursesInSchool[$i] ?>

                                <div class="question-info margin-bot-15">
                                    <img src="<?php echo $row->photo; ?>" alt="<?php echo $row->name; ?>">
                                    <p class="normal-16-bold-title-3 white-text question-p" style="margin-left: 10px;">
                                        <?php echo $row->name; ?>
                                    </p>

                                </div>

                                <p class="white-text whitney-16-medium-text about-school">
                                    <?php echo $row->about; ?>
                                </p>

                                <hr class="detail-question-hr" style="margin-bottom: 30px; margin-top: 30px;">
                            <?php } ?>
                        </div>
                        <div class="tab-pane fade" id="ex2-tabs-3" role="tabpanel" aria-labelledby="ex2-tab-3">

                            <!-- Lista de professores ⬇️ -->
                            <label class="normal-14-bold-p question-p margin-bot-15" style="color: var(--gray6);">Professores</label>
                            <?php for ($i = 0; $i < count($listTeachersInSchool); $i++) {
                                $row = $listTeachersInSchool[$i] ?>

                                <div class="question-info">
                                    <img src="<?php echo $row->photo; ?>" alt="<?php echo $row->name; ?>" width="80" height="80" style="margin-right: 8px; border-radius: 80px; object-fit: cover;">
                                    <div>
                                        <p class="normal-16-bold-title-3 white-text question-p">
                                            <?php echo $row->name; ?>
                                        </p>

                                        <p class="normal-12-medium-tiny" style="color: var(--gray5);">
                                            <?php
                                            foreach ($row->courses as $value) {
                                                echo $value . " • ";
                                            }
                                            ?>
                                        </p>
                                    </div>

                                </div>

                                <hr class="detail-question-hr" style="margin-bottom: 30px; margin-top: 30px;">
                            <?php } ?>
                        </div>
                    </div>
                    <!-- Tabs content -->

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
            <a href="../student/pages/home/home.page.php" class="bottombar-a">
                <img src="../../views/images/components/dashboard-img.svg" alt="">
            </a>
            <a href="#" class="bottombar-a">
                <img src="../../views/images/components/following-icon.svg" alt="">
            </a>
            <!-- <a href="#" class="bottombar-a">
                <img src="../../views/images/components/notifications-icon.svg" alt="">
            </a> -->
            <a href="../student/pages/detail-perfil-student/detail-perfil-student.page.php?idStudent=<?php echo $studentPerfil->id; ?>" class="bottombar-a" target="_blank">
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
</body>

</html>