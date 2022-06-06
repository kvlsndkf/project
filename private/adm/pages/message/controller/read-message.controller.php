<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/messages/Message.class.php');

session_start();

if (isset($_POST['readMessage'])) {
    $message = new Message();

    $id = $_GET['messageID'];

    $message->setStatus(false);
    $message->readingTheMessage($message, $id);
}
