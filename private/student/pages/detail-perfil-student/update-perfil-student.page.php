<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-student.controller.php');
require_once('/xampp/htdocs' . '/project/classes/users/StudentMethods.class.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Module.class.php');
require_once('/xampp/htdocs' . '/project/classes/preferences/Preference.class.php');
require_once('/xampp/htdocs' . '/project/classes/rankings/Ranking.class.php');


try {
    $idUser = $_SESSION['idUser'];
    $idStudent = $_GET['idStudentLogged'];

    $student = new StudentMethods();
    $studentPerfil = $student->getDataStudentByID($idStudent);
    $listPreferences = Preference::getPreferencesUser($idUser);
    $studentId = $student->getStudentByUserID($idUser);

    $ranking = new Ranking();
    $colocationTotal = $ranking->colocationTotal();
    $positionRankingAll = $ranking->colocationTotalAll($studentId[0]['id']);

    $colocationFollowers = $ranking->colocationFllowers($idUser);
    $positionBetweenFollowers = $ranking->colocationFllowersAll($idUser);

    $module = new Module();
    $listModules = $module->getModuleForStudentUpdate($studentPerfil->moduleId);
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
    <title>Editar perfil | Heelp!</title>

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Icon -->
    <link rel="shortcut icon" href="../../../../views/images/favicon/favicon-16x16.png" type="image/x-icon">

    <!-- Link dos estilos gerais -->
    <link rel="stylesheet" href="../../../../views/styles/colors.style.css">
    <link rel="stylesheet" href="../../../../views/styles/font-format.style.css">
    <link rel="stylesheet" href="../../../../views/styles/fonts.style.css">
    <link rel="stylesheet" href="../../../../views/styles/style.global.css">

    <!-- Link do estilo de editar -->
    <link rel="stylesheet" href="../../../adm/pages/register/registration panel/registration-panel-style.css">
    <link rel="stylesheet" href="../../../adm/pages/register/register.styles.css">
    <link rel="stylesheet" href="../../styles/feed.style.css">

    <!-- Link da estilização especifica do update -->
    <link rel="stylesheet" href="../../../style/update-profile-student.css">

    <link rel="stylesheet" href="../../../style/modal-about.style.css">

    <link rel="stylesheet" href="../../../../views/pages/register/register-student/register-student.style.css">
</head>

<body>

    <div class="wrapper">
        <nav class="feed-leftbar">

            <div class="leftbar-top">

                <a href="../home/home.page.php" class="feed-logo">
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
                        <a href="../feed-following/feed-following.page.php?userID=<?php echo $idUser; ?>" class="sidebar-a-items leftbar-a">
                            <img class="leftbar-icon" src="../../../../views/images/components/following-icon.svg" alt="">
                            <p class="leftbar-text normal-18-bold-title-2">Seguindo</p>
                        </a>
                    </li>

                    <li class="sidebar-li leftbar-li">

                        <hr class="sidebar-linha leftbar-linha">
                    </li>

                    <li class="sidebar-li leftbar-li">
                        <p class="my-leftbar-categoria normal-14-bold-p">Para você</p>
                    </li>

                    <!-- Lista de preferências ⬇️ -->
                    <?php for ($i = 0; $i < count($listPreferences); $i++) {
                        $row = $listPreferences[$i] ?>

                        <a href="../preferences/preference.page.php?preference=<?php echo $row->id; ?>">
                            <div class="d-flex question-info pref-sidebar-a-items" style="padding-top: 6px; padding-bottom: 6px;">
                                <img src="<?php echo $row->photo; ?>" alt="<?php echo $row->name; ?>" style="margin-right: 8px;" width="32px">
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


        </nav>


        <div class="corpo-feed">
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

            <!-- Mensagem de alerta ⬇️ -->
            <?php if (isset($_SESSION['statusAlert']) && $_SESSION != '') { ?>

                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </symbol>
                </svg>

                <div class="alert alert-warning d-flex align-items-center  alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div>
                        <strong>Ops...</strong>
                        <?php echo $_SESSION['statusAlert']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            <?php unset($_SESSION['statusAlert']);
            } ?>

            <div class="feed-div">

                <div class="profile-div">

                    <div class="profile-top"></div>

                    <div style="padding: 20px;">

                        <form action="./controller/update-perfil-student.controller.php?idStudentLogged=<?php echo $studentPerfil->id; ?>&idUser=<?php echo $studentPerfil->userId; ?>" method="post" enctype="multipart/form-data">

                            <div class="profile-header-left-u">
                                <img class="image-link profile-pic profile-pic-img" src="<?php echo $studentPerfil->photo; ?>" alt="<?php echo $studentPerfil->firstName; ?>" id="imageFile">

                            </div>
                            <div class="container container-update-foto">
                                <p class="margin-botao-foto">
                                    <input type="hidden" name="oldPhoto" value="<?php echo $studentPerfil->photo; ?>">
                                    <input type="file" name="updatePhoto" id="file" onchange="previewImage(this)">
                                <div style="display: flex; flex-direction: column; align-content: center; width: 100%; align-items: center;">
                                    <div>
                                        <label class="input-file1  normal-14-bold-p updt-ph" for="file" id="updatePhoto">Atualizar foto</label>

                                        <span id="file-name" class="slc-arch normal-12-medium-tiny gray-text-6">Nenhum arquivo selecionado</span>
                                    </div>
                                </div>
                                </p>

                            </div>

                            <div class="border-bottom"></div>

                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                            <h6 class="normal-14-medium-p"> Dados principais</h6>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <p>
                                                <label for="" class="normal-14-medium-p nameA">Nome</label><br>
                                                <input class="normal-12-medium-tiny input-name" type="text" name="firstName" id="" value="<?php echo $studentPerfil->firstName; ?>">
                                            </p>

                                            <p>
                                                <label for="" class="normal-14-medium-p sobrenomeA">Sobrenome</label><br>
                                                <input class="normal-12-medium-tiny input-sobrenome" type="text" name="surname" id="" value="<?php echo $studentPerfil->surname; ?>">
                                            </p>


                                            <label for="" class="normal-14-medium-p moduloA">Módulo</label>
                                            <select name="module" class="selectModule w-100 testechato">
                                                <optgroup label="Módulo atual" class="testechato">
                                                    <option class="testechato" value="<?php echo $studentPerfil->moduleId; ?>"><?php echo $studentPerfil->module; ?></option>
                                                </optgroup>


                                                <optgroup label="Lista de módulos" class="testechato">
                                                    <?php for ($i = 0; $i < count($listModules); $i++) {
                                                        $row = $listModules[$i] ?>
                                                        <option class="testechato" value="<?php echo $row->id ?>"> <?php echo $row->name ?> </option>
                                                    <?php } ?>
                                                </optgroup>
                                            </select>

                                        </div>
                                    </div>
                                </div>



                                <div class="border-bottom"></div>

                                <div class="accordion accordion-flush accordion-Style" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                <h6 class="normal-14-medium-p">Links</h6>
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <p>
                                                    <label class="normal-14-medium-p nameGeral" for="">Linkedin</label><br>
                                                    <input class="input-Geral" placeholder="Copie e cole a URL" type="text" name="linkedin" id="" value="<?php echo $studentPerfil->linkedin; ?>">
                                                </p>

                                                <p>
                                                    <label class="normal-14-medium-p nameGeral" for="">GitHub</label><br>
                                                    <input class="input-Geral" placeholder="Copie e cole a URL" type="text" name="github" id="" value="<?php echo $studentPerfil->github; ?>">
                                                </p>

                                                <p>
                                                    <label class="normal-14-medium-p nameGeral" for="">Facebook</label><br>
                                                    <input class="input-Geral" placeholder="Copie e cole a URL" type="text" name="facebook" id="" value="<?php echo $studentPerfil->facebook; ?>">
                                                </p>

                                                <p>
                                                    <label class="normal-14-medium-p nameGeral" for="">Instagram</label><br>
                                                    <input class="input-Geral" placeholder="Copie e cole a URL" type="text" name="instagram" id="" value="<?php echo $studentPerfil->instagram; ?>">
                                                </p>



                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-bottom"></div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                <h6 class="normal-14-medium-p">Senha</h6>
                                            </button>
                                        </h2>
                                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">

                                                <p>
                                                    <label class="normal-14-medium-p nameGeral" for="">Senha antiga</label><br>
                                                    <input class="input-Geral" type="password" name="oldPassword" id="oldPassword" placeholder="Digite a sua senha antiga">
                                                </p>

                                                <p>
                                                <div class="container-input-and-icon">
                                                    <label class="normal-14-medium-p nameGeral" for="">Senha atual</label><br>
                                                    <input class="input-Geral pass-input" type="password" name="newPassword" id="newPassword" placeholder="Digite a sua nova senha" minlength="6">
                                                    <img src="../../../../views/pages/register/image/components/show-pass.svg" class="eye-icon" alt="Visualizar senha" id="eyeOpened" onclick="openEyee()">
                                                </div>
                                                </p>

                                                <p>
                                                    <label class="normal-14-medium-p nameGeral" for="">Confirme a sua senha atual</label><br>
                                                    <input class="input-Geral" type="password" name="passwordConfirm" id="passwordConfirm" placeholder="Confirme a sua senha" minlength="6">
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="container posicao-Botao">
                                    <a href="../detail-perfil-student/detail-perfil-student.page.php?idStudent=<?php echo $studentPerfil->id; ?>" class="botao-cancelar normal-14-medium-p d-flex justify-content-center">
                                        <input style="border: none; background-color: #fff;" type="button" value="Cancelar">
                                    </a>
                                    <input class="botao-Atualizar normal-14-medium-p" type="submit" onclick="validarSenha();" name="update" value="Atualizar perfil">
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav class="feed-leftbar feed-rightbar">
        <ul class="rightbar-ul">


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
        <a href="../home/home.page.php" class="bottombar-a">
            <img src="../../../../views/images/components/dashboard-img.svg" alt="">
        </a>
        <a href="../feed-following/feed-following.page.php?userID=<?php echo $idUser; ?>" class="bottombar-a">
            <img src="../../../../views/images/components/following-icon.svg" alt="">
        </a>
        <a href="../detail-perfil-student/detail-perfil-student.page.php?idStudent=<?php echo $studentPerfil->id; ?>" class="bottombar-a" target="_blank">
            <img src="<?php echo $studentPerfil->photo; ?>" alt="<?php echo $studentPerfil->firstName; ?>" style="width: 25px; height: 25px; border-radius: 22px; object-fit: cover;">
        </a>
    </nav>
    </div>
    <script>
        const eye = document.getElementById("eyeOpened");
        const eyeConfirm = document.getElementById("eyeOpenedConfirm");

        const input = document.getElementById("newPassword");
        const input2 = document.getElementById("passwordConfirm");
        const input3 = document.getElementById("oldPassword");

        function openEyee() {
            let inputTypePasswordNew = input.type == "password";
            let inputTypePasswordNewConfirm = input2.type == "password";

            if (inputTypePasswordNew || inputTypePasswordNewConfirm) {
                showPassword();
            } else {
                hidePassword();
            }
        }

        function showPassword() {

            input.setAttribute("type", "text");
            input2.setAttribute("type", "text");
            input3.setAttribute("type", "text");
            eye.setAttribute("src", "/project/views/pages/register/image/components/hide-pass.svg");
        }

        function hidePassword() {


            input.setAttribute("type", "password");
            input2.setAttribute("type", "password");
            input3.setAttribute("type", "password");
            eye.setAttribute("src", "/project/views/pages/register/image/components/show-pass.svg");
        }
    </script>

    <script>
        let senha = document.getElementById('newPassword');
        let senhaC = document.getElementById('passwordConfirm');

        function validarSenha() {
            if (senha.value != senhaC.value) {
                senhaC.setCustomValidity("As senhas não coincidem!");
                senhaC.reportValidity();
                return false;
            } else {
                senhaC.setCustomValidity("");
                return true;
            }
        }
    </script>

    <!-- JS mostrar senha -->
    <script src="../../../../views/js/password-visibility.js"></script>

    <!-- JS senhas coincidem e e-mail institucional -->
    <script src="../../../../views/js/register-student.js"></script>
    <!-- JS JQuery ⬇️ -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- JS Bootstrap ⬇️ -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.js"></script>
    <!-- JS Select Multiple ⬇️ -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(".selectModule").select2({
            allowClear: true
        });
    </script>

    <script>
        function previewImage(self) {
            const imageFile = document.getElementById("imageFile");
            const file = self && self.files[0];

            if (!file) {
                imageFile.style.display = "none";
                return;
            }

            if (file) {
                imageFile.style.display = "block";
                imageFile.src = URL.createObjectURL(file);
                return;
            }
        }
    </script>
    <!-- JS arquvio selecionado -->
    <script>
        let inputFile = document.getElementById('file');
        let fileNameField = document.getElementById('file-name');
        inputFile.addEventListener('change', function(event) {
            let uploadedFileName = event.target.files[0].name;
            fileNameField.textContent = uploadedFileName;
        })
    </script>



</body>

</html>