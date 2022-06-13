<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-administrator.controller.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- CSS Search Bar -->
    <link rel="stylesheet" href="../../../../style/search-bar.style.css">

    <!-- Script do Sanduíche -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="../../../../views/styles/style.global.css">
    <link rel="stylesheet" href="../../../../views/styles/colors.style.css">
    <link rel="stylesheet" href="../../../../views/styles/fonts.style.css">
    <link rel="shortcut icon" href="../../../../views/images/favicon/favicon-16x16.png" type="image/x-icon">
    <link rel="stylesheet" href="../register/register.styles.css">
    <link rel="stylesheet" href="../register/registration panel/registration-panel-style.css">
    <link rel="stylesheet" href="style.dashboard.css">
    <title>Dashboard | Heelp!</title>
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
                <p class="add-info-text add-info-text-responsividade normal-22-black-title-1">Dashboard</p>
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
                    <a href="dashboard.page.php" class="sidebar-a-items">
                        <img class="sidebar-img" src="../../../../views/images/components/filled-dashboard-img.svg" alt="">
                        <p class="normal-18-bold-title-2 sidebar-option sidebar-option-current">Dashboard</p>
                    </a>
                    <hr class="sidebar-linha">
                </li>

                <li class="sidebar-li">
                    <p class="sidebar-categoria normal-14-bold-p">Mensagens</p>
                    <a href="#" class="sidebar-a">
                        <img class="sidebar-img" src="../../../../views/images/components/denuncia-img.svg" alt="">
                        <p class="sidebar-option normal-18-bold-title-2">Denuncias</p>
                    </a>
                </li>

                <li class="sidebar-li">
                    <a href="#" class="sidebar-a">
                        <img class="sidebar-img" src="../../../../views/images/components/informacoes-img.svg" alt="">
                        <p class="sidebar-option normal-18-bold-title-2">Informações</p>
                    </a>
                </li>

                <li class="sidebar-li">
                    <a href="../message/list-message.page.php" class="sidebar-a">
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
        <div class="corpo">

            <div class="cabecalho">
                <p class="dashboard-title normal-22-black-title-1">Dashboard</p>
            </div>
            <!-- Parte Branca -->
            <div class="conteudo">
                <!-- Card ajuda adminsitrador -->
                <div class="help-adm-email-container d-flex justify-content-between">
                    <div class="main-help-adm align-self-center ms-4 ms-sm-4 ms-md-4 ms-lg-4 ms-xl-4 me-4 me-sm-4 me-md-4 me-lg-4 me-xl-4">
                        <span class="span-help-adm normal-22-black-title-1 white-title">Olá adminisitrador, precisando de ajuda? Entre em contato com a gente!</span>
                        <br />
                        <div class="button-container">
                            <div class="adm-email-button white-title normal-14-bold-p">
                                <span>Enviar e-mail</span>
                            </div>
                        </div>
                    </div>
                    <div class="avatar-help-adm d-none d-sm-none d-md-flex d-lg-flex align-self-center me-4 me-sm-4 me-md-4 me-lg-4 me-xl-4">
                        <img src="../../../../views/images/avatars/avatar-scotty.svg" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="container1 d-lg-flex justify-content-lg-between">
                        <div class="dashboard-chart-container col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <div class="dashboard-chart">
                                <div class="chart-title">
                                    <span class="normal-18-bold-title-2">Avaliação das respostas</span>
                                </div>
                                <canvas id="myChart">
                                    <script>
                                        const labels = [
                                            'Bem avaliadas',
                                            'Mal avaliadas',
                                        ];



                                        const data = {
                                            labels: labels,
                                            datasets: [{
                                                label: 'My First dataset',
                                                backgroundColor: [
                                                    'rgba(128, 128, 255, 1)',
                                                    'rgba(255, 198, 25, 1)',
                                                ],

                                                data: [24, 8],
                                            }]
                                        };

                                        const config = {
                                            type: 'pie',
                                            data: data,
                                            options: {}
                                        };
                                    </script>
                                </canvas>
                            </div>
                        </div>
                        <div class="top10 col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <div class="title-top10 d-flex justify-content-center">
                                <img src="../../images/components/trophy-icon.svg">
                                <span class="span-top10 normal-18-black-title-2">Top 10 cursos com mais alunos</span>
                                <img src="../../images/components/trophy-icon.svg">
                            </div>
                            <div class="hrtop"></div>

                            <div class="top-courses">
                                <span class="normal-14-bold-p number-rank">01°</span>
                                <img src="../../images/icons/icon-acucar.svg" class="icon-top">
                                <span class="normal-16-bold-title-3">Açúcar e Álcool</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container2">
                    <div class="row d-lg-flex justify-content-lg-between">
                        <div class="report dash-cards col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                            <section class="section">
                                <span class="card-num">2</span>
                                <span class="card-label">Denúncias</span>
                            </section>
                        </div>
                        <div class="requested-info dash-cards col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                            <section class="section">
                                <span class="card-num">3</span>
                                <span class="card-label">Informações solicitadas</span>
                            </section>
                        </div>
                        <div class="students-total dash-cards col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                            <section class="section">
                                <span class="card-num">10.000</span>
                                <span class="card-label">Total de alunos</span>
                            </section>
                        </div>
                        <div class="company-total dash-cards col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                            <section class="section">
                                <span class="card-num">10.000</span>
                                <span class="card-label">Total de empresas</span>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- JS Bootstrap ⬇️ -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <!-- JS Chart -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- JS Chart render -->
        <script>
            const myChart = new Chart(
                document.getElementById('myChart'),
                config
            );
        </script>
</body>

</html>