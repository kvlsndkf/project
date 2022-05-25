<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!-- HTML Padrão -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Estilos -->
        <link rel="stylesheet" href="../../../../../views/styles/style.global.css">
        <link rel="stylesheet" href="../../../../../views/styles/fonts.style.css">
        <link rel="stylesheet" href="./registration-panel-style.css">
        <link rel="stylesheet" href="../../dashboard/style.dashboard.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

        <!-- Título e Ícone -->
        <title>Adicionar Informações | Heelp!</title>
        <link rel="icon" href="../../../../../views/images/favicon/favicon-32x32.png" type="image/icon type">

        <!-- JavaScript -->
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

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
                <p class="add-info-text add-info-text-responsividade normal-22-black-title-1">Adicionar Informações</p>

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
                        <div class="sidebar-button">
                            <a href="./registration-panel-page.php" class="sidebar-button-a normal-14-bold-p">
                                Adicionar Informações +
                            </a>
                        </div>
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
                        <a href="#" class="sidebar-a">
                            <img class="sidebar-img" src="../../../../../views/images/components/denuncia-img.svg" alt="">
                            <p class="sidebar-option normal-18-bold-title-2">Denuncias</p>
                        </a>
                    </li>

                    <li class="sidebar-li">
                        <a href="#" class="sidebar-a">
                            <img class="sidebar-img" src="../../../../../views/images/components/informacoes-img.svg" alt="">
                            <p class="sidebar-option normal-18-bold-title-2">Informações</p>
                        </a>
                    </li>

                    <li class="sidebar-li">
                        <a href="#" class="sidebar-a">
                            <img class="sidebar-img" src="../../../../../views/images/components/fale-conosco-img.svg" alt="">
                            <p class="sidebar-option normal-18-bold-title-2">Fale Conosco</p>
                        </a>
                    </li>

                    <li class="sidebar-li">
                        <p class="sidebar-categoria normal-14-bold-p">Contas</p>
                        <a href="#" class="sidebar-a">
                            <img class="sidebar-img" src="../../../../../views/images/components/listagem-img.svg" alt="">
                            <p class="sidebar-option normal-18-bold-title-2">Listagem</p>
                        </a>
                        <hr class="sidebar-linha">
                    </li>

                    <li class="sidebar-li">
                        <a href="#" class="sidebar-a">
                        <img class="sidebar-img" src="../../../../../views/images/components/sair-img.svg" alt="">
                        <p class="sidebar-option normal-18-bold-title-2">Sair</p>
                    </a>
                    </li>

                </ul>

            </nav>

            <!-- Corpo -->
            <div class="corpo">

                <p class="add-info-text normal-22-black-title-1">Adicionar Informações</p>

                <!-- Parte Branca -->
                <div class="conteudo">

                    <div class="prof-cad cad-option">
                        <a href="../register-teacher/list-teacher.page.php" class="cad-a">
                            <p class="nome-cad normal-40-black-display">Professores</p>
                            <img src="./img/prof-img.svg" class="img-cad">
                        </a>
                        
                    </div>

                    <div class="mod-cad cad-option">
                        <a href="../register-module/list-module.page.php" class="cad-a">
                           <p class="nome-cad normal-40-black-display">Módulos</p>
                            <img src="./img/module-img.svg" class="img-cad"> 
                        </a>
                        
                    </div>

                    <div class="school-cad cad-option">
                        <a href="#" class="cad-a">
                            <p class="nome-cad normal-40-black-display">ETECs</p>
                            <img src="./img/school-img.svg" class="img-cad">
                        </a>
                    </div>

                    <div class="course-cad cad-option">
                        <a href="#" class="cad-a">
                            <p class="nome-cad normal-40-black-display">Cursos</p>
                            <img src="./img/course-img.svg" class="img-cad">
                        </a>
                    </div>   

                    <div class="subject-cad cad-option">
                        <a href="#" class="cad-a">
                            <p class="nome-cad normal-40-black-display">Matérias</p>
                            <img src="./img/subject-img.svg" class="img-cad">
                        </a>
                    </div>

                </div>

            </div>

            <!-- Fim Wrapper -->
        </div>

        
    </body>
</html>