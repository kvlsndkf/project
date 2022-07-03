<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-administrator.controller.php');
include_once('/xampp/htdocs' . '/project/database/connection.php');
$connection = Connection::connection();

if (isset($_GET['updateModule'])) {

    $id = $_GET['updateModule'];

    $stmt = $connection->prepare("SELECT * FROM modules WHERE id = $id");

    $stmt->execute();
    $rowCat = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    $rowCat['name'] = " ";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../../views/styles/colors.style.css">
    <link rel="stylesheet" href="../../../../../views/styles/style.global.css">
    <link rel="stylesheet" href="../../../../../views/styles/fonts.style.css">
    <link rel="stylesheet" href="../../../../style/form-update-teacher.style.css">
    <link rel="stylesheet" href="../../../../../views/styles/button.style.css">
    <link rel="shortcut icon" href="../../../../../views/images/favicon/favicon-16x16.png" type="image/x-icon">
    <title>Editar módulo | Heelp!</title>

</head>

<body>
    <div class="my-container">
        <div class="page-container">
            <div class="form-base bg-modal-gray">
                <form action="./controller/update-module.controller.php?updateModule=<?php echo $rowCat['id'] ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-header">
                        <a href="./list-module.page.php">
                            <img src="../../../images/components/arrow.svg" class="module-arrow" alt="Botão de voltar">
                        </a>
                        <label class="normal-20-bold-modaltitle title-header">Editar módulo</label>
                    </div>
                    <p>
                        <label class="normal-14-medium-p name">Nome módulo<span style="color: var(--red);">*</span></label><br/>
                        <input type="text" name="updateName" id="updateName" class="input-name-module normal-12-regular-tinyinput input-text" value="<?php echo $rowCat['name'] ?>"required autocomplete="off" autofocus minlength="4">
                    </p>

                    <input type="submit" class="register normal-14-bold-p" value="Editar" name="update">
                    <a href="./list-module.page.php"><button type="button" class="clean normal-14-bold-p">Cancelar</button></a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>