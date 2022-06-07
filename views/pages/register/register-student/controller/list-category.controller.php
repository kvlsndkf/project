<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');

$connection = Connection::connection();
            
$query_sits = "SELECT id, name FROM solicitationCategory ORDER BY id";
$result_sits = $connection->prepare($query_sits);
$result_sits->execute();

if(($result_sits) and ($result_sits->rowCount() != 0)){
    while($row_sits = $result_sits->fetch(PDO::FETCH_ASSOC)){
        extract($row_sits);
        $dados[] = [
            'id' => $id,
            'name' => $name,
        ];
    }
    $return = ['status'=> true, 'dados' => $dados];
}else{
    $return = ['status'=> true, 'dados' => $dados];
}


echo json_encode($return);







