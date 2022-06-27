<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-administrator.controller.php');
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/messages/Message.class.php');

try {
  $search = $_GET['searchMessage'] ?? '';
  $message = new Message();

  $listNewMessages = $message->listNewMessage($search);
  $listReadMessages = $message->listReadMessage();

  $listMessagesOfSearch = $message->listMessagesOfSearchBar();

  $countReadMessages = $message->countReadMessages();
  $countNewMessages = $message->countNewMessages($search);

  $optionOfSearchMessage = array();
  foreach ($listMessagesOfSearch as $row) {
    $optionOfSearchMessage[] = array(
      'label' => $row->message,
      'value' => $row->message
    );
  }
} catch (Exception $e) {
  echo $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <!-- Base -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fale Conosco | Heelp!</title>
  <link rel="icon" href="../../../../views/images/favicon/favicon-32x32.png" type="image/icon type">

  <!-- CSS Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- CSS MdBootstrap -->
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css" rel="stylesheet" />

  <!-- CSS Search Bar -->
  <link rel="stylesheet" href="../../../../style/search-bar.style.css">

  <!-- Estilos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <link rel="stylesheet" href="../../../../views/styles/colors.style.css">
  <link rel="stylesheet" href="../../../../views/styles/style.global.css">
  <link rel="stylesheet" href="../../../../views/styles/fonts.style.css">
  <link rel="stylesheet" href="../register/registration panel/registration-panel-style.css">
  <link rel="stylesheet" href="../register/register.styles.css">
  <link rel="stylesheet" href="../../../style/modal-delete-teacher.style.css">
  <link rel="stylesheet" href="../../../style/button-delete-course.style.css">

</head>

<body>

  <!-- Inicio Wrapper -->
  <div class="wrapper">

    <!-- NavBar Lateral - SideBar -->
    <nav class="sidebar">

      <!-- Logo Heelp! -->
      <a href="#" class="logo-heelp">
        <img src="../../../../views/images/logo/logo-help.svg" alt="" class="logo-heelp-img">
        <h4 class="logo-heelp-text normal-22-black-title-1">heelp!</h4>
      </a>

      <!-- Texto nº2 para Responsividade -->
      <div class="respo-cabe">
        <a href="../register/registration panel/registration-panel-page.php" class="seta-voltar-a seta-voltar-a-responsividade">
          <img src="../../../../views/images/components/arrow-back.svg" class="seta-voltar-img">
        </a>
        <p class="add-info-text add-info-text-responsividade normal-22-black-title-1">Fale Conosco </p>
      </div>

      <!-- Menu Sanduíche da Responsividade -->
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
      </label>



      <!-- Conteúdo Navbar -->
      <ul class="sidebar-ul">

        <!-- Logo Heelp! do Responsivo -->
        <li class="sidebar-li sidebar-li-logo">
          <a href="#" class="logo-heelp-responsividade">
            <img src="../../../../views/images/logo/logo-help.svg" alt="" class="logo-heelp-img">
            <h4 class="logo-heelp-text normal-22-black-title-1">heelp!</h4>
          </a>
        </li>

        <!-- Opções da NavBar -->
        <li class="sidebar-li">
          <a href="../register/registration panel/registration-panel-page.php" class="sidebar-button-a normal-14-bold-p">
            <div class="sidebar-button">
              <p class="sidebar-button-text">Adicionar Informações +</p>
            </div>
          </a>
        </li>

        <li class="sidebar-li">
          <a href="../dashboard/dashboard.page.php" class="sidebar-a-items">
            <img class="sidebar-img" src="../../../../views/images/components/dashboard-img.svg" alt="">
            <p class="sidebar-option normal-18-bold-title-2">Dashboard</p>
          </a>
          <hr class="sidebar-linha">
        </li>

        <li class="sidebar-li">
          <p class="sidebar-categoria normal-14-bold-p">Mensagens</p>
          <a href="../denunciation/list-denunciation.page.php" class="sidebar-a">
            <img class="sidebar-img" src="../../../../views/images/components/denuncia-img.svg" alt="">
            <p class="sidebar-option normal-18-bold-title-2">Denuncias</p>
          </a>
        </li>

        <li class="sidebar-li">
          <a href="../message/list-message.page.php" class="sidebar-a-items">
            <img class="sidebar-img" src="../../../../views/images/components/fale-conosco-current.svg" alt="">
            <p class="sidebar-option sidebar-current-option normal-18-bold-title-2">Fale Conosco</p>
          </a>
        </li>

        <li class="sidebar-li">
          <p class="sidebar-categoria normal-14-bold-p">Contas</p>
          <a href="#" class="sidebar-a">
            <img class="sidebar-img" src="../../../../views/images/components/listagem-img.svg" alt="">
            <p class="sidebar-option normal-18-bold-title-2">Listagem</p>
          </a>
          <hr class="sidebar-linha">
        </li>

        <li class="sidebar-li">
          <a href="../../../logout/logout.controller.php" class="sidebar-a-items2">
            <img class="sidebar-img" src="../../../../views/images/components/sair-img.svg" alt="">
            <p class="sidebar-option normal-18-bold-title-2">Sair</p>
          </a>
        </li>

      </ul>

    </nav>

    <!-- Corpo -->
    <div class="corpo">

      <div class="cabecalho">
        <a href="../register/registration panel/registration-panel-page.php" class="seta-voltar-a">
          <img src="../../../../views/images/components/arrow-back.svg" class="seta-voltar-img">
        </a>
        <p class="add-info-text normal-22-black-title-1">Fale Conosco</p>
      </div>

      <!-- Parte Branca -->
      <div class="conteudo">


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
        <form action="./list-message.page.php" method="GET" class="">
          <input type="text" name="searchMessage" id="searchMessage" placeholder="Pesquise por mensagens" autocomplete="off" class="search-bar margin-top-0">
          <input type="submit" value="🔎" class="search-button margin-top-0">
        </form>

        <!-- Tabs navs -->
        <ul class="nav nav-tabs mb-3 tab-ul" id="ex1" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link active tab-a" id="ex1-tab-1" data-mdb-toggle="tab" href="#ex1-tabs-1" role="tab" aria-controls="ex1-tabs-1" aria-selected="true">
              <p class="normal-14-bold-p tab-p">
                Novas
              </p>
            </a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link tab-a" id="ex1-tab-2" data-mdb-toggle="tab" href="#ex1-tabs-2" role="tab" aria-controls="ex1-tabs-2" aria-selected="false">
              <p class="normal-14-bold-p tab-p">
                Lidas
              </p>
            </a>
          </li>
        </ul>

        <!-- Tabs navs -->

        <!-- Tabs content -->
        <div class="tab-content" id="ex1-content">
          <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
            <div id="message-new-list">

              <!-- Contador  de mensagens novas -->
              <p class="contador-prof normal-18-black-title-2">
                <?php echo  $countNewMessages ?>
              </p>

              <br>

              <!-- Lista de mensagens novas -->
              <div class="list-prof">

                <?php for ($i = 0; $i < count($listNewMessages); $i++) {
                  $row = $listNewMessages[$i] ?>

                  <div class="card-contact">

                    <?php $style = $row->status == "Nova" ? 'badge rounded-pill bg-warning text-dark' : 'badge rounded-pill bg-info'; ?>
                    <span class="<?php echo $style; ?>"><?php echo $row->status; ?></span>

                    <p class="contato-message normal-14-medium-p">
                      Contato
                    </p>
                    <p class="prof-text school-name normal-14-bold-p">
                      <?php echo $row->contact; ?>
                    </p>

                    <p class="contato-message normal-14-medium-p">
                      Mensagem
                    </p>
                    <p class="prof-text line-clamp-2 message-text school-name normal-14-bold-p" id="messageText-newMessages-<?php echo $row->id; ?>">
                      <?php echo $row->message; ?>
                    </p>

                    <button class="read-btn normal-14-bold-p" id="readMore-newMessages-<?php echo $row->id; ?>" onclick="document.querySelector('#messageText-newMessages-<?php echo $row->id; ?>').classList.remove('line-clamp-2');
                    document.querySelector('#readLess-newMessages-<?php echo $row->id; ?>').style.display = 'inline';
                    document.querySelector('#readMore-newMessages-<?php echo $row->id; ?>').style.display = 'none';">
                      Ler mais...
                    </button>

                    <button class="read-btn normal-14-bold-p" id="readLess-newMessages-<?php echo $row->id; ?>" onclick="document.querySelector('#messageText-newMessages-<?php echo $row->id; ?>').classList.add('line-clamp-2');
                    document.querySelector('#readLess-newMessages-<?php echo $row->id; ?>').style.display = 'none';
                    document.querySelector('#readMore-newMessages-<?php echo $row->id; ?>').style.display = 'inline';">
                      Ler menos...
                    </button>


                    <!-- JS Read More Text -->
                    <script>
                      var messageNew = document.getElementById('messageText-newMessages-<?php echo $row->id; ?>');

                      var readMoreNew = document.getElementById('readMore-newMessages-<?php echo $row->id; ?>');
                      var readLessNew = document.getElementById('readLess-newMessages-<?php echo $row->id; ?>');

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

                    <?php $styleButton = $row->status == "Nova" ? '' : 'd-none'; ?>
                    <form action="./controller/read-message.controller.php?messageID=<?php echo $row->id; ?>" class="<?php echo $styleButton; ?>" method="POST">
                      <button type="submit" name="readMessage" class="read-button sidebar-button-a normal-14-bold-p">
                        <div class="sidebar-button margin-0">
                          <p class="sidebar-button-text">Marcar como lida</p>
                        </div>
                      </button>

                    </form>

                  </div>

                <?php } ?>

              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
            <div id="message-read-list">

              <!-- Contador  de mensagens lidas -->
              <p class="contador-prof normal-18-black-title-2">
                <?php echo  $countReadMessages ?>
              </p>

              <br>

              <div class="list-prof">

                <!-- Lista de mensagens lidas ⬇️ -->
                <?php for ($i = 0; $i < count($listReadMessages); $i++) {
                  $row = $listReadMessages[$i] ?>

                  <div class="card-contact">

                    <?php $style = $row->status == "Lida" ? 'badge rounded-pill bg-info' : 'd-none'; ?>
                    <span class="<?php echo $style; ?>"><?php echo $row->status; ?></span>

                    <p class="contato-message normal-14-medium-p">
                      Contato
                    </p>
                    <p class="prof-text school-name normal-14-bold-p">
                      <?php echo $row->contact; ?>
                    </p>

                    <p class="contato-message normal-14-medium-p">
                      Mensagem
                    </p>
                    <p class="prof-text line-clamp-2 message-text school-name normal-14-bold-p" id="messageText-readMessages-<?php echo $row->id; ?>">
                      <?php echo $row->message; ?>
                    </p>

                    <button class="read-btn normal-14-bold-p" id="readMore-readMessages-<?php echo $row->id; ?>" onclick="document.querySelector('#messageText-readMessages-<?php echo $row->id; ?>').classList.remove('line-clamp-2');
                    document.querySelector('#readLess-readMessages-<?php echo $row->id; ?>').style.display = 'inline';
                    document.querySelector('#readMore-readMessages-<?php echo $row->id; ?>').style.display = 'none';">
                      Ler mais...
                    </button>

                    <button class="read-btn normal-14-bold-p" id="readLess-readMessages-<?php echo $row->id; ?>" onclick="document.querySelector('#messageText-readMessages-<?php echo $row->id; ?>').classList.add('line-clamp-2');
                    document.querySelector('#readLess-readMessages-<?php echo $row->id; ?>').style.display = 'none';
                    document.querySelector('#readMore-readMessages-<?php echo $row->id; ?>').style.display = 'inline';">
                      Ler menos...
                    </button>

                    <!-- JS Read More Text -->
                    <script>
                      var messageRead = document.getElementById('messageText-readMessages-<?php echo $row->id; ?>');

                      var readMoreRead = document.getElementById('readMore-readMessages-<?php echo $row->id; ?>');
                      var readLessRead = document.getElementById('readLess-readMessages-<?php echo $row->id; ?>');

                      if (messageRead.scrollHeight > messageRead.offsetHeight) {

                        // Se ele estiver com o ..., precisa ter o "ler mais"
                        if (messageRead.classList.contains("line-clamp-2")) {
                          readMoreRead.style.display = "inline";
                          readLessRead.style.display = "none";
                        }

                      } else {
                        readLessRead.style.display = "none";
                      }
                    </script>

                  </div>

                <?php } ?>
              </div>
            </div>
          </div>
        </div>
        <!-- Tabs content -->

      </div>
    </div>
    <!-- Fim Wrapper -->
  </div>

  <!-- JS Bootstrap ⬇️ -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!-- JS Search bar -->
  <script src="../js/autocomplete.js"></script>

  <!-- JS Search bar ⬇️ -->
  <script>
    const field = document.getElementById('searchMessage');
    const acc = new Autocomplete(field, {
      data: <?php echo json_encode($optionOfSearchMessage); ?>,
      maximumItems: 8,
      treshold: 1,
    });
  </script>

  <!-- MDB -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>

</body>

</html>