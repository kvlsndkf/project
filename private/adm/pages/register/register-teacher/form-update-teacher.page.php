<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
$connection = Connection::connection();

//update teacher
if (isset($_GET['updateTeacher'])) {

    $id = $_GET['updateTeacher'];

    $stmt = $connection->prepare("SELECT * FROM teachers WHERE id = $id");

    $stmt->execute();
    $rowCat = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    $rowCat['name'] = " ";
    $rowCat['photo'] = " ";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../style/form-register-teacher.page.css">
    <link rel="stylesheet" href="../../../../../views/styles/style.global.css">
    <link rel="stylesheet" href="../../../../../views/styles/font-format.style.css">
    <link rel="stylesheet" href="../../../../../views/styles/fonts.style.css">
    <link rel="stylesheet" href="../../../../../views/styles/colors.style.css">
    <link rel="shortcut icon" href="../../../../../views/images/favicon/favicon-16x16.png" type="image/x-icon">
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Editar professor | Heelp!</title>

</head>

<body>
    <div class="my-container">
        <div class="page-container">
            <div class="form-base bg-modal-gray">
                <form action="./controller/update-teacher.controller.php?updateTeacher=<?php echo $rowCat['id'] ?>" method="POST" enctype="multipart/form-data">

                    <div class="form-header">
                        <a href="./list-teacher.page.php">
                            <img src="../../../images/components/arrow.svg" class="arrow" alt="Botão de voltar">
                        </a>
                        <label class="normal-20-bold-modaltitle title-header">Editar professor</label>
                    </div>
                    <p>
                        <label class="normal-14-medium-p nome-professor">Nome professor</label><br />
                        <input type="text" class="normal-12-regular-tinyinput input-text" name="updateName" id="updateName" value="<?php echo $rowCat['name'] ?>" autocomplete="off" required autofocus pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$" minlength="6">
                    </p>
                    <p>
                        <label class="normal-14-medium-p foto-text">Foto atual</label><br />
                        <img width="100" src="<?php echo $rowCat['photo'] ?>" alt="Foto <?php echo $rowCat['name'] ?>">
                    </p>

                    <p>
                        <label for="updatePhoto" class="add-arch normal-14-bold-p">Adicionar arquivos</label>
                        <input type="file" class="photo" name="updatePhoto" id="updatePhoto">
                        <span id="file-name" class="slc-arch normal-12-medium-tiny gray-text-6">Nenhum arquivo selecionado</span>
                        <input type="hidden" name="oldPhoto" id="oldPhoto" value="<?php echo $rowCat['photo'] ?>">
                    </p>

                    <input type="submit" class="register normal-14-bold-p" value="Editar" name="update">
                    <a href="./list-teacher.page.php"><button type="button" class="clean normal-14-bold-p">Cancelar</button></a>

                </form>
            </div>
        </div>
    </div>
    <!-- JS arquvio selecionado -->
    <script>
        let inputFile = document.getElementById('updatePhoto');
        let fileNameField = document.getElementById('file-name');
        inputFile.addEventListener('change', function(event) {
            let uploadedFileName = event.target.files[0].name;
            fileNameField.textContent = uploadedFileName;
        })
    </script>
    <!-- 
            JS Bootstrap ⬇️
        -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>