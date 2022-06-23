<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-student.controller.php');
require_once('/xampp/htdocs' . '/project/classes/users/StudentMethods.class.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Module.class.php');

try {
    $idStudent = $_GET['idStudentLogged'];

    $student = new StudentMethods();
    $studentPerfil = $student->getDataStudentByID($idStudent);

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
                                <p>
                                    <input type="hidden" name="oldPhoto" value="<?php echo $studentPerfil->photo; ?>">
                                    <input type="file" name="updatePhoto" id="file" onchange="previewImage(this)">
                                    <label class="input-file1  normal-14-bold-p" for="file">Atualizar foto</label>
                                </p>
                            </div>
                            <div class="border-bottom"></div>

                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <h6 class="normal-16-bold-title-3 dadosP"> Dados principais</h6>
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
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
                                                    <input class="input-Geral" type="text" name="linkedin" id="" value="<?php echo $studentPerfil->linkedin; ?>">
                                                </p>

                                                <p>
                                                    <label class="normal-14-medium-p nameGeral" for="">GitHub</label><br>
                                                    <input class="input-Geral" type="text" name="github" id="" value="<?php echo $studentPerfil->github; ?>">
                                                </p>

                                                <p>
                                                    <label class="normal-14-medium-p nameGeral" for="">Facebook</label><br>
                                                    <input class="input-Geral" type="text" name="facebook" id="" value="<?php echo $studentPerfil->facebook; ?>">
                                                </p>

                                                <p>
                                                    <label class="normal-14-medium-p nameGeral" for="">Instagram</label><br>
                                                    <input class="input-Geral" type="text" name="instagram" id="" value="<?php echo $studentPerfil->instagram; ?>">
                                                </p>


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
                                                                <input class="input-Geral" type="password" name="oldPassword" id="" placeholder="Digite a sua senha antiga">
                                                            </p>

                                                            <p>
                                                                <label class="normal-14-medium-p nameGeral" for="">Senha atual</label><br>
                                                                <input class="input-Geral" type="password" name="newPassword" id="" placeholder="Digite a sua nova senha">
                                                            </p>

                                                            <p>
                                                                <label class="normal-14-medium-p nameGeral" for="">Confirme a sua senha atual</label><br>
                                                                <input class="input-Geral" type="password" name="passwordConfirm" id="" placeholder="Confirme a sua senha">
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="container posicao-Botao">
                                    <input class="botao-cancelar normal-14-medium-p" type="button" value="Cancelar" onclick="history.go(-1)">
                                    <input class="botao-Atualizar normal-14-medium-p" type="submit" name="update" value="Atualizar perfil">
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
</body>

</html>