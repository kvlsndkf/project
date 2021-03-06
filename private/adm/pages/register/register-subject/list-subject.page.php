<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-administrator.controller.php');
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Subject.class.php');

$connection = Connection::connection();

try {
    $search = $_GET['searchSubject'] ?? '';
    $subject = new Subject();

    $listSubjects = $subject->listSubject($search);
    $countSubjects = $subject->countSubjects($search);
    $listSubjectsOfSearch = $subject->listSubjectsOfSearchBar();

    $optionOfSearch = array();
    foreach ($listSubjectsOfSearch as $row) {
        $optionOfSearch[] = array(
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
    <!-- Base -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../../../../views/images/favicon/favicon-32x32.png" type="image/icon type">
    <title>Matérias | Heelp!</title>

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

   
    <!-- CSS Search Bar -->
    <link rel="stylesheet" href="../../../../style/search-bar.style.css">

    <!-- Script do Sanduíche -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- Estilos -->
    <link rel="stylesheet" href="../../../../../views/styles/colors.style.css">
    <link rel="stylesheet" href="../../../../style/modal-delete-teacher.style.css">
    <link rel="stylesheet" href="../../../../../views/styles/style.global.css">
    <link rel="stylesheet" href="../../../../../views/styles/fonts.style.css">
    <link rel="stylesheet" href="../registration panel/registration-panel-style.css">
    <link rel="stylesheet" href="../register.styles.css">

    <link rel="stylesheet" href="../../../../style/modal-delete-teacher.style.css">

</head>

<body>

        <!-- Inicio Wrapper -->
        <div class="wrapper">

            <!-- NavBar Lateral - SideBar -->
            <nav class="sidebar">

                <!-- Logo Heelp! -->
                <a href="#" class="logo-heelp">
                    <img src="../../../../../views/images/logo/logo-help.svg" alt="" class="logo-heelp-img">
                    <h4 class="logo-heelp-text normal-22-black-title-1">heelp!</h4>
                </a>

                <!-- Texto nº2 para Responsividade -->
                <div class="respo-cabe">
                    <a href="../registration panel/registration-panel-page.php" class="seta-voltar-a seta-voltar-a-responsividade">
                        <img src="../../../../../views/images/components/arrow-back.svg" class="seta-voltar-img">
                    </a>
                    <p class="add-info-text add-info-text-responsividade normal-22-black-title-1">Matérias</p>
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
                            <img src="../../../../../views/images/logo/logo-help.svg" alt="" class="logo-heelp-img">
                            <h4 class="logo-heelp-text normal-22-black-title-1">heelp!</h4>
                        </a>
                    </li>

                    <!-- Opções da NavBar -->
                    <li class="sidebar-li">
                        <a href="../registration panel/registration-panel-page.php" class="sidebar-button-a normal-14-bold-p">
                            <div class="sidebar-button">
                                <p class="sidebar-button-text">Adicionar Informações +</p> 
                            </div>
                        </a>
                    </li>

                    <li class="sidebar-li">
                        <a href="../../dashboard/dashboard.page.php" class="sidebar-a-items">
                            <img class="sidebar-img" src="../../../../../views/images/components/dashboard-img.svg" alt="">
                            <p class="sidebar-option normal-18-bold-title-2">Dashboard</p>
                        </a>
                        <hr class="sidebar-linha">
                    </li>

                    <li class="sidebar-li">
                        <p class="sidebar-categoria normal-14-bold-p">Mensagens</p>
                        <a href="../../denunciation/list-denunciation.page.php" class="sidebar-a-items">
                            <img class="sidebar-img" src="../../../../../views/images/components/denuncia-img.svg" alt="">
                            <p class="sidebar-option normal-18-bold-title-2">Denúncias</p>
                        </a>
                    </li>

                    <li class="sidebar-li">
                        <a href="../../message/list-message.page.php" class="sidebar-a-items">
                            <img class="sidebar-img" src="../../../../../views/images/components/fale-conosco-img.svg" alt="">
                            <p class="sidebar-option normal-18-bold-title-2">Fale Conosco</p>
                        </a>
                    </li>

                    <li class="sidebar-li">
                        <p class="sidebar-categoria normal-14-bold-p">Contas</p>
                        <a href="../../list-profiles/list-profiles.page.php" class="sidebar-a-items">
                            <img class="sidebar-img" src="../../../../../views/images/components/listagem-img.svg" alt="">
                            <p class="sidebar-option normal-18-bold-title-2">Listagem</p>
                        </a>
                        <hr class="sidebar-linha">
                    </li>

                    <li class="sidebar-li">
                        <a href="../../../../logout/logout.controller.php" class="sidebar-a-items2">
                        <img class="sidebar-img" src="../../../../../views/images/components/sair-img.svg" alt="">
                        <p class="sidebar-option normal-18-bold-title-2">Sair</p>
                    </a>
                    </li>

                </ul>

            </nav>

            <!-- Corpo -->
            <div class="corpo">

                <div class="cabecalho">
                    <a href="../registration panel/registration-panel-page.php" class="seta-voltar-a">
                        <img src="../../../../../views/images/components/arrow-back.svg" class="seta-voltar-img">
                    </a>
                    <p class="add-info-text normal-22-black-title-1">Matérias</p>  
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

                    <div class="register-cards">

                        <!-- Cadastro matéria ⬇️ -->
                        <a href="./form-register-subject.page.php" class="unit-card-a">
                            <div class="unit-card-1">
                                <p class="unit-card-text normal-18-black-title-2">Clique aqui para fazer o cadastro unitário</p> 
                                <img src="../../../images/unit-card-img.svg" class="unit-card-img">
                            </div>
                        </a>
    
                        <!-- Cadastro matéria ⬇️ -->
                        <a href="./form-batch-registration.subject.controller.php" class="unit-card-a">
                            <div class="unit-card-2">
                                <p class="unit-card-text normal-18-black-title-2">Clique aqui para fazer o cadastro em lote</p> 
                                <img src="../../../images/batch-card-img.svg" class="unit-card-img">
                            </div>
                        </a>

                    </div>

                    <!-- Barra de pesquisa ⬇️ -->
                    <form action="./list-subject.page.php" method="GET">
                        <input type="text" name="searchSubject" id="searchSubject" placeholder="Pesquise por matérias" autocomplete="off" class="search-bar">
                        <input type="submit" value="🔎" class="search-button">
                    </form>

                    <!-- Contador de matérias ⬇️ -->
                    <p class="contador-prof normal-18-black-title-2">
                        <?php echo $countSubjects ?>
                    </p>

                    <!-- Lista de matérias ⬇️ -->
                    <div class="list-prof">

                        <?php for ($i = 0; $i < count($listSubjects); $i++) {
                            $row = $listSubjects[$i] ?>

                            <div class="card-mod">

                                <div class="info-prof-cima">
                                    
                                    <p class="prof-name normal-14-medium-p">
                                        Matéria
                                    </p>

                                    <!-- Mais Opções -->
                                    <div class="drop-edit-exclud">
                                        <img src="../../../../../views/images/components/three-dots.svg">
                                        
                                        <!-- Parte do Update e Delete -->
                                        <div class="drop-edit-exclud-content">
                                            <a href="./form-update-subject.page.php?updateSubject=<?php echo $row->id; ?>" class="drop-edit-exclud-a">
                                                <div class="drop-edit-exclud-option">
                                                    <img src="../../../../../views/images/components/edit-pen.svg" class="drop-edit-exclud-img">
                                                    <p class="drop-edit-exclud-text normal-14-bold-p">Editar</p>
                                                </div>
                                            </a>
                                            <a href="./controller/delete-subject.controller.php?id=<?php echo $row->id; ?>" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="drop-edit-exclud-a delete">
                                                <div class="drop-edit-exclud-option">
                                                    <img src="../../../../../views/images/components/delete-bin.svg" class="drop-edit-exclud-img">
                                                    <p class="drop-edit-exclud-text normal-14-bold-p">Excluir</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                </div>

                                    <p class="prof-text normal-14-bold-p text-truncate">
                                        <?php echo $row->name; ?>
                                    </p>

                            </div>

                        <?php } ?>

                    </div>
                        
                        <?php 
                        if(empty($search)){
                            echo ("<div class='div-pagination'>");
                            $listSubjects = $subject->paginationSubjects();
                            echo ("</div>");
                         }else{
                            echo ("<div class='div-pagination'>");
                            $listSubjectsOfSearch = $subject->paginationSubjectsOfSearch($search);
                            echo ("</div>");
                         } ?>
                </div>
            </div>

        <!-- Fim Wrapper -->
        </div>

    <!-- JS Bootstrap ⬇️ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- JS Modal Excluir ⬇️ -->
    <script src="../../js/delete-subject.js"></script>

    <!-- JS Search bar -->
    <script src="../../js/autocomplete.js"></script>

    <!-- JS Search bar ⬇️ -->
    <script>
        const field = document.getElementById('searchSubject');
        const ac = new Autocomplete(field, {
            data: <?php echo json_encode($optionOfSearch); ?>,
            maximumItems: 8,
            treshold: 1,
        });
    </script>

</body>

</html>