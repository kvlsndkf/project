<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-administrator.controller.php');
require_once('/xampp/htdocs' . '/project/classes/denunciations/Denunciation.class.php');
require_once('/xampp/htdocs' . '/project/classes/users/StudentMethods.class.php');

try {
    $search = $_GET['searchDenunciation'] ?? '';
    $denunciation = new Denunciation();

    $listNewDenunciations = $denunciation->listNewDenunciations();
    $listAnalysisDenunciations = $denunciation->listAnalysisDenunciations();
    $listResolvedDenunciations = $denunciation->listResolvedDenunciations();

    $countNewDenunciations = $denunciation->countNewDenunciations();
    $countAnalysisDenunciations = $denunciation->countAnalysisDenunciations();
    $countResolvedDenunciations = $denunciation->countResolvedDenunciations();

    $listSearch = $denunciation->listSearchDenunciations($search);
    $countSearchDenunciations = $denunciation->countSearchDenunciations();

    $student = new StudentMethods();
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
    <title>Denúncias | Heelp!</title>

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
    <!-- Estilos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="../../../../views/styles/colors.style.css">
    <link rel="stylesheet" href="../../../../views/styles/style.global.css">
    <link rel="stylesheet" href="../../../../views/styles/fonts.style.css">
    <link rel="stylesheet" href="../../../../views/styles/button.style.css">
    <link rel="stylesheet" href="../../../../views/styles/font-format.style.css">
    <link rel="stylesheet" href="../register/registration panel/registration-panel-style.css">
    <link rel="stylesheet" href="../register/register.styles.css">
    <link rel="stylesheet" href="../../../style/modal-delete-teacher.style.css">
    <link rel="stylesheet" href="../../../style/button-delete-course.style.css">

    <link rel="stylesheet" href="../../../style/list-denunciation.styles.css">

    <link rel="stylesheet" href="../../../../views/landing-page/fale-conosco.css">

    <link rel="shortcut icon" href="../../../../views/images/favicon/favicon-16x16.png" type="image/x-icon">

    <link rel="stylesheet" href="../../../student/styles/list-denunciation.styles.css">

</head>

<body>

    <?php
    if (empty($search)) {
        $styleSearch = 'd-none';
        $styleList = '';
    } else {
        $styleSearch = '';
        $styleList = 'd-none';
    }
    ?>

    </div>
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
                <p class="add-info-text add-info-text-responsividade normal-22-black-title-1">Denúncias </p>
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
                    <a onclick="window.history.go(-1)" class="sidebar-button-a normal-14-bold-p">
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
                    <a href="../denunciation/list-denunciation.page.php" class="sidebar-a-items">
                        <img class="sidebar-img" src="../../images/components/icon-denunciation.svg" alt="">
                        <p class="sidebar-option sidebar-current-option normal-18-bold-title-2">Denúncias</p>
                    </a>
                </li>

                <li class="sidebar-li">
                    <a href="../message/list-message.page.php" class="sidebar-a-items">
                        <img class="sidebar-img" src="../../../../views/images/components/fale-conosco-img.svg" alt="">
                        <p class="sidebar-option normal-18-bold-title-2">Fale Conosco</p>
                    </a>
                </li>

                <li class="sidebar-li">
                    <p class="sidebar-categoria normal-14-bold-p">Contas</p>
                    <a href="#" class="sidebar-a">
                        <img class="sidebar-img" src="../../../../views/images/components/listagem-img.svg" alt="">
                        <p class="sidebar-option normal-18-bold-title-2">Listagem</p>
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
            <div class="cabecalho">
                <a href="../register/registration panel/registration-panel-page.php" class="seta-voltar-a">
                    <img src="../../../../views/images/components/arrow-back.svg" class="seta-voltar-img">
                </a>
                <p class="add-info-text normal-22-black-title-1">Denúncias</p>
            </div>
            <!-- Parte Branca -->
            <div class="conteudo">


                <?php
                if (empty($search)) {
                    $styleSearch = 'd-none';
                    $styleList = '';
                } else {
                    $styleSearch = '';
                    $styleList = 'd-none';
                }
                ?>

                <!-- Mensagem de sucesso ⬇️ -->

                <div>
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
                </div>
                <!-- Mensagem de erro ⬇️ -->
                <div>
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
                </div>



                <!-- Barra de pesquisa ⬇️ -->
                <form action="./list-denunciation.page.php" method="GET" class="">
                    <input type="text" name="searchDenunciation" id="searchMessage" placeholder="Pesquise por denúncias" autocomplete="off" class="search-bar margin-top-0">
                    <input type="submit" value="🔎" class="search-button margin-top-0">
                </form>

                <div class="<?php echo $styleSearch; ?>">


                    <!-- Contador de pesquisas -->
                    <p class="contador-prof normal-18-black-title-2" style="margin-bottom: 40px;">
                        <?php echo  $countSearchDenunciations; ?>
                    </p>
                    <div class="list-prof">
                        <!-- Lista de pesquisa -->
                        <?php for ($i = 0; $i < count($listSearch); $i++) {
                            $row = $listSearch[$i] ?>
                            <div class="card-contact responsive-spacing">
                                <div class="badges-container">
                                    <?php $styleNew = $row->status == "Nova" ? 'badge rounded-pill bg-warning text-dark' : 'd-none'; ?>
                                    <span class="<?php echo $styleNew; ?>"><?php echo $row->status; ?></span>

                                    <?php $styleNew = $row->status == "Em análise" ? 'badge rounded-pill bg-blue white-title' : 'd-none'; ?>
                                    <span class="<?php echo $styleNew; ?>"><?php echo $row->status; ?></span>

                                    <?php $styleNew = $row->status == "Resolvida" ? 'badge rounded-pill bg-green white-title' : 'd-none'; ?>
                                    <span class="<?php echo $styleNew; ?>"><?php echo $row->status; ?></span>

                                    <?php $styleAnswer = $row->type == "Resposta" ? 'badge rounded-pill white-title bg-primary-button' : 'd-none'; ?>
                                    <span class="<?php echo $styleAnswer; ?>"><?php echo $row->type; ?></span>

                                    <?php $styleAnswer = $row->type == "Pergunta" ? 'badge rounded-pill bg-primary-button white-title' : 'd-none'; ?>
                                    <span class="<?php echo $styleAnswer; ?>"><?php echo $row->type; ?></span>

                                    <?php $styleAnswer = $row->type == "Perfil" ? 'badge rounded-pill bg-primary-button white-title' : 'd-none'; ?>
                                    <span class="<?php echo $styleAnswer; ?>"><?php echo $row->type; ?></span>

                                    <?php $styleContext = $row->context == "Denuncia acatada" ? 'badge rounded-pill bg-blue-sky white-title' : 'd-none'; ?>
                                    <span class="<?php echo $styleContext; ?>"><?php echo $row->context; ?></span>

                                    <?php $styleContext = $row->context == "Denuncia negada" ? 'badge rounded-pill bg-red white-title' : 'd-none'; ?>
                                    <span class="<?php echo $styleContext; ?>"><?php echo $row->context; ?></span>
                                </div>
                                <div class="info-spacing">
                                    <p class="my-p normal-14-medium-p bg-modal-text">
                                        Feito por
                                    </p>
                                    <p class="proof-text school-name normal-14-bold-p text-truncate">
                                        <?php echo $row->creator; ?>
                                        <?php echo $row->surnameCreator; ?>
                                    </p>
                                </div>
                                <div class="info-spacing">
                                    <p class="my-p normal-14-medium-p bg-modal-text">
                                        Denunciado
                                    </p>
                                    <p class="proof-text school-name normal-14-bold-p text-truncate">
                                        <?php echo $row->denounced; ?>
                                        <?php echo $row->surnameDenounced; ?>
                                    </p>
                                </div>
                                <p class="my-p normal-14-medium-p bg-modal-text">
                                    Motivo
                                </p>
                                <p class="my-p-bold normal-14-bold-p bg-list-text">
                                    <?php echo $row->reason; ?>
                                </p>

                                <p class="my-p-link normal-14-medium-p">
                                    <?php
                                    $idStudent = $student->getStudentByUserID($row->denouncedId);
                                    if ($row->type == "Perfil") {
                                        $textButton = 'Link do perfil';
                                        $link = "./detail-profile-student/detail-profile-student.page.php?idStudent=" . $idStudent[0]['id'];
                                    } else {
                                        $textButton = 'Link do post';
                                        $link = "./detail-question/detail-question.page.php?idQuestion=" . $row->questionId . "&idStudent=" . $row->denouncedId;
                                    }
                                    ?>
                                    <a class="blue-title" href="<?php echo $link; ?>" target="__blank"><?php echo $textButton; ?></a>
                                </p>

                                <?php
                                if ($row->status == "Resolvida") {
                                    $styleAll = 'd-none';
                                    $styleAnalysisSearch = 'd-none';
                                    $styleNewSearch = 'd-none';
                                } else if ($row->status == "Nova") {
                                    $styleAll = '';
                                    $styleAnalysisSearch = 'd-none';
                                    $styleNewSearch = '';
                                } else {
                                    $styleAll = '';
                                    $styleAnalysisSearch = '';
                                    $styleNewSearch = 'd-none';
                                }
                                ?>

                                <div class="<?php echo $styleAll; ?>">

                                    <div class="<?php echo $styleNewSearch; ?>">
                                        <form action="./controller/analysis-denunciation.controller.php?denunciationID=<?php echo $row->id; ?>" method="POST">
                                            <label for="moveDenunciation" class="button-100 bg-primary-button align-center normal-14-bold-p white-title cursor-pointer scale-hover">Mover para análise</label>
                                            <button type="submit" name="moveDenunciation" id="moveDenunciation" class="d-none">Mover para análise</button>
                                        </form>
                                    </div>

                                    <div class="<?php echo $styleAnalysisSearch; ?>">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $row->id; ?>">
                                            Marcar como resolvida
                                        </button>
                                        <label class="button-100 bg-primary-button align-center normal-14-bold-p white-title cursor-pointer scale-hover" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $row->id; ?>">Marcar como resolvida</label>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-<?php echo $row->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel-<?php echo $row->id; ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content corM">
                                                    <div class="contianer containerM">
                                                        <div class="modal-header border-bottom-0">
                                                            <h5 class="modal-titleM normal-20-bold-modaltitle" id="exampleModalLabel-<?php echo $row->id; ?>">Denúncia resolvida</h5>
                                                            <button id="botao" class="setaM"><img type="button" data-bs-dismiss="modal" aria-label="Close" src="../../../../views/images/components/x-button.svg" class="close fechar"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="./controller/resolve-denunciation.controller.php?denunciationID=<?php echo $row->id; ?>" method="POST">
                                                                <label class="subtituloM normal-14-bold-p sub-titulo-plusM">Contexto</label>
                                                                <select class="form-select select-modal normal-14-bold-p" aria-label="Default select example" id="selectContext" name="context">
                                                                    <option selected class="normal-14-bold-p">Selecione o contexto em que a denúncia se enquadra</option>
                                                                </select>

                                                                <br>

                                                                <div class="mb-3">
                                                                    <p class="subtituloM normal-14-bold-p sub-titulo-plusM">
                                                                        Conclusão
                                                                    </p>

                                                                    <div id="contentTextArea">
                                                                        <textarea name="conclusion" class="text-area normal-14-medium-p" id="about" cols="30" rows="10" placeholder="Faça uma breve conclusão sobre a denúncia" required onclick="colorDiv()" maxlength="240"></textarea>
                                                                        <div class="counter-container"><span class="counterTextArea whitney-8-medium-littletiny" id="counterTextArea">250</span></div>
                                                                    </div>
                                                                    <span id="min-length"></span>
                                                                </div>
                                                                <div class="modal-footer" style="border: none; padding:0;">
                                                                    <button type="reset" class="btn btn-secondary d-none" data-bs-dismiss="modal">Cancelar</button>
                                                                    <button type="submit" class="btn btn-primary d-none" id="resolveDenunciation" name="resolveDenunciation">Mover</button>
                                                                    <label for="resolveDenunciation" class="button-wide bg-primary-button text-center normal-14-bold-p white-title cursor-pointer">Mover</label>
                                                                    <label data-bs-dismiss="modal" class="button-wide bg-white text-center normal-14-bold-p primary-title cursor-pointer">Cancelar</label>

                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="<?php echo $styleList; ?>">
                    <!-- Tabs navs -->
                    <ul class="nav nav-tabs mb-3 tab-ul" id="ex1" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active tab-a" id="ex1-tab-1" data-mdb-toggle="tab" href="#ex1-tabs-1" role="tab" aria-controls="ex1-tabs-1" aria-selected="true">
                                <p class="normal-14-bold-p tab-p">Novas</p>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link tab-a" id="ex1-tab-2" data-mdb-toggle="tab" href="#ex1-tabs-2" role="tab" aria-controls="ex1-tabs-2" aria-selected="false">
                                <p class="normal-14-bold-p tab-p">Em análise</p>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link tab-a" id="ex1-tab-3" data-mdb-toggle="tab" href="#ex1-tabs-3" role="tab" aria-controls="ex1-tabs-3" aria-selected="false">
                                <p class="normal-14-bold-p tab-p">Resolvidas</p>
                            </a>
                        </li>
                    </ul>

                    <!-- Tabs navs -->

                    <!-- Tabs content -->
                    <div class="tab-content" id="ex1-content">
                        <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                            <div id="message-new-list">

                                <!-- Contador de denuncias novas -->
                                <p class="contador-prof normal-18-black-title-2" style="margin-bottom: 40px; margin-top: 28px;">
                                    <?php echo  $countNewDenunciations ?>
                                </p>
                                <div class="list-prof">

                                    <!-- Denuncias novas -->
                                    <?php for ($i = 0; $i < count($listNewDenunciations); $i++) {
                                        $row = $listNewDenunciations[$i] ?>
                                        <div class="card-contact responsive-spacing">
                                            <div class="badges-container">
                                                <?php $styleNew = $row->status == "Nova" ? 'badge rounded-pill bg-warning text-dark badge-space' : 'd-none'; ?>
                                                <span class="<?php echo $styleNew; ?>"><?php echo $row->status; ?></span>

                                                <?php $styleAnswer = $row->type == "Resposta" ? 'badge rounded-pill bg-primary-button white-title' : 'd-none'; ?>
                                                <span class="<?php echo $styleAnswer; ?>"><?php echo $row->type; ?></span>

                                                <?php $styleAnswer = $row->type == "Pergunta" ? 'badge rounded-pill bg-primary-button white-title' : 'd-none'; ?>
                                                <span class="<?php echo $styleAnswer; ?>"><?php echo $row->type; ?></span>

                                                <?php $styleAnswer = $row->type == "Perfil" ? 'badge rounded-pill bg-primary-button white-title' : 'd-none'; ?>
                                                <span class="<?php echo $styleAnswer; ?>"><?php echo $row->type; ?></span>
                                            </div>
                                            <div class="info-spacing">
                                            <p class="my-p normal-14-medium-p bg-modal-text">
                                                Feito por
                                            </p>
                                            <p class="proof-text school-name normal-14-bold-p text-truncate">
                                                <?php echo $row->creator; ?>
                                                <?php echo $row->surnameCreator; ?>
                                            </p>
                                            </div>
                                            <div class="info-spacing">
                                            <p class="my-p normal-14-medium-p bg-modal-text">
                                                Denunciado
                                            </p>
                                            <p class="proof-text school-name normal-14-bold-p text-truncate">
                                                <?php echo $row->denounced; ?>
                                                <?php echo $row->surnameDenounced; ?>
                                            </p>
                                            </div>
                                            <p class="my-p normal-14-medium-p bg-modal-text">
                                                Motivo
                                            </p>
                                            <p class="my-p-bold normal-14-bold-p bg-list-text">
                                                <?php echo $row->reason; ?>
                                            </p>

                                            <p class="my-p-link normal-14-medium-p">
                                                <?php
                                                $idStudent = $student->getStudentByUserID($row->denouncedId);
                                                if ($row->type == "Perfil") {
                                                    $textButton = 'Link do perfil';
                                                    $link = "./detail-profile-student/detail-profile-student.page.php?idStudent=" . $idStudent[0]['id'];
                                                } else {
                                                    $textButton = 'Link do post';
                                                    $link = "./detail-question/detail-question.page.php?idQuestion=" . $row->questionId . "&idStudent=" . $row->denouncedId;
                                                }
                                                ?>
                                                <a class="blue-title" href="<?php echo $link; ?>" target="__blank"><?php echo $textButton; ?></a>
                                            </p>

                                            <form action="./controller/analysis-denunciation.controller.php?denunciationID=<?php echo $row->id; ?>" method="POST">
                                                <button type="submit" name="moveDenunciation" id="moveDenunciationn" class="d-none">Mover para análise</button>
                                                <label for="moveDenunciationn" class="button-100 bg-primary-button align-center normal-14-bold-p white-title cursor-pointer scale-hover">Mover para análise</label>
                                            </form>
                                        </div>

                                    <?php } ?>

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                            <div id="message-read-list">

                                <!-- Contador de denuncias em análise -->
                                <p class="contador-prof normal-18-black-title-2" style="margin-bottom: 40px; margin-top: 28px;">
                                    <?php echo  $countAnalysisDenunciations ?>
                                </p>
                                <div class="list-prof">
                                    <!-- Denuncias em análise -->
                                    <?php for ($i = 0; $i < count($listAnalysisDenunciations); $i++) {
                                        $row = $listAnalysisDenunciations[$i] ?>
                                        <div class="card-contact responsive-spacing">
                                            <div class="badges-container">
                                                <?php $styleNew = $row->status == "Em análise" ? 'badge rounded-pill bg-blue white-title badge-space' : 'd-none'; ?>
                                                <span class="<?php echo $styleNew; ?>"><?php echo $row->status; ?></span>

                                                <?php $styleAnswer = $row->type == "Resposta" ? 'badge rounded-pill bg-primary-button white-title' : 'd-none'; ?>
                                                <span class="<?php echo $styleAnswer; ?>"><?php echo $row->type; ?></span>

                                                <?php $styleAnswer = $row->type == "Pergunta" ? 'badge rounded-pill bg-primary-button white-title' : 'd-none'; ?>
                                                <span class="<?php echo $styleAnswer; ?>"><?php echo $row->type; ?></span>

                                                <?php $styleAnswer = $row->type == "Perfil" ? 'badge rounded-pill bg-primary-button white-title' : 'd-none'; ?>
                                                <span class="<?php echo $styleAnswer; ?>"><?php echo $row->type; ?></span>
                                            </div>
                                            <div class="info-spacing">
                                            <p class="my-p normal-14-medium-p bg-modal-text">
                                                Feito por
                                            </p>
                                            <p class="proof-text school-name normal-14-bold-p text-truncate">
                                                <?php echo $row->creator; ?>
                                                <?php echo $row->surnameCreator; ?>
                                            </p>
                                            </div>
                                            <div class="info-spacing">
                                            <p class="my-p normal-14-medium-p bg-modal-text">
                                                Denunciado
                                            </p>
                                            <p class="proof-text school-name normal-14-bold-p text-truncate">
                                                <?php echo $row->denounced; ?>
                                                <?php echo $row->surnameDenounced; ?>
                                            </p>
                                            </div>

                                            <p class="my-p normal-14-medium-p bg-modal-text">
                                                Motivo
                                            </p>
                                            <p class="my-p-bold normal-14-bold-p bg-list-text">
                                                <?php echo $row->reason; ?>
                                            </p>

                                            <p class="my-p-link normal-14-medium-p">
                                                <?php
                                                $idStudent = $student->getStudentByUserID($row->denouncedId);
                                                if ($row->type == "Perfil") {
                                                    $textButton = 'Link do perfil';
                                                    $link = "./detail-profile-student/detail-profile-student.page.php?idStudent=" . $idStudent[0]['id'];
                                                } else {
                                                    $textButton = 'Link do post';
                                                    $link = "./detail-question/detail-question.page.php?idQuestion=" . $row->questionId . "&idStudent=" . $row->denouncedId;
                                                }
                                                ?>
                                                <a class="blue-title" href="<?php echo $link; ?>" target="__blank"><?php echo $textButton; ?></a>
                                            </p>

                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $row->denouncedId; ?>">
                                                Marcar como resolvida
                                            </button>
                                            <label class="button-100 bg-primary-button align-center normal-14-bold-p white-title cursor-pointer scale-hover" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $row->denouncedId; ?>">Marcar como resolvida</label>

                                            <!-- Modal -->
                                            <div class="modal fade" id="modal-<?php echo $row->denouncedId; ?>" tabindex="-1" aria-labelledby="exampleModalLabel-<?php echo $row->denouncedId; ?>" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content corM">
                                                        <div class="contianer containerM">
                                                            <div class="modal-header border-bottom-0">
                                                                <h5 class="modal-titleM normal-20-bold-modaltitle" id="exampleModalLabel-<?php echo $row->denouncedId; ?>">Denúncia resolvida</h5>
                                                                <button id="botao" class="setaM"><img type="button" data-bs-dismiss="modal" aria-label="Close" src="../../../../views/images/components/x-button.svg" class="close fechar"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="./controller/resolve-denunciation.controller.php?denunciationID=<?php echo $row->id; ?>" method="POST">
                                                                    <label class="subtituloM normal-14-bold-p sub-titulo-plusM">Contexto</label>
                                                                    <select class="form-select select-modal normal-14-bold-p" aria-label="Default select example" id="selectContext" name="context">
                                                                        <option selected class="normal-14-bold-p">Selecione o contexto em que a denúncia se enquadra</option>
                                                                    </select>

                                                                    <br>
                                                                    <hr>
                                                                    <div class="mb-3">
                                                                        <p class="subtituloM normal-14-bold-p sub-titulo-plusM">
                                                                            Conclusão
                                                                        </p>

                                                                        <div id="contentTextArea">
                                                                            <textarea name="conclusion" class="text-area normal-14-medium-p" id="about" cols="30" rows="10" placeholder="Faça uma breve conclusão sobre a denúncia" required onclick="colorDiv()" maxlength="240"></textarea>
                                                                            <div class="counter-container"><span class="counterTextArea whitney-8-medium-littletiny" id="counterTextArea">250</span></div>
                                                                        </div>
                                                                        <span id="min-length"></span>
                                                                    </div>
                                                                    <div class="modal-footer" style="border: none; padding:0;">
                                                                        <button type="reset" class="btn btn-secondary d-none" data-bs-dismiss="modal">Cancelar</button>
                                                                        <button type="submit" class="btn btn-primary d-none" id="resolveDenunciation" name="resolveDenunciation">Mover</button>
                                                                        <label for="resolveDenunciation" class="button-wide bg-primary-button text-center normal-14-bold-p white-title cursor-pointer">Mover</label>
                                                                        <label data-bs-dismiss="modal" class="button-wide bg-white text-center normal-14-bold-p primary-title cursor-pointer">Cancelar</label>

                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="ex1-tabs-3" role="tabpanel" aria-labelledby="ex1-tab-3">
                            <div id="message-read-list">

                                <!-- Contador de denuncias resolvidas -->
                                <p class="contador-prof normal-18-black-title-2" style="margin-bottom: 40px; margin-top: 28px;">
                                    <?php echo  $countResolvedDenunciations ?>
                                </p>
                                <div class="list-prof">
                                    <!-- Denuncias resolvidas -->
                                    <?php for ($i = 0; $i < count($listResolvedDenunciations); $i++) {
                                        $row = $listResolvedDenunciations[$i] ?>
                                        <div class="card-contact responsive-spacing">
                                            <div class="badges-container">
                                                <?php $styleNew = $row->status == "Resolvida" ? 'badge rounded-pill bg-green white-title badge-space' : 'd-none'; ?>
                                                <span class="<?php echo $styleNew; ?>"><?php echo $row->status; ?></span>

                                                <?php $styleAnswer = $row->type == "Resposta" ? 'badge rounded-pill bg-primary-button white-title badge-space' : 'd-none'; ?>
                                                <span class="<?php echo $styleAnswer; ?>"><?php echo $row->type; ?></span>

                                                <?php $styleAnswer = $row->type == "Pergunta" ? 'badge rounded-pill bg-primary-button white-title badge-space' : 'd-none'; ?>
                                                <span class="<?php echo $styleAnswer; ?>"><?php echo $row->type; ?></span>

                                                <?php $styleAnswer = $row->type == "Perfil" ? 'badge rounded-pill bg-primary-button white-title badge-space' : 'd-none'; ?>
                                                <span class="<?php echo $styleAnswer; ?>"><?php echo $row->type; ?></span>

                                                <?php $styleContext = $row->context == "Denuncia acatada" ? 'badge rounded-pill bg-blue-sky white-title' : 'badge rounded-pill bg-red white-title'; ?>
                                                <span class="<?php echo $styleContext; ?>"><?php echo $row->context; ?></span>
                                            </div>

                                            <div class="info-spacing">
                                            <p class="my-p normal-14-medium-p bg-modal-text">
                                                Feito por
                                            </p>
                                            <p class="proof-text school-name normal-14-bold-p text-truncate">
                                                <?php echo $row->creator; ?>
                                                <?php echo $row->surnameCreator; ?>
                                            </p>
                                            </div>
                                            <div class="info-spacing">
                                            <p class="my-p normal-14-medium-p bg-modal-text">
                                                Denunciado
                                            </p>
                                            <p class="proof-text school-name normal-14-bold-p text-truncate">
                                                <?php echo $row->denounced; ?>
                                                <?php echo $row->surnameDenounced; ?>
                                            </p>
                                            </div>
                                            <p class="my-p normal-14-medium-p bg-modal-text">
                                                Motivo
                                            </p>
                                            <p class="my-p-bold normal-14-bold-p bg-list-text">
                                                <?php echo $row->reason; ?>
                                            </p>

                                            <p class="my-p-link normal-14-medium-p">
                                                <?php
                                                $idStudent = $student->getStudentByUserID($row->denouncedId);
                                                if ($row->type == "Perfil") {
                                                    $textButton = 'Link do perfil';
                                                    $link = "./detail-profile-student/detail-profile-student.page.php?idStudent=" . $idStudent[0]['id'];
                                                } else {
                                                    $textButton = 'Link do post';
                                                    $link = "./detail-question/detail-question.page.php?idQuestion=" . $row->questionId . "&idStudent=" . $row->denouncedId;
                                                }
                                                ?>
                                                <a class="blue-title" href="<?php echo $link; ?>" target="__blank"><?php echo $textButton; ?></a>
                                            </p>
<hr>
                                            <p class="my-p normal-14-medium-p bg-modal-text">
                                                Conclusão
                                            </p>
                                            <p class="my-p-bold normal-14-bold-p bg-list-text">
                                                <?php echo $row->conclusion; ?>
                                            </p>

                                        </div>
                                    <?php } ?>
                                </div>
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

    <!-- JS Select da Categoria ⬇️ -->
    <script>
        (async function() {
            const select = document.getElementById('selectContext');
            const dados = await fetch('./controller/getContexts.controller.php');

            const json_context = await dados.json();
            const convert_into_string = JSON.stringify(json_context);
            const object_context = JSON.parse(convert_into_string);

            array_contexts = object_context['contexts'];

            for (i = 0; i < array_contexts.length; i++) {
                const optionElement = document.createElement("option");

                optionElement.value = array_contexts[i]['id'];
                optionElement.textContent = array_contexts[i]['name'];

                select.appendChild(optionElement);
            }

            return;
        }());
    </script>

    <!-- JS tamanho minimo text area -->
    <script>
        var textArea = document.getElementById('about');
        var minLength = document.getElementById('min-length');

        function checkLength() {
            if (textArea.value.length < 100) {
                minLength.style.color = "#ED4245";
                minLength.innerText = "Mínimo de caracteres: 100";
            }
            if (textArea.value.length > 240) {
                minLength.style.color = "#ED4245";
                minLength.innerText = "Máximo de caracteres: 240";
            }
        }
    </script>

    <!-- JS tamanho máximo textarea  -->

    <script>
        $(document).ready(function() {
            $('#about').on('input propertychange', function() {
                charLimit(this, 240);
            });
        });

        function charLimit(input, maxChar) {
            var len = $(input).val().length;
            if (len > maxChar) {
                $(input).val($(input).val().substring(0, maxChar));
            }
        }
    </script>
</body>

</html>