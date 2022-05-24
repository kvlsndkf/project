<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar matéria | Heelp!</title>
</head>

<body>
    <form action="./controller/subject-unit-registration.controller.php" method="post">
        <p>
            Nome
            <input type="text" name="name" id="name" required autofocus autocomplete="off">
        </p>

        <p>
            <button type="submit" name="register">Cadastrar</button>
            <button type="reset">Limpar</button>
        </p>
    </form>
</body>

</html>