<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/messages/Message.class.php');

$message = new Message();

$countReadMessages = $message->countReadMessages();
$countNewMessages = $message->countNewMessages($search);

$listNewMessages = $message->listNewMessage($search);
$listReadMessages = $message->listReadMessage();

// $listMessagesOfSearch = $message->listMessagesOfSearchBar();

$dados = "";

// <!-- Contador  de mensagens novas -->
$dados .= "<p class='contador-prof normal-18-black-title-2'>";
    $dados .=$countNewMessages;
$dados .= "</p>";

$dados .= "<br>";

// <!-- Lista de mensagens novas -->
$dados .= "<div class='list-prof'>";

   for ($i = 0; $i < count($listNewMessages); $i++) {
    $row = $listNewMessages[$i]; 

    $dados .= "<div class='card-contact'>";

    $style = $row->status == "Nova" ? 'badge rounded-pill bg-warning text-dark' : 'badge rounded-pill bg-info'; 
    $dados .= "<span class=' $style '>  $row->status </span>";

    $dados .= "<p class='contato-message normal-14-medium-p'>";
        $dados .= "Contato";
    $dados .="</p>";

    $dados .="<p class='prof-text school-name normal-14-bold-p'>";
        $dados .=$row->contact; 
    $dados .="</p>";

    $dados .= "<p class='contato-message normal-14-medium-p'>";
        $dados .= "Mensagem";
    $dados .= "</p>";
    $dados .= "<p class='prof-text line-clamp-2 message-text school-name normal-14-bold-p' id='messageText-newMessages-$row->id'>";
        $dados .=$row->message; 
    $dados .= "</p>";

    $dados .= "<button class='read-btn normal-14-bold-p' id='readMore-newMessages-$row->id' 
      onclick='document.querySelector('#messageText-newMessages-$row->id').classList.remove('line-clamp-2');
      document.querySelector('#readLess-newMessages-$row->id').style.display = 'inline';
      document.querySelector('#readMore-newMessages-$row->id').style.display = 'none''>
        Ler mais...
      </button>";

    $dados .= "<button class='read-btn normal-14-bold-p' id='readLess-newMessages-$row->id'
      onclick='document.querySelector('#messageText-newMessages-  $row->id; ').classList.add('line-clamp-2');
      document.querySelector('#readLess-newMessages-$row->id').style.display = 'none'
      document.querySelector('#readMore-newMessages-$row->id').style.display = 'inline''>
        Ler menos...
      </button>";


    ?>
    <script>

        var messageNew = document.getElementById('messageText-newMessages-  $row->id; ');

        var readMoreNew = document.getElementById('readMore-newMessages-  $row->id; ');
        var readLessNew = document.getElementById('readLess-newMessages-  $row->id; ');

        //se o tamanho da mensagem passar o tamanho da caixa de texto, ou seja, com mais de 2 linhas
        if (messageNew.scrollHeight > messageNew.offsetHeight) {

          // Se ele estiver com o ..., precisa ter o "ler mais"
          if (messageNew.classList.contains("line-clamp-2")) {
            readMoreNew.style.display = "inline";
            readLessNew.style.display = "none";
          }

          //se o texto nao tem mais de 2 linhas, nao precisa ter botão
        } else {
          readLessNew.style.display = "none";
          readMoreNew.style.display = "none";
        }

      </script>
<?php
    $styleButton = $row->status == "Nova" ? '' : 'd-none'; 
    $dados .= "<form action='./controller/read-message.controller.php?messageID=$row->id'  class='  $styleButton ' method='POST'>";
        $dados .="<button type='submit' name='readMessage' class='read-button sidebar-button-a normal-14-bold-p'>";
        $dados .="<div class='sidebar-button margin-0'>";
        $dados .="<p class='sidebar-button-text'>Marcar como lida</p>";
        $dados .="</div>";
        $dados .="</button>";

    $dados .="</form>";

    $dados .="</div>";

   } 