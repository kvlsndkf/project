<?php
require_once('/xampp/htdocs' . '/project/classes/cookies/Cookie.class.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados da conta | Heelp!</title>
</head>

<body>
    <a href="../register-profile/register-profile.pages.php">Voltar</a>
    <br>
    <br>
    <label for="">Etapa 1/4</label>
    <br>
    <br>
    <form action="./controller/student-cookie.controller.php" method="post">
        <div>
            <label>Email</label>
            <br>
            <?php $emailCookie =  !is_null(Cookie::reader('email')) ? Cookie::reader('email') : ''; ?>
            <input type="email" name="email" id="email" placeholder="email institucional" required value="<?php echo $emailCookie; ?>" autocomplete="off" autofocus>
        </div>
        <br>
        <br>
        <div>
            <label for="">Senha</label>
            <br>
            <?php $passwordCookie =  !is_null(Cookie::reader('password')) ? Cookie::reader('password') : ''; ?>
            <input type="password" name="password" id="password" placeholder="senha" required value="<?php echo $passwordCookie; ?>">
            <img src="../../../images/components/opened-eye-password.svg" alt="" id="eyeOpened" onclick="openEye()">
        </div>
        <br>
        <br>
        <div>
            <label for="">Confirme a senha</label>
            <br>
            <?php $confirmPasswordCookie =  !is_null(Cookie::reader('confirm-password')) ? Cookie::reader('confirm-password') : ''; ?>
            <input type="password" name="confirm-password" id="confirm-password" placeholder="confirme a sua senha" required value="<?php echo $confirmPasswordCookie; ?>">
        </div>
        <br>
        <br>
        <input type="submit" value="Continuar" name="step1">
    </form>

    <script src="../../../js/password-visibility.js"></script>
</body>

</html>