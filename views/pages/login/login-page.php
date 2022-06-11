<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../styles/fonts.style.css">
    <link rel="stylesheet" href="../../styles/style.global.css">
    <link rel="stylesheet" href="./css-login/login-style.css">
    <link rel="stylesheet" href="../../styles/input.style.css">
    <link rel="stylesheet" href="../../styles/button.style.css">
    <link rel="stylesheet" href="./css-login/valid-login.css">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="./validacao.js" defer></script>
    <link rel="shortcut icon" href="../../images/./logo/logo-help.svg" type="image/x-icon">
    <title>Login | Heelp!</title>

</head>

<body class="body">

    <div class="formg">

        <div class="container container2">
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
                <br>
            <?php unset($_SESSION['statusNegative']);
            } ?>

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
                <br>
            <?php unset($_SESSION['statusPositive']);
            } ?>

            <!-- Mensagem de sucesso Solicitação ⬇️ -->
            <?php if (isset($_SESSION['statusCompleted']) && $_SESSION != '') { ?>

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
                        <strong>Obrigado por nos informar!</strong>
                        <?php echo $_SESSION['statusCompleted']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                <br>
            <?php unset($_SESSION['statusCompleted']);
            } ?>

            <form action="./controller/login.controller.php" class="form" method="POST">
                <div class="voltar">
                    <div>
                        <a class="" href="../../../views/landing-page/landing-page.php">
                            <img src="../../images/./components/seta-voltar.svg" alt="">
                        </a>
                    </div>
                </div>

                <div class="form-header">
                    <div class="titleg">
                        <h6 class="normal-20-bold-modaltitle">
                            Bem vindo de volta!
                        </h6>
                    </div>

                    <div class="grupo-form">
                        <h6 class="normal-16-bold-title-3 inputEmail">Email</h6>
                        <div class="input-box">
                            <input required type="email" id="eemail" class="input email" placeholder="email@email.com" name="email" autocomplete="off">
                            <span id="message-aluno" class="error normal-14-medium-p"> E-mail institucional inválido</span>
                            <span id="message-adm" class="error normal-14-medium-p"> E-mail de administrador inválido</span>
                            <span id="message-antes" class="error normal-14-medium-p"> E-mail inválido</span>

                        </div>

                        <h6 class="normal-14-medium-p inputPass">Senha</h6>
                        <div class="input-box">
                            <input required type="password" id="senha" class="input senha" placeholder="********" minlength="6" name="password" autocomplete="off">
                        </div>

                        <div class="button-enter">
                            <button type="submit" name="login" class="botao-g normal-14-regular-p bt" id="botao" onclick="validarEmail(event)">Entrar</button>
                        </div>
                    </div>
                    <div class="criar-conta">
                        <h6 class="normal-14-medium-p final">Novo por aqui? <a href="../register/register-profile/register-profile.pages.php" class="normal-14-medium-p link"> Crie uma conta!</a></h6>
                    </div>
                </div>
            </form>
        </div>
    </div>











    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->
    <!-- JS Bootstrap ⬇️ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>