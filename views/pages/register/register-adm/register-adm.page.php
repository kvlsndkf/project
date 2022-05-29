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
</head>
<body>
    <label for="">Cadastro administrador</label>
    <form action="./controller/register-adm.controller.php" method="post">
        <p>
            <label for="">Email</label>
            <input type="email" name="email" id="email" placeholder="ex.: adm@help.com.br" autocomplete="off" required>
        </p>

        <p>
            <label for="">Senha</label>
            <input type="password" name="password" placeholder="Digite a senha" required>
        </p>

        <p>
            <label for="">Confirmar senha</label>
            <input type="password" name="password-confirm" placeholder="Confirme a senha" required>
        </p>

        <input type="submit" value="Cadastrar" name="register">
        <input type="reset" value="Limpar">
    </form>
</body>
</html>