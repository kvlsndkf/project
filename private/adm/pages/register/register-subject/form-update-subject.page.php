<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Subject.class.php');

session_start();

try {
    $subject = new Subject();

    if (isset($_GET['updateSubject'])) {
        $id = $_GET['updateSubject'];
        $updateSubject = $subject->searchSubjectForUpdate($id);
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="pt-br">

    <head>
        
        <!-- Base -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar matéria | Heelp!</title><link rel="shortcut icon" href="../../../../../views/images/favicon/favicon-16x16.png" type="image/x-icon">

        <!-- Estilos -->
        <link rel="stylesheet" href="../../../../../views/styles/colors.style.css">
        <link rel="stylesheet" href="../../../../../views/styles/style.global.css">
        <link rel="stylesheet" href="../../../../../views/styles/fonts.style.css">

        <link rel="stylesheet" href="../../../../style/form-update-teacher.style.css">
        <link rel="stylesheet" href="../../../../../views/styles/button.style.css">

    </head>

    <body>

        <div class="my-container">
            <div class="page-container">
                <div class="form-base bg-modal-gray">

                    <div class="form-header">
                        <a onclick="window.history.go(-1);">
                            <img src="../../../images/components/arrow.svg" class="arrow" alt="Botão de voltar">
                        </a>
                        <label class="normal-20-bold-modaltitle title-header">Editar matéria</label>
                    </div>

                    <form action="./controller/update-subject.controller.php?updateSubject=<?php echo $updateSubject['id'] ?>" method="post">
                        <p class="normal-14-medium-p name">
                            Nome matéria
                            <input type="text" name="updateName" class="input-text normal-12-regular-tinyinput" id="updateName" required autofocus autocomplete="off" value="<?php echo $updateSubject['name'] ?>">
                        </p>

                        <p>
                            <input type="submit" value="Editar" class="register normal-14-bold-p" name="update">
                            <a href="./list-subject.page.php"><button type="button" class="clean normal-14-bold-p">Cancelar</button></a>
                        </p>
                    </form>

                </div>
            </div>
        </div>

    </body>

</html>