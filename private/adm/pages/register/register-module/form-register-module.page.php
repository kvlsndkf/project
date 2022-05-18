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
        <div class="my-container">
            <div class="page-container">
                <div class="form-base bg-modal-gray">
                    <div class="form-header">
                <a href="./list-module.page.php">
                                    <img src="../../../images/components/arrow.svg" class="arrow" alt="Botão de voltar">
                                </a>
                    <label class="normal-20-bold-modaltitle title-header">Cadastro módulo</label>
                    </div>
                    <form action="./controller/module-unit-registration.controller.php" method="post">
                        <p class="normal-14-medium-p name">
                            Nome
                            <input class="input-text normal-12-regular-tinyinput input-name-module" type="text" name="name" id="name" placeholder="Digite o nome do módulo" required autocomplete="off" autofocus minlength="5">
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