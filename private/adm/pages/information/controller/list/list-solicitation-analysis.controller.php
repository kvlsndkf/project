<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/solicitations/Solicitation.class.php');

$solicitation = new Solicitation();
$connection = Connection::connection();

$listAnalysisSolicitation = $solicitation->listAnalysisSolicitation();
$countAnalysisSolicitation = $solicitation->countAnalysisSolicitation();

$dados = "";

//Contador  de mensagens lidas
$dados .=  $countAnalysisSolicitation;

$dados .= "<br>";

//Lista de mensagens lidas
for ($i = 0; $i < count($listAnalysisSolicitation); $i++) {
    $row = $listAnalysisSolicitation[$i];

    $style = $row->status == "Análise" ? 'badge rounded-pill bg-info' : 'd-none';
    $dados .= "<span class=' $style'> $row->status </span>";

    $dados .= "<p>";
    $dados .= "Contato";
    $dados .= "<br>";
    $dados .= $row->contact;
    $dados .= "</p>";

    $dados .= "<p>";
    $dados .= "Categoria";
    $dados .= "<br>";
    $dados .= $row->category;
    $dados .= "</p>";

    $dados .= "<p>";
    $dados .= "Titulo";
    $dados .= "<br>";
    $dados .= $row->title;
    $dados .= "</p>";

    $dados .= "<p>";
    // Descrição
    $dados .= $row->description;
    $dados .= "</p>";

    $dados .= $styleButton = $row->status == "Análise" ? '' : 'd-none';

    $dados .= "<button type='submit' id='$row->id' name='concluidSolicitation' data-bs-toggle='modal' data-bs-target='#forms-modal'>Marcar como concluida e enviar email de aviso</button>";
    $dados .= "<hr>";

    // <!-- Modal -->
    $dados .= "<div class='modal fade' id='Modal-$row->id' tabindex='-1' aria-labelledby='ModalLabel-$row->id' aria-hidden='true'>";
        $dados .= "<div class='modal-dialog'>";
            $dados .= "<div class='modal-content'>";
                $dados .= "<div class='modal-header'>";
                $dados .= "<h2 class='modal-title' id='exampleModalLabel'> Solicitação resolvida </h2>";
                $dados .= "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
        $dados .= "</div>";
        $dados .= "<div class='modal-body'>";
            $dados .= "<form class='row g-3 needs-validation' action='./controller/resolved-solicitation.controller.php?idSolicitation=$row->id ?>' method='POST' enctype='multipart/form-data' class=' $styleButton'>";
                $dados .= "<div class='mb-3'>";
                    $dados .= "<select class='form-select' aria-label='Default select example' name='context_id' id='context_id' required>";
                    $dados .= "<option value=''>Selecione o Contexto</option>'";
                    $dados .= "</select>";
                $dados .= "</div>";
                $dados .= "<div class='mb-3'>";
                    $dados .= "<label for='exampleFormControlTextarea1' class='form-label'>Conclusão</label>";
                        $dados .= "<div id='contentTextArea'><textarea name='conclusion' id='conclusion' class='form-control' cols='30' rows='10' placeholder='Conclusão' onclick='colorDiv()' maxlength='200' required></textarea></div>";
                            $dados .= "<div>";
                                $dados .= "<span id='counterTextArea'>200</span>";
                            $dados.= "</div>";
                        $dados .= "<hr>";
                    $dados .= "</div>";
                $dados .= "<div class='col-12'>";
                    $dados .= "<input class='btn btn-primary' type='submit' value='Enviar' name='register' id='register'></input>";
                    $dados .= "<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Fechar</button>";
                $dados .= "</div>";
            $dados .= "</form>";
        $dados .= "</div>";
$dados .= "</div>";
$dados .= "</div>";
$dados .= " </div>";
}

echo ($dados);
?>




