<?php 
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/solicitations/Solicitation.class.php');

$solicitation = new Solicitation();
$connection = Connection::connection();

$current_page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
$page = (!empty($current_page)) ? $current_page : 1;

if(!empty($page)){
    //Receber o numero de página
   
    
    //Setar a quantidade de registros por página
    $limit_result = 6;

    //Calcular o inicio da vizualização
    $start = ($limit_result * $page) - $limit_result;

    $result_register = $connection->prepare("SELECT COUNT(*) AS 'qtd' FROM solicitations 
                                        WHERE status = 'Nova'
                                        LIMIT $start, $limit_rsult");
    $result_register->execute();
    $qnt_register = $result_register->fetchALL(PDO::FETCH_ASSOC);
    // echo($qnt_register[0]['qtd']);
    $page_qnt = ceil($qnt_register[0]['qtd'] / $limit_result);

    $prev_page = $page - 1;

    $next_page = $page + 1;

    $dados = "<ul class='pagination'>";

        //$dados .= "<ul class='pagination'>";

        //botão para voltar
        if ($prev_page != 0) { 
            $dados .= "<li class='page-item'><a class='page-link pagination-last normal-14-medium-p' href='#' onclick='pagination($prev_page)' tabindex='-1' aria-disabled='true'>Anterior</a></li>";
            } else { 
            $dados .= "<li class='page-item disabled'><a class='page-link disable pagination-last normal-14-medium-p' href='#' tabindex='-1' aria-disabled='true'>Anterior</a></li>";
        }

        //Apresentar a paginação
        for ($i = 0; $i < $page_qnt ; $i++) { 
            $j = $i + 1;
            $dados .= "<li class='page-item'><a class='page-link pagination-page normal-14-medium-p' href='#' onclick='pagination($j)'> $j </a></li>";
        }
            
        //botão para avançar
        if ($next_page <= $page_qnt) {
            $dados .= "<li class='page-item'><a class='page-link pagination-next normal-14-medium-p' href='#' onclick='pagination($next_page)' tabindex='-1' aria-disabled='true'>Próximo</a></li>";
            } else { 
            $dados .= "<li class='page-item disabled'><a class='page-link disable pagination-next normal-14-medium-p' href='#' tabindex='-1' aria-disabled='true'>Próximo</a></li>";
        }
    $dados .= "</ul>";

    echo ($dados);
}else{
    echo json_encode("teste");
}
