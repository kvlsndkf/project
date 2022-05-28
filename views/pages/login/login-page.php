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

    <script src="./validacao.js" defer></script>
    <link rel="shortcut icon" href="../../images/./logo/logo-help.svg" type="image/x-icon">
    <title>Heelp!</title>

</head>

<body class="body">

    <div class="formg">

        <div class="container container2">
            <form action="#" class="form">
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
                            <input  required type="email" id="eemail" class="input email" placeholder="email@email.com" name="email" autocomplete="off">
                            <span id="message-aluno" class="error normal-14-medium-p"> E-mail institucional inválido</span>
                            <span id="message-adm" class="error normal-14-medium-p"> E-mail de administrador inválido</span>
                            <span id="message-antes" class="error normal-14-medium-p"> E-mail inválido</span>
                            
                        </div>


                        <h6 class="normal-14-medium-p inputPass">Senha</h6>
                        <div class="input-box">
                            <input required type="password" id="senha" class="input senha" placeholder="********" minlength="6" autocomplete="off">
                           
                        </div>

                        <div class="button-enter">
                            <a href="#"><button class="botao-g normal-14-regular-p bt" id="botao" onclick="buttonDisable()" >Entrar</button></a>
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
</body>

</html>