<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar módulo | Heelp!</title>

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- CSS Search Bar -->
    <link rel="stylesheet" href="../../../../style/search-bar.style.css">
</head>

<body>
    <label>Cadastro módulo</label>
    <form action="./controller/module-unit-registration.controller.php" method="post">
        <p>
            Nome
            <input type="text" name="name" id="name" placeholder="Digite o nome do módulo" required autocomplete="off">
        </p>
        <p>
            <button type="submit" name="register">Cadastrar</button>
            <button type="reset">Limpar</button>
        </p>
    </form>
</body>

</html>