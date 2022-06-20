<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-administrator.controller.php');
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/solicitations/Solicitation.class.php');

$connection = Connection::connection();

try {

    $current_page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
    $page = (!empty($current_page)) ? $current_page : 1;

    $search = $_GET['searchSolicitation'] ?? '';
    $solicitation = new Solicitation();

    $listNewSolicitation = $solicitation->listNewSolicitation($search);
    $listAnalysisSolicitation = $solicitation->listAnalysisSolicitation();
    $listResolvedSolicitation = $solicitation->listResolvedSolicitation();

    $countNewSolicitation = $solicitation->countNewSolicitation($search);
    $countAnalysisSolicitation = $solicitation->countAnalysisSolicitation();
    $countResolvedSolicitation = $solicitation->countResolvedSolicitation();

    $listSolicitationOfSearch = $solicitation->listSolicitationOfSearchBar();

    $optionOfSearch = array();
    foreach ($listSolicitationOfSearch as $row) {
        $optionOfSearch[] = array(
            'label' => $row->category,
            'value' => $row->category
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
    <title>Solicitação</title>

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Estilos -->
    <link rel="stylesheet" href="../../../../views/styles/style.global.css">
    <link rel="stylesheet" href="../../../style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../../private/style/style.css">

    <!-- CSS MdBootstrap -->
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css" rel="stylesheet" />


</head>

<body>

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
    <form action="./list-solicitation.page.php" method="GET">
        <input type="text" name="searchSolicitation" id="searchSolicitation" placeholder="Pesquise por solicitações" autocomplete="off">
        <input type="submit" value="Pesquisar">
    </form>

    <!-- Tabs navs -->
    <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="ex1-tab-1" data-mdb-toggle="tab" href="#ex1-tabs-1" role="tab" aria-controls="ex1-tabs-1" aria-selected="true">Novas</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="ex1-tab-2" data-mdb-toggle="tab" href="#ex1-tabs-2" role="tab" aria-controls="ex1-tabs-2" aria-selected="false">Em analise</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="ex1-tab-3" data-mdb-toggle="tab" href="#ex1-tabs-3" role="tab" aria-controls="ex1-tabs-3" aria-selected="false">Resolvidas</a>
        </li>
    </ul>

    <!-- Tabs content -->
    <!-- Novas solicitações -->
    <div class="tab-content" id="ex1-content">
        <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
            <?php if ($search == null) { ?>
                <div id="solicitation-new-list"></div>

                <div id="pagination-new-solicitation"></div>
            <?php } else {   ?>
                <div id="solicitation-search-list"></div>

                <div id="pagination-search-solicitation"></div>
            <?php } ?>
        </div>

        <!-- Solicitações em análise -->
        <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
            <div id="solicitation-analysis-list">

            </div>
            <div id="pagination-Analysis-solicitation">

            </div>
        </div>

        <!-- Solicitações Resolvidas -->
        <div class="tab-pane fade" id="ex1-tabs-3" role="tabpanel" aria-labelledby="ex1-tab-3">
            <div id="solicitation-resolved-list">

            </div>
            <div id="pagination-resolved-solicitation">

            </div>
        </div>
        <!-- Tabs content -->
        <!-- Modal -->
        <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel"> Solicitação de informações </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3 needs-validation" action="./controller/register-solicitation-category.controller.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email para contato</label>
                            <input name="contact" type="email" class="form-control" id="exampleFormControlInput1" required placeholder="contato@email.com" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <select class="form-select" aria-label="Default select example" required name="context_id" id="context_id">
                                <option value="">Selecione a Categoria</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1">Titulo</label>
                            <input name="title" type="text" class="form-control" id="title" placeholder="Digite o título da informação" required autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Em que podemos ajudar?</label>
                            <div id="contentTextArea">
                                <textarea name="conclusion" id="conclusion" class="form-control" rows="7" placeholder="Nos conte como foi/está sendo a sua experiência" onclick="colorDiv()" required minlength="5"  maxlength="200"></textarea>
                            </div>
                            <div>
                                <span id="counterTextArea">200</span>
                            </div>
                            <hr>
                        </div>
                        <div class="col-12">
                            <input class="btn btn-primary" type="submit" value="Enviar" name="register"></input>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->

        <!-- JS Bootstrap ⬇️ -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <!-- JS Search bar -->
        <script src="../js/autocomplete.js"></script>

        <!-- JS Search bar ⬇️ -->
        <script>
            const field = document.getElementById('searchSolicitation');
            const acc = new Autocomplete(field, {
                data: <?php echo json_encode($optionOfSearch); ?>,
                maximumItems: 8,
                treshold: 1,
            });
        </script>

        <!-- JS Select da situação ⬇️ -->
        <script>
            const selectContext = document.getElementById('context_id');
            console.log(selectContext);
            if (selectContext) {
                selectContextId();
            }

            async function selectContextId() {
                // const selectContext = document.getElementById("context_id");
                const dados = await fetch('./controller/list-context.controller.php');
                const json_Context = await dados.json();
                // console.log(json_Context)

                if (json_Context['status']) {
                    var option = "<option value=''>Selecione o Contexto</option>'";
                    for (var i = 0; i < json_Context.dados.length; i++) {
                        // console.log(json_Context.dados[i]['id']);
                        // console.log(json_Context.dados[i]['name']);
                        option += '<option value="' + json_Context.dados[i]['id'] + '">' + json_Context.dados[i]['context'] + '</option>';
                    }
                    selectContext.innerHTML = option;
                }
            }
        </script>

        <!-- Paginação das solicitações novas -->
        <script>
            const listNewSolicitation = document.getElementById('solicitation-new-list');

            const paginationSolicitatonNew = document.getElementById('pagination-new-solicitation');

            const listSolicitationNew = async (page) => {
                const dados = await fetch('./controller/list/list-solicitation-new.controller.php?page=' + page);
                // console.log("to funfando");
                const asweres = await dados.text();
                listNewSolicitation.innerHTML = asweres;

                const dados2 = await fetch('./controller/pagination/pagination-solicitation-new.controller.php?page=' + page);
                // console.log("to funconando")
                const asweres2 = await dados2.text();
                paginationSolicitatonNew.innerHTML = asweres2;
            }

            listSolicitationNew(1);
        </script>

        <!-- Paginação das solicitações em análise -->
        <script>
            const listSolicitation = document.getElementById('solicitation-analysis-list');

            const paginationSolicitaton = document.getElementById('pagination-Analysis-solicitation');

            const listSolicitationAnalysis = async (page) => {
                const dados = await fetch('./controller/list/list-solicitation-analysis.controller.php?page=' + page);
                // console.log("to funfando");
                const asweres = await dados.text();
                listSolicitation.innerHTML = asweres;

                const dados2 = await fetch('./controller/pagination/pagination-solicitation-analysis.controller.php?page=' + page);
                // console.log("to funconando")
                const asweres2 = await dados2.text();
                paginationSolicitaton.innerHTML = asweres2;
            }

            listSolicitationAnalysis(1);
        </script>

        <!-- Paginação das solicitações novas -->
        <script>
            const listResolvedSolicitation = document.getElementById('solicitation-resolved-list');

            const paginationSolicitatonResolved = document.getElementById('pagination-resolved-solicitation');

            const listSolicitationResolved = async (page) => {
                const dados = await fetch('./controller/list/list-solicitation-resolved.controller.php?page=' + page);
                // console.log("to funfando");
                const asweres = await dados.text();
                listResolvedSolicitation.innerHTML = asweres;

                const dados2 = await fetch('./controller/pagination/pagination-solicitation-resolved.controller.php?page=' + page);
                // console.log("to funconando")
                const asweres2 = await dados2.text();
                paginationSolicitatonResolved.innerHTML = asweres2;
            }

            listSolicitationResolved(1);
        </script>

        <!-- Paginação das solicitações novas -->
        <script>
            const listSearchSolicitation = document.getElementById('solicitation-resolved-list');

            const paginationSolicitatonSearch = document.getElementById('pagination-resolved-solicitation');

            const listSolicitationSearch = async (page) => {
                const dados = await fetch('./controller/list/list-solicitation-resolved.controller.php?page=' + page);
                // console.log("to funfando");
                const asweres = await dados.text();
                listSolicitationSearch.innerHTML = asweres;

                const dados2 = await fetch('./controller/pagination/pagination-solicitation-resolved.controller.php?page=' + page);
                // console.log("to funconando")
                const asweres2 = await dados2.text();
                paginationSolicitatonSearch.innerHTML = asweres2;
            }

            listSolicitationSearch(1);
        </script>


        <!-- MDB -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>

        <!-- Text Area -->
        <script src="../js/textareaConclusion.js"></script>

</body>

</html>