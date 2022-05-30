<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/messages/Message.class.php');

if(isset($_POST['register'])){
    $mensagem = new Message();
    $mensagem->setContact($_POST['contact']);
    $mensagem->setMessage($_POST['message']);
    $mensagem->setStatus(true);
 
    $mensagem->registerMessage($mensagem);

   

}

