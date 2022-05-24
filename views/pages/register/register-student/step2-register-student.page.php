<?php
require_once('/xampp/htdocs' . '/project/classes/cookies/Cookie.class.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados pessoais | Heelp!</title>
</head>

<body>
    <a href="./step1-register-student.page.php">Voltar</a>
    <br>
    <br>
    <label for="">Etapa 2/4</label>
    <br>
    <br>
    <label for="">Dados pessoais</label>
    <br>
    <br>
    <form action="./controller/student-cookie.controller.php" method="post">
        <div>
            Primeiro nome
            <br>
            <?php $firstName =  !is_null(Cookie::reader('firstName')) ? Cookie::reader('firstName') : ''; ?>
            <input type="text" name="firstName" id="firstName" required autocomplete="off" autofocus value="<?php echo $firstName; ?>">
        </div>
        <br>
        <br>
        <div>
            Sobrenome
            <br>
            <?php $surname =  !is_null(Cookie::reader('surname')) ? Cookie::reader('surname') : ''; ?>
            <input type="text" name="surname" id="surname" required autocomplete="off" value="<?php echo $surname; ?>">
        </div>
        <br>
        <br>
        <hr>
        <label>Links</label>
        <p>
            Linkedin
            <?php $linkedin =  !is_null(Cookie::reader('linkedin')) ? Cookie::reader('linkedin') : ''; ?>
            <input type="text" name="linkedin" id="linkedin" placeholder="Copie e cole a URL" autocomplete="off" value="<?php echo $linkedin; ?>">
        </p>

        <p>
            GitHub
            <?php $github =  !is_null(Cookie::reader('github')) ? Cookie::reader('github') : ''; ?>
            <input type="text" name="github" id="github" placeholder="Copie e cole a URL" autocomplete="off" value="<?php echo $github; ?>">
        </p>

        <p>
            Facebook
            <?php $facebook =  !is_null(Cookie::reader('facebook')) ? Cookie::reader('facebook') : ''; ?>
            <input type="text" name="facebook" id="facebook" placeholder="Copie e cole a URL" autocomplete="off" value="<?php echo $facebook; ?>">
        </p>

        <p>
            Instagram
            <?php $instagram =  !is_null(Cookie::reader('instagram')) ? Cookie::reader('instagram') : ''; ?>
            <input type="url" name="instagram" id="instagram" placeholder="Copie e cole a URL" autocomplete="off" value="<?php echo $instagram; ?>">
        </p>
        <input type="submit" value="Continuar" name="step2">
    </form>
</body>

</html>