<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/solicitations/Solicitation.class.php');

$solicitation = new Solicitation();
$connection = Connection::connection();

$listAnalysisSolicitation = $solicitation->listAnalysisSolicitation();
$countAnalysisSolicitation = $solicitation->countAnalysisSolicitation();

$dados = "";
    //Contador  de mensagens lidas
    $dados .=  $countAnalysisSolicitation ;

    $dados .= "<br>";

    //Lista de mensagens lidas
    for ($i = 0; $i < count($listAnalysisSolicitation); $i++) {
        $row = $listAnalysisSolicitation[$i];

        $style = $row->status == "Análise" ? 'badge rounded-pill bg-info' : 'd-none'; 
        $dados .= "<span class=' $style'> $row->status </span>";

        $dados .="<p>";
            $dados .= "Contato";
            $dados .="<br>";
            $dados .= $row->contact; 
        $dados .="</p>";

        $dados .="<p>";
            $dados .= "Categoria";
            $dados .="<br>";
            $dados .= $row->category; 
        $dados .="</p>";

        $dados .="<p>";
            $dados .="Titulo";
            $dados .="<br>";
            $dados .= $row->title; 
        $dados .="</p>";

        $dados .="<p>";
            // Descrição
            $dados .= $row->description; 
        $dados .="</p>";

        $dados .= $styleButton = $row->status == "Análise" ? '' : 'd-none'; 

        $dados .= "<button type='submit' name='concluidSolicitation' data-bs-toggle='modal' data-bs-target='#exampleModal'>Marcar como concluida e enviar email de aviso</button>";
        $dados .="<hr>";
    } 

    echo ($dados);