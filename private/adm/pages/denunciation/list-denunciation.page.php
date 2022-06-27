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
    <form action="./list-denunciation.page.php" method="GET">
        <input type="text" name="searchDenunciation" id="searchMessage" placeholder="Pesquise por denúncias" autocomplete="off">
        <input type="submit" value="pesquisar">
    </form>

    <?php
    if (empty($search)) {
        $styleSearch = 'd-none';
        $styleList = '';
    } else {
        $styleSearch = '';
        $styleList = 'd-none';
    }
    ?>

    <div class="<?php echo $styleSearch; ?>">

        <?php
        if (count($listSearch) == 0) {
            $_SESSION['statusNegative'] = "Não existe registros.";
            header('Location: /project/private/adm/pages/denunciation/list-denunciation.page.php');
        }
        ?>
        <!-- Contador de pesquisas -->
        <p>
            <?php echo  $countSearchDenunciations; ?>
        </p>

        <!-- Lista de pesquisa -->
        <?php for ($i = 0; $i < count($listSearch); $i++) {
            $row = $listSearch[$i] ?>

            <?php $styleNew = $row->status == "Nova" ? 'badge rounded-pill bg-warning text-dark' : 'd-none'; ?>
            <span class="<?php echo $styleNew; ?>"><?php echo $row->status; ?></span>

            <?php $styleNew = $row->status == "Em análise" ? 'badge rounded-pill bg-warning text-dark' : 'd-none'; ?>
            <span class="<?php echo $styleNew; ?>"><?php echo $row->status; ?></span>

            <?php $styleNew = $row->status == "Resolvida" ? 'badge rounded-pill bg-warning text-dark' : 'd-none'; ?>
            <span class="<?php echo $styleNew; ?>"><?php echo $row->status; ?></span>

            <?php $styleAnswer = $row->type == "Resposta" ? 'badge rounded-pill bg-warning text-dark' : 'd-none'; ?>
            <span class="<?php echo $styleAnswer; ?>"><?php echo $row->type; ?></span>

            <?php $styleAnswer = $row->type == "Pergunta" ? 'badge rounded-pill bg-info text-dark' : 'd-none'; ?>
            <span class="<?php echo $styleAnswer; ?>"><?php echo $row->type; ?></span>

            <?php $styleAnswer = $row->type == "Perfil" ? 'badge rounded-pill bg-primary text-dark' : 'd-none'; ?>
            <span class="<?php echo $styleAnswer; ?>"><?php echo $row->type; ?></span>

            <?php $styleContext = $row->context == "Denuncia acatada" ? 'badge rounded-pill bg-primary text-dark' : 'd-none'; ?>
            <span class="<?php echo $styleContext; ?>"><?php echo $row->context; ?></span>

            <?php $styleContext = $row->context == "Denuncia negada" ? 'badge rounded-pill bg-primary text-dark' : 'd-none'; ?>
            <span class="<?php echo $styleContext; ?>"><?php echo $row->context; ?></span>

            <p>
                Feito por
                <?php echo $row->creator; ?>
                <?php echo $row->surnameCreator; ?>
            </p>

            <p>
                Denunciado
                <?php echo $row->denounced; ?>
                <?php echo $row->surnameDenounced; ?>
            </p>

            <p>
                Motivo
                <?php echo $row->reason; ?>
            </p>

            <p>
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
                <a href="<?php echo $link; ?>" target="__blank"><?php echo $textButton; ?></a>
            </p>

            <form action="./controller/analysis-denunciation.controller.php?denunciationID=<?php echo $row->id; ?>" method="POST">
                <button type="submit" name="moveDenunciation">Mover para análise</button>
            </form>

            <hr>
        <?php } ?>

    </div>

    <div class="<?php echo $styleList; ?>">
        <!-- Tabs navs -->
        <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="ex1-tab-1" data-mdb-toggle="tab" href="#ex1-tabs-1" role="tab" aria-controls="ex1-tabs-1" aria-selected="true">Novas</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link " id="ex1-tab-2" data-mdb-toggle="tab" href="#ex1-tabs-2" role="tab" aria-controls="ex1-tabs-2" aria-selected="false">Em análise</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link " id="ex1-tab-3" data-mdb-toggle="tab" href="#ex1-tabs-3" role="tab" aria-controls="ex1-tabs-3" aria-selected="false">Resolvidas</a>
            </li>
        </ul>

        <!-- Tabs navs -->

        <!-- Tabs content -->
        <div class="tab-content" id="ex1-content">
            <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                <div id="message-new-list">

                    <!-- Contador de denuncias novas -->
                    <p>
                        <?php echo  $countNewDenunciations ?>
                    </p>

                    <!-- Denuncias novas -->
                    <?php for ($i = 0; $i < count($listNewDenunciations); $i++) {
                        $row = $listNewDenunciations[$i] ?>

                        <?php $styleNew = $row->status == "Nova" ? 'badge rounded-pill bg-warning text-dark' : 'd-none'; ?>
                        <span class="<?php echo $styleNew; ?>"><?php echo $row->status; ?></span>

                        <?php $styleAnswer = $row->type == "Resposta" ? 'badge rounded-pill bg-warning text-dark' : 'd-none'; ?>
                        <span class="<?php echo $styleAnswer; ?>"><?php echo $row->type; ?></span>

                        <?php $styleAnswer = $row->type == "Pergunta" ? 'badge rounded-pill bg-info text-dark' : 'd-none'; ?>
                        <span class="<?php echo $styleAnswer; ?>"><?php echo $row->type; ?></span>

                        <?php $styleAnswer = $row->type == "Perfil" ? 'badge rounded-pill bg-primary text-dark' : 'd-none'; ?>
                        <span class="<?php echo $styleAnswer; ?>"><?php echo $row->type; ?></span>

                        <p>
                            Feito por
                            <?php echo $row->creator; ?>
                        </p>

                        <p>
                            Denunciado
                            <?php echo $row->denounced; ?>
                        </p>

                        <p>
                            Motivo
                            <?php echo $row->reason; ?>
                        </p>

                        <p>
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
                            <a href="<?php echo $link; ?>" target="__blank"><?php echo $textButton; ?></a>
                        </p>

                        <form action="./controller/analysis-denunciation.controller.php?denunciationID=<?php echo $row->id; ?>" method="POST">
                            <button type="submit" name="moveDenunciation">Mover para análise</button>
                        </form>

                        <hr>
                    <?php } ?>

                </div>
            </div>

            <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                <div id="message-read-list">

                    <!-- Contador de denuncias em análise -->
                    <p>
                        <?php echo  $countAnalysisDenunciations ?>
                    </p>

                    <!-- Denuncias em análise -->
                    <?php for ($i = 0; $i < count($listAnalysisDenunciations); $i++) {
                        $row = $listAnalysisDenunciations[$i] ?>

                        <?php $styleNew = $row->status == "Em análise" ? 'badge rounded-pill bg-warning text-dark' : 'd-none'; ?>
                        <span class="<?php echo $styleNew; ?>"><?php echo $row->status; ?></span>

                        <?php $styleAnswer = $row->type == "Resposta" ? 'badge rounded-pill bg-warning text-dark' : 'd-none'; ?>
                        <span class="<?php echo $styleAnswer; ?>"><?php echo $row->type; ?></span>

                        <?php $styleAnswer = $row->type == "Pergunta" ? 'badge rounded-pill bg-info text-dark' : 'd-none'; ?>
                        <span class="<?php echo $styleAnswer; ?>"><?php echo $row->type; ?></span>

                        <?php $styleAnswer = $row->type == "Perfil" ? 'badge rounded-pill bg-primary text-dark' : 'd-none'; ?>
                        <span class="<?php echo $styleAnswer; ?>"><?php echo $row->type; ?></span>

                        <p>
                            Feito por
                            <?php echo $row->creator; ?>
                        </p>

                        <p>
                            Denunciado
                            <?php echo $row->denounced; ?>
                        </p>

                        <p>
                            Motivo
                            <?php echo $row->reason; ?>
                        </p>

                        <p>
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
                            <a href="<?php echo $link; ?>" target="__blank"><?php echo $textButton; ?></a>
                        </p>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $row->id; ?>">
                            Marcar como resolvida
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modal-<?php echo $row->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel-<?php echo $row->id; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel-<?php echo $row->id; ?>">Denúncia resolvida</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="./controller/resolve-denunciation.controller.php?denunciationID=<?php echo $row->id; ?>&questionID=<?php echo $row->questionId; ?>&answerId=<?php echo $row->answerId; ?>&type=<?php echo $row->type; ?>&denounced=<?php echo $row->denouncedId;?>" method="POST">
                                            <label for="">Contexto</label>
                                            <select class="form-select" aria-label="Default select example" name="context" data-select="<?php echo $row->id; ?>">
                                                <option selected>Selecione o contexto em que a denúncia se enquadra</option>
                                            </select>

                                            <br>

                                            <div>
                                                <p>
                                                    Conclusão
                                                </p>

                                                <div id="contentTextArea">
                                                    <textarea name="conclusion" id="about" cols="30" rows="10" placeholder="Faça uma breve conclusão sobre a denúncia" required onclick="colorDiv()"></textarea>
                                                    <div><span id="counterTextArea">250</span></div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary" name="resolveDenunciation">Mover</button>
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

            <div class="tab-pane fade" id="ex1-tabs-3" role="tabpanel" aria-labelledby="ex1-tab-3">
                <div id="message-read-list">

                    <!-- Contador de denuncias resolvidas -->
                    <p>
                        <?php echo  $countResolvedDenunciations ?>
                    </p>

                    <!-- Denuncias resolvidas -->
                    <?php for ($i = 0; $i < count($listResolvedDenunciations); $i++) {
                        $row = $listResolvedDenunciations[$i] ?>

                        <?php $styleNew = $row->status == "Resolvida" ? 'badge rounded-pill bg-warning text-dark' : 'd-none'; ?>
                        <span class="<?php echo $styleNew; ?>"><?php echo $row->status; ?></span>

                        <?php $styleAnswer = $row->type == "Resposta" ? 'badge rounded-pill bg-warning text-dark' : 'd-none'; ?>
                        <span class="<?php echo $styleAnswer; ?>"><?php echo $row->type; ?></span>

                        <?php $styleAnswer = $row->type == "Pergunta" ? 'badge rounded-pill bg-info text-dark' : 'd-none'; ?>
                        <span class="<?php echo $styleAnswer; ?>"><?php echo $row->type; ?></span>

                        <?php $styleAnswer = $row->type == "Perfil" ? 'badge rounded-pill bg-primary text-dark' : 'd-none'; ?>
                        <span class="<?php echo $styleAnswer; ?>"><?php echo $row->type; ?></span>

                        <?php $styleContext = $row->context == "Denuncia acatada" ? 'badge rounded-pill bg-primary text-dark' : 'badge rounded-pill bg-info text-dark'; ?>
                        <span class="<?php echo $styleContext; ?>"><?php echo $row->context; ?></span>

                        <p>
                            Feito por
                            <?php echo $row->creator; ?>
                        </p>

                        <p>
                            Denunciado
                            <?php echo $row->denounced; ?>
                        </p>

                        <p>
                            Motivo
                            <?php echo $row->reason; ?>
                        </p>

                        <p>
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
                            <a href="<?php echo $link; ?>" target="__blank"><?php echo $textButton; ?></a>
                        </p>

                        <p>
                            Conclusão
                            <?php echo $row->conclusion; ?>
                        </p>

                        <hr>
                    <?php } ?>

                </div>
            </div>
        </div>
        <!-- Tabs content -->
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
            const select = document.querySelectorAll('[data-select]');
            const dados = await fetch('./controller/getContexts.controller.php');

            const json_context = await dados.json();
            const convert_into_string = JSON.stringify(json_context);
            const object_context = JSON.parse(convert_into_string);

            array_contexts = object_context['contexts'];

            select.forEach(selectElement => {
                for (i = 0; i < array_contexts.length; i++) {
                    const optionElement = document.createElement("option");

                    optionElement.value = array_contexts[i]['id'];
                    optionElement.textContent = array_contexts[i]['name'];

                    selectElement.appendChild(optionElement);
                }
            });
        }());
    </script>
</body>

</html>