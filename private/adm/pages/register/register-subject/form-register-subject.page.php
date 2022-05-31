<!DOCTYPE html>
<html lang="pt-br">

    <head>
        
        <!-- Base -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastrar matéria | Heelp!</title>
        <link rel="shortcut icon" href="../../../../../views/images/favicon/favicon-16x16.png" type="image/x-icon">

        <!-- Estilos -->
        <link rel="stylesheet" href="../../../../../views/styles/colors.style.css">
        <link rel="stylesheet" href="../../../../../views/styles/style.global.css">
        <link rel="stylesheet" href="../../../../../views/styles/fonts.style.css">

        <link rel="stylesheet" href="../../../../style/form-update-teacher.style.css">
        <!-- <link rel="stylesheet" href="../../../../../views/styles/button.style.css"> -->

    </head>

    <body>

        <div class="my-container">
            <div class="page-container">
                <div class="form-base bg-modal-gray">

                    <div class="form-header">
                        <a onclick="window.history.go(-1);">
                            <img src="../../../images/components/arrow.svg" class="module-arrow" alt="Botão de voltar">
                        </a>
                        <label class="normal-20-bold-modaltitle title-header">Cadastro unitário matéria</label>
                    </div>

                    <form action="./controller/subject-unit-registration.controller.php" method="post">
                        <p class="normal-14-medium-p name">
                            Nome matéria
                            <input type="text" class="input-text normal-12-regular-tinyinput input-name-module" placeholder="Digite o nome da matéria" name="name" id="name" required autofocus autocomplete="off" autofocus pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$" minlength="6">
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