<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/schools/School.class.php');

session_start();

try {
    $search = $_GET['searchSchool'] ?? '';
    $filter = $_GET['filterSchool'] ?? '';

    $school = new School();
    $listSchools = $school->listSchool($search, $filter);
    $countSchools = $school->countSchools($search, $filter);
    $listSchoolsOfSearch = $school->listSchoolOfSearchBar();

    $optionOfSearchSchool = array();
    foreach ($listSchoolsOfSearch as $row) {
        $optionOfSearchSchool[] = array(
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
        <title>Etec's | Heelp!</title>
        <link rel="icon" href="../../../../../views/images/favicon/favicon-32x32.png" type="image/icon type">

        <!-- CSS Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <!-- CSS Search Bar -->
        <link rel="stylesheet" href="../../../../style/search-bar.style.css">

        <!-- Script do Sanduíche -->
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

        <!-- Estilos -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
        <link rel="stylesheet" href="../../../../../views/styles/style.global.css">
        <link rel="stylesheet" href="../../../../../views/styles/fonts.style.css">
        <link rel="stylesheet" href="../registration panel/registration-panel-style.css">
        <link rel="stylesheet" href="../register.styles.css">
        <link rel="stylesheet" href="../../../../../views/styles/colors.style.css">

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
                <p class="add-info-text add-info-text-responsividade normal-22-black-title-1">Etec's</p>
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
                    <a href="#" class="sidebar-a-items">
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

            <div class="cabecalho">
                <a href="../registration panel/registration-panel-page.php" class="seta-voltar-a">
                    <img src="../../../../../views/images/components/arrow-back.svg" class="seta-voltar-img">
                </a>
                <p class="add-info-text normal-22-black-title-1">Etec's</p>
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

        <!-- Cadastro escola ⬇️ -->
        <a href="./form-register-school.page.php" class="unit-card-a">
            <div class="unit-card">
                <p class="unit-card-text normal-18-black-title-2">Clique aqui para fazer o cadastro unitário</p>
                <img src="../../../images/unit-card-img.svg" class="unit-card-img">
            </div>
        </a>

        <!-- Barra de pesquisa ⬇️ -->
        <form action="./list-school.page.php" method="GET">
            <input type="text" name="searchSchool" id="searchSchool" placeholder="Pesquise por Etec's" autocomplete="off" class="search-bar">
            <input type="submit" value="🔎" class="search-button">
        </form>

        <!-- Filtro ⬇️ -->
        <div class="filtro-school">
            
            <form action="./list-school.page.php" method="GET">
                <?php $filter = $_GET['filterSchool'] ?? '';
                $styleFilter = $filter == "" ? 'btn filtro-option normal-14-bold-p' : 'btn filtro-option-2 normal-14-bold-p';  ?>
                <input type="hidden" name="filterSchool" value="">
                <button type="submit" class="<?php echo $styleFilter; ?>" id="all">Todas</button>
            </form>
    
            <form action="./list-school.page.php" method="GET">
                <?php $filter = $_GET['filterSchool'] ?? '';
                $styleFilter = $filter == "Comconta" ? 'btn filtro-option normal-14-bold-p' : 'btn filtro-option-2 normal-14-bold-p';  ?>
                <input type="hidden" name="filterSchool" value="Comconta">
                <button type="submit" class="<?php echo $styleFilter; ?>" id="have-account">Com conta</button>
            </form>
    
            <form action="./list-school.page.php" method="GET">
                <?php $filter = $_GET['filterSchool'] ?? '';
                $styleFilter = $filter == "Semconta" ? 'btn filtro-option normal-14-bold-p' : 'btn filtro-option-2 normal-14-bold-p';  ?>
                <input type="hidden" name="filterSchool" value="Semconta">
                <button type="submit" class="<?php echo $styleFilter; ?>" id="not-have-account">Sem conta</button>
            </form>

        </div>


        <!-- Contador de professores ⬇️ -->
        <p class="contador-prof normal-18-black-title-2">
            <?php echo $countSchools ?>
        </p>

        <!-- Lista de professores ⬇️ -->
        <div class="list-prof">
        
            <?php for ($i = 0; $i < count($listSchools); $i++) {
                $row = $listSchools[$i] ?>

                <!-- Card da Listagem -->
                <div class="card-school">

                <?php $countTeachersInSchool = $school->countTeachersInSchool($row->id); ?>

                <!-- Info do Card -->
                <div class="info-prof">
                    <div class="info-prof-cima">
                        <p class="prof-name school-name normal-14-bold-p text-truncate">
                            <?php echo $row->name; ?>
                        </p>

                        <!-- Mais Opções -->
                        <div class="drop-edit-exclud">
                            <img src="../../../../../views/images/components/three-dots.svg">

                            <!-- Parte do Update e Delete -->
                            <div class="drop-edit-exclud-content">
                                <a href="./form-update-school.page.php?updateSchool=<?php echo $row->id; ?>" class="drop-edit-exclud-a">
                                    <div class="drop-edit-exclud-option">
                                        <img src="../../../../../views/images/components/edit-pen.svg" class="drop-edit-exclud-img">
                                        <p class="drop-edit-exclud-text normal-14-bold-p">Editar</p>
                                    </div>
                                </a>
                                <a href="./controller/delete-school.controller.php?id=<?php echo $row->id; ?>" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="drop-edit-exclud-a delete">
                                    <div class="drop-edit-exclud-option">
                                        <img src="../../../../../views/images/components/delete-bin.svg" class="drop-edit-exclud-img">
                                        <p class="drop-edit-exclud-text normal-14-bold-p">Excluir</p>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>
                    
                    
                    
                    <p class="prof-text normal-14-medium-p">
                        <img src="../../../../../views/images/components/location-symbol.svg">
                        <?php echo $row->address; ?>, São Paulo
                    </p>
                    
                <hr>

                <?php $style = $row->haveAccount == "Sem conta" ? 'badge rounded-pill bg-warning text-dark' : 'badge rounded-pill bg-help-primary'; ?>
                <span class="<?php echo $style; ?>"><?php echo $row->haveAccount; ?></span>
                
                <?php $style = $countTeachersInSchool == 0 ? 'badge rounded-pill bg-primary d-none' : 'badge rounded-pill bg-primary'; ?>
                <span class="<?php echo $style; ?>"> Professores: <?php echo $countTeachersInSchool ?></span>
                
                <br><br>
                
                <form action="./list-school.page.php?id=<?php echo $row->id; ?>" method="get">
                </form>

                <button type="submit" class="more-details-button" data-bs-toggle="modal" data-bs-target="#myModal" data-id="<?php echo $row->id; ?>" onclick="schoolModal(this)">
                    <p class="more-details-button-text normal-14-bold-p">Ver mais detalhes</p> 
                </button>
            </div>
        </div>
            <?php } ?>

        </div>

        <!-- The Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Detalhes da Etec</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <p>
                            <a href="" id="school-edit">Editar</a>
                            <a href="" id="school-delete" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete">Excluir</a>
                        </p>
                        <img src="" alt="" id="photo-school">
                        <div id="name-school"></div>
                        <div id="address-school">, São Paulo</div>


                        <div id="body-modal-have-account">
                            <a id="linkedin-school" target="_blank" href="">
                                <img src="../../../images/icons/linkedin.svg" alt="Logo linkedin">
                            </a>

                            <a id="github-school" target="_blank" href="">
                                <img src="../../../images/icons/github.svg" alt="Logo github">
                            </a>

                            <a id="facebook-school" target="_blank" href="">
                                <img src="../../../images/icons/facebook.svg" alt="Logo facebook">
                            </a>

                            <a id="instagram-school" target="_blank" href="">
                                <img src="../../../images/icons/instagram.svg" alt="Logo instagram">
                            </a>
                            <br>
                            <label>Sobre</label>
                            <div id="about-school"></div>

                            <br>
                            <br>
                            <hr>

                            <label for="">Professores</label>
                            <div id="teachers-list">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Paginação ⬇️ -->
        <div class="div-pagination">
            
            <?php

if (!empty($search) && $filter == null){
    $paginationSchoolfilter = $school ->paginationSchoolSearch($search);
}else if (empty($search) && $filter == null){
    $paginationSchoolfilter = $school ->paginationSchool($search);
} else {
    
}       
        
        if($filter == 'Semconta' && $search == null){
            $paginationSchoolfilter = $school ->paginationSchoolfilterNoHaveAccount($filter);
        } else if ($filter == 'Comconta' && $search == null) {
            $paginationSchoolfilter = $school ->paginationSchoolfilterHaveAccount($filter);
        } else {

        }    
    ?>


    </div>

        <!-- JS Bootstrap ⬇️ -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <!-- JS Modal Excluir ⬇️ -->
        <script src="../../js/delete-school.js"></script>

        <!-- JS Search bar -->
        <script src="../../js/autocomplete.js"></script>

        <!-- JS Search bar ⬇️ -->
        <script>
            const field = document.getElementById('searchSchool');
            const acc = new Autocomplete(field, {
                data: <?php echo json_encode($optionOfSearchSchool); ?>,
                maximumItems: 8,
                treshold: 1,
            });
        </script>

        <!-- JS Button Filter -->
        <script src="../../js/button-filter.js"></script>

        <script>
            function assingValueInElementById(name, atr, value) {
                document.getElementById(name)[atr] = value;
            }

            function assingOptionalValueInElementById(name, atr, value) {
                const element = document.getElementById(name);

                if (!value) {
                    element.style.display = "none";
                } else {
                    element[atr] = value;
                    element.style.display = "inline";
                }

            }

            async function schoolModal(self) {
                const id = self.getAttribute("data-id");
                const dados = await fetch('./controller/json-school.controller.php?idSchool=' + id);

                const json_school = await dados.json();
                const convert_into_string = JSON.stringify(json_school);
                const object_school = JSON.parse(convert_into_string);
                const school = object_school['school'][0];

                const haveAccount = school['haveAccount'];

                var photo = document.getElementById('photo-school');
                var bodyModal = document.getElementById('body-modal-have-account');

                document.getElementById('school-edit').href = "./form-update-school.page.php?updateSchool=" + school['id'];
                document.getElementById('school-delete').href = "./controller/delete-school.controller.php?id=" + school['id'];

                if (haveAccount == "Sem conta") {
                    document.getElementById('name-school').innerHTML = school['name'];
                    document.getElementById('address-school').innerHTML = school['address'] + ", São Paulo";

                    photo.style.display = "none";
                    bodyModal.style.display = "none";

                } else {
                    photo.style.display = "";
                    bodyModal.style.display = "";

                    const linkedin = school['linkedin'];

                    const github = school['github'];
                    const facebook = school['facebook'];
                    const instagram = school['instagram'];

                    assingOptionalValueInElementById('linkedin-school', 'href', linkedin);
                    assingOptionalValueInElementById('github-school', 'href', github);
                    assingOptionalValueInElementById('facebook-school', 'href', facebook);
                    assingOptionalValueInElementById('instagram-school', 'href', instagram);

                    assingValueInElementById('photo-school', "src", school['photo']);
                    assingValueInElementById('name-school', 'innerHTML', school['name']);
                    assingValueInElementById('address-school', 'innerHTML', school['address'] + ", São Paulo");
                    assingValueInElementById('about-school', 'innerHTML', school['about']);
                }

                const teachersList = document.getElementById("teachers-list");
                teachersList.innerHTML = "";

                array_teachers = object_school['teachers'];


                for (i = 0; i < array_teachers.length; i++) {
                    const divElement = document.createElement("div");
                    divElement.className = "";
                    const tElement = document.createElement("p");
                    tElement.className = "";
                    const photoElement = document.createElement("img");
                    photoElement.className = "";

                    tElement.innerHTML = array_teachers[i]['name'];
                    photoElement.src = array_teachers[i]['photo'];

                    divElement.id = i;
                    divElement.appendChild(tElement);
                    divElement.appendChild(photoElement);

                    document.getElementById("teachers-list").appendChild(divElement);
                }
            }
        </script>
    </body>

</html>