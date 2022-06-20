<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/solicitations/Solicitation.class.php');

$solicitation = new Solicitation();
$connection = Connection::connection();

$listResolvedSolicitation = $solicitation->listResolvedSolicitation();
$countResolvedSolicitation = $solicitation->countResolvedSolicitation();

$dados = "";

    // Contador  de mensagens lidas 
    $dados .=  $countResolvedSolicitation;

    $dados .= "<br>";

    // Lista de mensagens lidas ⬇️ 
    for ($i = 0; $i < count($listResolvedSolicitation); $i++) {
        $row = $listResolvedSolicitation[$i];

        $style = $row->status == "Resolvida" ? 'badge rounded-pill bg-info' : 'd-none'; 
        $dados .= "<span class=' $style '>$row->status </span>";

        $style = $row->context == "Solicitação acatada" ? 'badge rounded-pill bg-info' : 'd-none'; 
        $dados .= "<span class='$style '>$row->context </span>";

        $dados .="<p>";
            $dados .="Contato";
            $dados .="<br>";
            $dados .= $row->contact; 
        $dados .="</p>";

        $dados .="<p>";
            $dados .="Categoria";
            $dados .="<br>";
            $dados .=$row->category; 
        $dados .="</p>";

        $dados .= "<p>";
            $dados .="Titulo";
            $dados .="<br>";
            $dados .=$row->title; 
        $dados .="</p>";

        $dados .="<p>";
            // Descrição
            $dados .= $row->description; 
        $dados .="</p>";

        $dados .="<hr>";
        $dados .="<p>";
            $dados .="Conclusão";
            $dados .="<br>";
            $dados .=$row->conclusion; 
        $dados .="</p>";
        $dados .="<hr>";
    }

    echo ($dados);
?>
