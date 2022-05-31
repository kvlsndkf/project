<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro administrador | Heelp!</title>

    <link rel="stylesheet" href="../../../styles/colors.style.css">
    <link rel="stylesheet" href="../../../styles/style.global.css">
    <link rel="stylesheet" href="../../../styles/fonts.style.css">
    <link rel="stylesheet" href="../../../style/form-update-teacher.style.css">
    <link rel="stylesheet" href="../../../../private/style/form-update-teacher.style.css">
    <link rel="shortcut icon" href="../../../images/favicon/favicon-16x16.png" type="image/x-icon">
</head>

<body>
    <div class="my-container">
        <div class="page-container">
            <div class="form-base bg-modal-gray">
                <div class="form-header">
                    <label class="normal-20-bold-modaltitle title-header">Cadastro administrador</label>
                </div>
                <form action="./controller/register-adm.controller.php" method="post">
                    <p class="normal-14-medium-p name">
                        Email
                        <input class="input-text normal-12-regular-tinyinput input-name-administrator" type="text" name="email" id="name" placeholder="ex.: adm@help.com.br" required autocomplete="off" autofocus minlength="5">
                    </p>

                    <p class="normal-14-medium-p name">
                        Senha
                        <input class="input-text normal-12-regular-tinyinput input-name-administrator" type="password" name="password" placeholder="Digite a senha" required minlength="6">
                    </p>

                    <p class="normal-14-medium-p name">
                        Confirmar senha
                        <input class="input-text normal-12-regular-tinyinput input-name-module" type="password" name="password-confirm" placeholder="Confirme a senha" required minlength="6">
                    </p>

                    <p>
                        <button type="submit" name="register" class="register normal-14-bold-p">Cadastrar</button>
                        <button type="reset" class="clean normal-14-bold-p">Limpar</button>
                    </p>
                </form>
            </div>
        </div>
    </div>

</body>

</html>