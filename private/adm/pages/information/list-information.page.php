<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-administrator.controller.php');
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/solicitations/Solicitation.class.php');

// session_start();

$connection = Connection::connection();

try {

    $current_page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
    $page = (!empty($current_page)) ? $current_page : 1;

    $search = $_GET['searchSolicitation'] ?? '';
    $solicitation = new Solicitation();

    $listNewSolicitation = $solicitation->listNewSolicitation($search);
    $listSolicitation = $solicitation->listSolicitation();
    $listResolvedSolicitation = $solicitation->listResolvedSolicitation();

    $countNewSolicitation = $solicitation->countNewSolicitation($search);
    $countSolicitation = $solicitation->countSolicitation();
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

    <!-- Barra de pesquisa ⬇️ -->
    <form action="./list-information.page.php" method="GET">
        <input type="text" name="searchSolicitation" id="searchSolicitation" placeholder="Pesquise por solicitações" autocomplete="off">
        <input type="submit" value="Pesquisar">
    </form>

    <!-- Tabs content -->
    <div class="tab-content" id="ex1-content">
        <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
            <div id="solicitation-new-list">

                <!-- Contador  de mensagens novas -->
                <?php echo  $countNewSolicitation ?>

                <br>

                <!-- Lista de mensagens novas -->
                <?php for ($i = 0; $i < count($listNewSolicitation); $i++) {
                    $row = $listNewSolicitation[$i] ?>

                    <?php $style = $row->status == "Nova" ? 'badge rounded-pill bg-warning text-dark' : 'badge rounded-pill bg-info'; ?>
                    <span class="<?php echo $style; ?>"><?php echo $row->status; ?></span>

                    <p>
                        Contato
                        <br>
                        <?php echo $row->contact; ?>
                    </p>

                    <p>
                        Categoria
                        <br>
                        <?php echo $row->category; ?>
                    </p>

                    <p>
                        Titulo
                        <br>
                        <?php echo $row->title; ?>
                    </p>

                    <p>
                        <!-- Descrição -->
                        <?php echo $row->description; ?>
                    </p>

                    <?php $styleButton = $row->status == "Nova" ? '' : 'd-none'; ?>
                    <form id="register" action="./controller/analyzing-solicitation.controller.php?solicitationNewID=<?php echo $row->id; ?>" class="<?php echo $styleButton; ?>" method="POST">
                        <button type="submit" name="analyzeRequest">Mover para análise e adicionar informação</button>
                    </form>

                    <hr>
                <?php } ?>

                <span id="pagination-new-solicitation">
                </span>    
            </div>
        </div>

        <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
            <div id="solicitation-analitic-list">

                <!-- Contador  de mensagens lidas -->
                <?php echo  $countSolicitation ?>

                <br>

                <!-- Lista de mensagens lidas ⬇️ -->
                <?php for ($i = 0; $i < count($listSolicitation); $i++) {
                    $row = $listSolicitation[$i] ?>

                    <?php $style = $row->status == "Análise" ? 'badge rounded-pill bg-info' : 'd-none'; ?>
                    <span class="<?php echo $style; ?>"><?php echo $row->status; ?></span>

                    <p>
                        Contato
                        <br>
                        <?php echo $row->contact; ?>
                    </p>

                    <p>
                        Categoria
                        <br>
                        <?php echo $row->category; ?>
                    </p>

                    <p>
                        Titulo
                        <br>
                        <?php echo $row->title; ?>
                    </p>

                    <p>
                        <!-- Descrição -->
                        <?php echo $row->description; ?>
                    </p>

                    <?php $styleButton = $row->status == "Análise" ? '' : 'd-none'; ?>

                    <button type="submit" name="concluidSolicitation" data-bs-toggle="modal" data-bs-target="#exampleModal">Marcar como concluida e enviar email de aviso</button>
                    <hr>
                <?php } ?>
            </div>
        </div>

        <div class="tab-pane fade" id="ex1-tabs-3" role="tabpanel" aria-labelledby="ex1-tab-3">
            <div id="solicitation-resolved-list">

                <!-- Contador  de mensagens lidas -->
                <?php echo  $countResolvedSolicitation ?>

                <br>

                <!-- Lista de mensagens lidas ⬇️ -->
                <?php for ($i = 0; $i < count($listResolvedSolicitation); $i++) {
                    $row = $listResolvedSolicitation[$i] ?>

                    <?php $style = $row->status == "Resolvida" ? 'badge rounded-pill bg-info' : 'd-none'; ?>
                    <span class="<?php echo $style; ?>"><?php echo $row->status; ?></span>

                    <?php $style = $row->statusSituation == "Solicitação acatada" ? 'badge rounded-pill bg-info' : 'd-none'; ?>
                    <span class="<?php echo $style; ?>"><?php echo $row->statusSituation; ?></span>

                    <?php $style = $row->statusSituation == "Solicitação acatada" ? 'badge rounded-pill bg-info' : 'd-none'; ?>
                    <span class="<?php echo $style; ?>"><?php echo $row->statusSituation; ?></span>

                    <p>
                        Contato
                        <br>
                        <?php echo $row->contact; ?>
                    </p>

                    <p>
                        Categoria
                        <br>
                        <?php echo $row->category; ?>
                    </p>

                    <p>
                        Titulo
                        <br>
                        <?php echo $row->title; ?>
                    </p>

                    <p>
                        <!-- Descrição -->
                        <?php echo $row->description; ?>
                    </p>

                    <hr>
                    <p>
                        Conclusão
                        <br>
                        <?php echo $row->conclusion; ?>
                    </p>
                    <hr>
                <?php } ?>
            </div>
        </div>
        <!-- Tabs content -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel"> Conclua a solicitação </h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3 needs-validation" action="./controller/resolved-solicitation.controller.php?idSolicitation=<?php echo $row->id; ?>" method="POST" enctype="multipart/form-data"  class="<?php echo $styleButton; ?>">
                            <div class="mb-3">
                                <select  name="selectSituation_id" id="selectSituation_id" required>
                                    <option value="">Selecione a Situação</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Conclusão</label>
                                <div id="contentTextArea"><textarea name="conclusion" id="conclusion" class="form-control" cols="30" rows="10" placeholder="Conclusão" onclick="colorDiv()" maxlength="200" required></textarea></div>
                                <div><span id="counterTextArea">200</span></div>
                                <hr>
                            </div>
                            <div class="col-12">
                                <input class="btn btn-primary" type="submit" value="Enviar" name="register" id="register" onclick="GFG_Fun()"></input>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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
            const selectSituation = document.getElementById("selectSituation_id");

            if (selectSituation) {
                selectSituationId();
            }

            async function selectSituationId() {
                const dados = await fetch('./controller/list-situation.controller.php');
                const json_situation = await dados.json();
                // console.log(json_situation)

                if (json_situation['status']) {
                    var option = "<option value=''>Selecione a Situação</option>'";
                    for (var i = 0; i < json_situation.dados.length; i++) {
                        // console.log(json_situation.dados[i]['id']);
                        // console.log(json_situation.dados[i]['name']);
                        option += '<option value="' + json_situation.dados[i]['id'] + '">' + json_situation.dados[i]['name'] + '</option>';
                    }
                    selectSituation.innerHTML = option;
                }
            }
        </script>

        <!-- MDB -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>
</body>

</html>