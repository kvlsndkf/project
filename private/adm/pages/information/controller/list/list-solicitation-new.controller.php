<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/solicitations/Solicitation.class.php');

$solicitation = new Solicitation();
$connection = Connection::connection();

$search = $_GET['searchSolicitation'] ?? '';

$listNewSolicitation = $solicitation->listNewSolicitation($search);
$countNewSolicitation = $solicitation->countNewSolicitation($search);

if(empty($search)){
    $dados = "";
    
    //Contador  de mensagens novas
    $dados .=  $countNewSolicitation; 

    $dados.= "<br/>";

    //Lista de mensagens novas
    for ($i = 0; $i < count($listNewSolicitation); $i++) {
        $row = $listNewSolicitation[$i];

        $style = $row->status == 'Nova' ? 'badge rounded-pill bg-warning text-dark' : 'badge rounded-pill bg-info'; 
        $dados .= "<span class=' $style'> $row->status </span>";

        $dados .= "<p>";
            $dados .= "Contato";
            $dados .="<br>";
            $dados .=$row->contact; 
        $dados .= "</p>";

        $dados .= "<p>";
            $dados .= "Categoria";
            $dados .= "<br>";
            $dados .= $row->category; 
        $dados .="</p>";

        $dados .= "<p>";
            $dados .="Titulo";
            $dados .= "<br>";
            $dados .= $row->title; 
        $dados .="</p>";

        $dados .="<p>";
            //Descrição
            $dados .= $row->description; 
        $dados .="</p>";

        $dados .= $styleButton = $row->status == "Nova" ? '' : 'd-none'; 
        $dados .= "<form id='register' action='./controller/analysis-solicitation.controller.php?solicitationNewID= $row->id ' class=' $styleButton' method='POST'>";
            $dados .= "<button type='submit' name='analysisRequest'>Mover para análise e adicionar informação</button>"; 
        $dados .="</form>";

        $dados .="<hr>";
    }
      
    echo($dados);

}
?>