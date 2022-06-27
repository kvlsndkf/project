<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-administrator.controller.php');
require_once('/xampp/htdocs' . '/project/classes/users/StudentController.class.php');


try {
    $search = $_GET['searchProfile'] ?? '';

    $student = new StudentController();

    $listActiveStudents = $student->ListActiveStudents();
    $listBlockedStudents = $student->ListBlockedStudents();
    $listSearch = $student->listSearchProfiles($search);

    $countActiveStudents = $student->countActiveStudents();
    $countBlockedStudents = $student->countBlockedStudents();
    $countSearchList = $student->countSearchList();

    $listProfilesOfSearch = $student->listSearchBarProfiles();

    $optionOfSearchProfile = array();
    foreach ($listProfilesOfSearch as $row) {
        $optionOfSearchProfile[] = array(
            'label' => $row->name,
            'value' => $row->name
        );
    }
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
    <link rel="icon" href="../../../../views/images/favicon/favicon-32x32.png" type="image/icon type">
    <title>Perfis | Heelp!</title>

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- CSS MdBootstrap -->
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="../../../style/style.css">

    <!-- CSS Search Bar -->
    <link rel="stylesheet" href="../../../../style/search-bar.style.css">

    <!-- Estilos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="../../../../views/styles/colors.style.css">
    <link rel="stylesheet" href="../../../../views/styles/style.global.css">
    <link rel="stylesheet" href="../../../../views/styles/fonts.style.css">
    <link rel="stylesheet" href="../../../style/modal-delete-teacher.style.css">
    <link rel="stylesheet" href="../../../style/button-delete-course.style.css">
    <link rel="stylesheet" href="../register/registration panel/registration-panel-style.css">
    <link rel="stylesheet" href="../register/register.styles.css">
</head>

<body>

    <!-- Inicio Wrapper -->
    <div class="wrapper">

        <!-- NavBar Lateral - SideBar -->
        <nav class="sidebar">

            <!-- Logo Heelp! -->
            <a href="#" class="logo-heelp">
                <img src="../../../../views/images/logo/logo-help.svg" alt="" class="logo-heelp-img">
                <h4 class="logo-heelp-text normal-22-black-title-1">heelp!</h4>
            </a>

            <!-- Texto nº2 para Responsividade -->
            <div class="respo-cabe">
                <a href="../register/registration panel/registration-panel-page.php" class="seta-voltar-a seta-voltar-a-responsividade">
                    <img src="../../../../views/images/components/arrow-back.svg" class="seta-voltar-img">
                </a>
                <p class="add-info-text add-info-text-responsividade normal-22-black-title-1">Lista de usuários </p>
            </div>

            <!-- Menu Sanduíche da Responsividade -->
            <input type="checkbox" id="check">
            <label for="check" class="checkbtn">
                <i class="fas fa-bars"></i>
            </label>



            <!-- Conteúdo Navbar -->
            <ul class="sidebar-ul">

                <!-- Logo Heelp! do Responsivo -->
                <li class="sidebar-li sidebar-li-logo">
                    <a href="#" class="logo-heelp-responsividade">
                        <img src="../../../../views/images/logo/logo-help.svg" alt="" class="logo-heelp-img">
                        <h4 class="logo-heelp-text normal-22-black-title-1">heelp!</h4>
                    </a>
                </li>

                <!-- Opções da NavBar -->
                <li class="sidebar-li">
                    <a href="../register/registration panel/registration-panel-page.php" class="sidebar-button-a normal-14-bold-p">
                        <div class="sidebar-button">
                            <p class="sidebar-button-text">Adicionar Informações +</p>
                        </div>
                    </a>
                </li>

                <li class="sidebar-li">
                    <a href="../dashboard/dashboard.page.php" class="sidebar-a-items">
                        <img class="sidebar-img" src="../../../../views/images/components/dashboard-img.svg" alt="">
                        <p class="sidebar-option normal-18-bold-title-2">Dashboard</p>
                    </a>
                    <hr class="sidebar-linha">
                </li>

                <li class="sidebar-li">
                    <p class="sidebar-categoria normal-14-bold-p">Mensagens</p>
                    <a href="../denunciation/list-denunciation.page.php" class="sidebar-a">
                        <img class="sidebar-img" src="../../../../views/images/components/denuncia-img.svg" alt="">
                        <p class="sidebar-option normal-18-bold-title-2">Denuncias</p>
                    </a>
                </li>

                <li class="sidebar-li">
                    <a href="../message/list-message.page.php" class="sidebar-a-items">
                        <img class="sidebar-img" src="../../../../views/images/components/fale-conosco-img.svg" alt="">
                        <p class="sidebar-option sidebar-option normal-18-bold-title-2">Fale Conosco</p>
                    </a>
                </li>

                <li class="sidebar-li">
                    <p class="sidebar-categoria normal-14-bold-p">Contas</p>
                    <a href="./list-profiles.page.php" class="sidebar-a-items">
                        <img class="sidebar-img" src="../../../../views/images/components/listagem-current.svg" alt="">
                        <p class="sidebar-current-option normal-18-bold-title-2" style="margin: 0; font-weight: 400;">Listagem</p>
                    </a>
                    <hr class="sidebar-linha">
                </li>

                <li class="sidebar-li">
                    <a href="../../../logout/logout.controller.php" class="sidebar-a-items2">
                        <img class="sidebar-img" src="../../../../views/images/components/sair-img.svg" alt="">
                        <p class="sidebar-option normal-18-bold-title-2">Sair</p>
                    </a>
                </li>

            </ul>

        </nav>

        <!-- Corpo -->
        <div class="corpo">
            x'
            <div class="cabecalho">
                <a href="../register/registration panel/registration-panel-page.php" class="seta-voltar-a">
                    <img src="../../../../views/images/components/arrow-back.svg" class="seta-voltar-img">
                </a>
                <p class="add-info-text normal-22-black-title-1">Lista de usuários</p>
            </div>

            <!-- Parte Branca -->
            <div class="conteudo">

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

                <!-- Barra de pesquisa ⬇️ -->
                <form action="./list-profiles.page.php" method="GET">
                    <input type="text" name="searchProfile" id="searchProfile" placeholder="Pesquise por perfis" autocomplete="off" class="search-bar margin-top-0">
                    <input type="submit" value="🔎" class="search-button margin-top-0">
                </form>

                <?php
                if (empty($search)) {
                    $displaySearch = 'd-none';
                    $displayList = '';
                } else {
                    $displaySearch = '';
                    $displayList = 'd-none';
                }
                ?>

                <div class="<?php echo $displaySearch; ?>">

                    <!-- Contador da pesquisa -->
                    <p class="contador-prof normal-18-black-title-2">
                        <?php echo  $countSearchList ?>
                    </p>

                    <!-- Lista da pesquisa -->
                    <?php for ($i = 0; $i < count($listSearch); $i++) {
                        $row = $listSearch[$i] ?>

                        <?php $styleActive = $row->isBlocked == false ? 'badge rounded-pill bg-success' : 'd-none'; ?>
                        <span class="<?php echo $styleActive; ?>">Ativo</span>

                        <?php $styleTypeUser = $row->typeUser == 'student' ? 'badge rounded-pill bg-primary' : 'd-none'; ?>
                        <span class="<?php echo $styleActive; ?>">Aluno</span>

                        <?php $styleActive = $row->isBlocked != false ? 'badge rounded-pill bg-danger' : 'd-none'; ?>
                        <span class="<?php echo $styleActive; ?>">Bloqueado</span>

                        <?php $styleTypeUser = $row->typeUser == 'student' ? 'badge rounded-pill bg-primary' : 'd-none'; ?>
                        <span class="<?php echo $styleActive; ?>">Aluno</span>

                        <div>
                            <img src="<?php echo $row->photo; ?>" alt="<?php echo $row->firstName; ?>" width="100">
                            <div>
                                <?php echo $row->firstName; ?>
                                <?php echo $row->surname; ?>
                            </div>

                            <div>
                                <?php echo $row->module; ?> •
                                <?php echo $row->course; ?> •
                                <?php echo $row->school; ?>
                            </div>
                        </div>

                        <?php
                        if (empty($row->blocked)) {
                            $displayBlocked = 'd-none';
                            $displayCreated = '';
                        } else {
                            $displayBlocked = '';
                            $displayCreated = 'd-none';
                        }
                        ?>

                        <div class="<?php echo $displayCreated; ?>">
                            <div>
                                <label for="">Entrou em</label>
                                <span data-date-value="<?php echo $row->created; ?>"><?php echo $row->created; ?></span>
                            </div>

                            <div>
                                <a href="../denunciation/detail-profile-student/detail-profile-student.page.php?idStudent=<?php echo $row->studentID; ?>" target="__blank">Ver perfil</a>
                            </div>

                            <button data-bs-toggle="modal" data-bs-target="#modal-<?php echo $row->userID; ?>">Bloquear usuário</button>

                            <!-- Modal -->
                            <div class="modal fade" id="modal-<?php echo $row->userID; ?>" tabindex="-1" aria-labelledby="exampleModalLabel-<?php echo $row->userID; ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel-<?php echo $row->userID; ?>">Bloquear usuário</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="./controller/block-student.controller.php?userID=<?php echo $row->userID; ?>" method="post">
                                                <div>
                                                    <p>
                                                        Motivo
                                                    </p>

                                                    <div id="contentTextArea">
                                                        <textarea name="reason" id="about" cols="30" rows="10" placeholder="Faça uma breve descrição sobre o bloqueio" required onclick="colorDiv()"></textarea>
                                                        <div><span id="counterTextArea">250</span></div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" name="block" class="btn btn-primary">Bloquear usuário</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="<?php echo $displayBlocked; ?>">
                            <div>
                                <label for="">Entrou em</label>
                                <span data-date-value="<?php echo $row->created; ?>"><?php echo $row->created; ?></span>
                            </div>

                            <div>
                                <label for="">Bloqueado em</label>
                                <span data-date-value=" <?php echo $row->blocked; ?>"> <?php echo $row->blocked; ?></span>
                            </div>

                            <div>
                                <a href="../denunciation/detail-profile-student/detail-profile-student.page.php?idStudent=<?php echo $row->studentID; ?>" target="__blank">Ver perfil</a>
                            </div>

                            <div>
                                Motivo
                                <?php echo $row->reason; ?>
                            </div>

                            <button data-bs-toggle="modal" data-bs-target="#modal-<?php echo $row->studentID; ?>">Desbloquear usuário</button>

                            <!-- Modal -->
                            <div class="modal fade" id="modal-<?php echo $row->studentID; ?>" tabindex="-1" aria-labelledby="exampleModalLabel-<?php echo $row->studentID; ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel-<?php echo $row->studentID; ?>">Desbloquear usuário</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Tem certeza de que deseja desbloquear este usuário?
                                            <form action="./controller/unlock-student.controller.php?userID=<?php echo $row->userID; ?>" method="post">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" name="unlock" class="btn btn-primary">Sim, quero</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                    <?php } ?>

                </div>

                <div class="<?php echo $displayList; ?>">
                    <!-- Tabs navs -->
                    <ul class="nav nav-tabs mb-3 tab-ul" id="ex1" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active tab-a" id="ex1-tab-1" data-mdb-toggle="tab" href="#ex1-tabs-1" role="tab" aria-controls="ex1-tabs-1" aria-selected="true">
                                <p class="normal-14-bold-p tab-p">
                                    Ativos
                                </p>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link tab-a" id="ex1-tab-2" data-mdb-toggle="tab" href="#ex1-tabs-2" role="tab" aria-controls="ex1-tabs-2" aria-selected="false">
                                <p class="normal-14-bold-p tab-p">
                                    Bloqueados
                                </p>
                            </a>
                        </li>
                    </ul>

                    <!-- Tabs navs -->

                    <!-- Tabs content -->
                    <div class="tab-content" id="ex1-content">
                        <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                            <div id="message-new-list">

                                <!-- Contador de usuários ativos -->
                                <p class="contador-prof normal-18-black-title-2">
                                    <?php echo  $countActiveStudents ?>
                                </p>

                                <br>

                                <!-- Usuários ativos -->
                                <div class="list-prof">

                                    <?php for ($i = 0; $i < count($listActiveStudents); $i++) {
                                        $row = $listActiveStudents[$i] ?>

                                        <div class="card-contact">

                                            <?php $styleActive = $row->isBlocked == false ? 'badge rounded-pill bg-green' : 'd-none'; ?>
                                            <span class="<?php echo $styleActive; ?> bg-green" style="margin-right: 10px">Ativo</span>

                                            <?php $styleTypeUser = $row->typeUser == 'student' ? 'badge rounded-pill bg-help-primary' : 'd-none'; ?>
                                            <span class="<?php echo $styleActive; ?> bg-help-primary">Aluno</span>

                                            <div class="user-data" style="margin-top: 20px">
                                                <img src="<?php echo $row->photo; ?>" alt="<?php echo $row->firstName; ?>" style="height: 56px; width: 56px; object-fit: cover; border-radius: 56px; margin-right: 10px;">
                                                <div class="user-data-text">
                                                    <p class="prof-text line-clamp-2 message-text school-name normal-14-bold-p">
                                                        <?php echo $row->firstName; ?>
                                                        <?php echo $row->surname; ?>
                                                    </p>

                                                    <p class="contato-message normal-14-medium-p line-clamp-2" style="margin-top: 0; max-width: 100%; word-wrap: break-word; word-break: break-all;">
                                                        <?php echo $row->module; ?> •
                                                        <?php echo $row->course; ?> •
                                                        <?php echo $row->school; ?>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="prof-text" style="margin-top: 10px; max-width: 100%">
                                            <img src="../../../../views/images/components/date-range.svg" alt="">
                                                <label for="">Entrou em</label>
                                                <span data-date-value="<?php echo $row->created; ?>"><?php echo $row->created; ?></span>
                                            </div>

                                            <div>
                                                <a href="../denunciation/detail-profile-student/detail-profile-student.page.php?idStudent=<?php echo $row->studentID; ?>" target="__blank" style="color: var(--blue-sky);">Ver perfil</a>
                                            </div>

                                            <button data-bs-toggle="modal" data-bs-target="#modal-tab-<?php echo $row->userID; ?>">Bloquear usuário</button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="modal-tab-<?php echo $row->userID; ?>" tabindex="-1" aria-labelledby="exampleModalLabel-<?php echo $row->userID; ?>" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel-<?php echo $row->userID; ?>">Bloquear usuário</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="./controller/block-student.controller.php?userID=<?php echo $row->userID; ?>" method="post">
                                                                <div>
                                                                    <p>
                                                                        Motivo
                                                                    </p>

                                                                    <div id="contentTextArea">
                                                                        <textarea name="reason" id="about" cols="30" rows="10" placeholder="Faça uma breve descrição sobre o bloqueio" required onclick="colorDiv()"></textarea>
                                                                        <div><span id="counterTextArea">250</span></div>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                    <button type="submit" name="block" class="btn btn-primary">Bloquear usuário</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    <?php } ?>
                                </div>

                            </div>
                        </div>

                        <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                            <div id="message-read-list">

                                <!-- Contador de usuários bloqueados -->
                                <p class="contador-prof normal-18-black-title-2">
                                    <?php echo  $countBlockedStudents ?>
                                </p>

                                <!-- Usuários bloqueados -->
                                <?php for ($i = 0; $i < count($listBlockedStudents); $i++) {
                                    $row = $listBlockedStudents[$i] ?>

                                    <?php $styleActive = $row->isBlocked != false ? 'badge rounded-pill bg-red' : 'd-none'; ?>
                                    <span class="<?php echo $styleActive; ?> bg-red" style="margin-right: 10px">Bloqueado</span>

                                    <?php $styleTypeUser = $row->typeUser == 'student' ? 'badge rounded-pill bg-help-primary' : 'd-none'; ?>
                                    <span class="<?php echo $styleActive; ?> bg-help-primary">Aluno</span>

                                    <div>
                                        <img src="<?php echo $row->photo; ?>" alt="<?php echo $row->firstName; ?>" width="100">
                                        <div>
                                            <?php echo $row->firstName; ?>
                                            <?php echo $row->surname; ?>
                                        </div>

                                        <div>
                                            <?php echo $row->module; ?> •
                                            <?php echo $row->course; ?> •
                                            <?php echo $row->school; ?>
                                        </div>
                                    </div>

                                    <div>
                                        <label for="">Entrou em</label>
                                        <span data-date-value="<?php echo $row->created; ?>"><?php echo $row->created; ?></span>
                                    </div>

                                    <div>
                                        <label for="">Bloqueado em</label>
                                        <span data-date-value=" <?php echo $row->blocked; ?>"> <?php echo $row->blocked; ?></span>
                                    </div>

                                    <div>
                                        <a href="../denunciation/detail-profile-student/detail-profile-student.page.php?idStudent=<?php echo $row->studentID; ?>" target="__blank">Ver perfil</a>
                                    </div>

                                    <div>
                                        Motivo
                                        <?php echo $row->reason; ?>
                                    </div>

                                    <button data-bs-toggle="modal" data-bs-target="#modal-tab-<?php echo $row->userID; ?>">Desbloquear usuário</button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modal-tab-<?php echo $row->userID; ?>" tabindex="-1" aria-labelledby="exampleModalLabel-<?php echo $row->userID; ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel-<?php echo $row->userID; ?>">Desbloquear usuário</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Tem certeza de que deseja desbloquear este usuário?
                                                    <form action="./controller/unlock-student.controller.php?userID=<?php echo $row->userID; ?>" method="post">
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            <button type="submit" name="unlock" class="btn btn-primary">Sim, quero</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                    <!-- Tabs content -->
                </div>

            </div>
        </div>
    </div>

    <!-- JS Bootstrap ⬇️ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.js"></script>

    <!-- JS Count Characters TextArea -->
    <script type="text/javascript" src="../js/textarea.js"></script>

    <!-- JS Search bar -->
    <script src="../js/autocomplete.js"></script>

    <!-- JS Search bar ⬇️ -->
    <script>
        const field = document.getElementById('searchProfile');
        const acc = new Autocomplete(field, {
            data: <?php echo json_encode($optionOfSearchProfile); ?>,
            maximumItems: 8,
            treshold: 1,
        });
    </script>

    <script>
        (function() {
            const span = document.querySelectorAll('[data-date-value]');

            console.log(span);

            span.forEach(dateElement => {
                console.log(dateElement);
                const date = new Date(dateElement.innerText);
                if (date.toDateString() === "Invalid Date") {
                    return;
                }
                const formated = new Intl.DateTimeFormat('pt-br', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                }).format(date);

                dateElement.innerText = formated;
            });
        }());
    </script>
</body>

</html>