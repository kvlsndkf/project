<?php
session_start();
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

        <title>Cadastrar professor | Heelp!</title>

        <!-- CSS Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>

    <body>
        <div class="my-container">
            <!-- <div class="container"> -->
                <!-- 
                    Mensagem de erro ⬇️
                -->
                <?php if (isset($_SESSION['statusNegative']) && $_SESSION != '') { ?>

                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </symbol>
                    </svg>

                    <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                            <use xlink:href="#exclamation-triangle-fill" />
                        </svg>
                        <div>
                            <strong>Ops...</strong>
                            <?php echo $_SESSION['statusNegative']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                <?php unset($_SESSION['statusNegative']);
                } ?>

                <!-- 
                Mensagem de alerta ⬇️
                -->
                <?php if (isset($_SESSION['statusAlert']) && $_SESSION != '') { ?>

                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </symbol>
                    </svg>

                    <div class="alert alert-warning d-flex align-items-center  alert-dismissible fade show" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:">
                            <use xlink:href="#exclamation-triangle-fill" />
                        </svg>
                        <div>
                            <strong>Ops...</strong>
                            <?php echo $_SESSION['statusAlert']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                <?php unset($_SESSION['statusAlert']);
                } ?>

                <div class="form-base bg-modal-gray">
                    <form action="./controller/teacher-unit-registration.controller.php" method="POST" enctype="multipart/form-data">
                        <div class="form-header">
                            <a href="#">
                                <img src="../image/form-teacher/components/arrow.svg" class="arrow" alt="Botão de voltar">
                            </a>
                            <label class="normal-20-bold-modaltitle title-header">Cadastro unitário professor</label>
                        </div>
                        <p>
                            <label class="normal-14-medium-p nome-professor">Nome professor</label>
                            <input type="text" name="name" id="name" class="normal-12-regular-tinyinput input-text" placeholder="Digite o nome do professor" autocomplete="off" required autofocus>
                        </p>
                            <hr class="hr"/>
                        <p>
                            <label class="normal-14-medium-p foto-text">Foto</label><br/>
                            <label for="photo" class="add-arch normal-14-bold-p">Adicionar arquivos</label>
                            <input type="file" class="photo" name="photo" id="photo" required>
                            <span id="file-name" class="slc-arch normal-12-medium-tiny gray-text-6">Nenhum arquivo selecionado</span>
                        </p>
                        <input type="submit" value="Cadastrar" class="register normal-14-bold-p" name="register">
                        <input type="reset" value="Limpar" class="clean normal-14-bold-p">
                    </form>
                </div>
            <!-- </div> -->
        </div>
        <!-- JS arquvio selecionado -->
        <script>
            let inputFile = document.getElementById('photo');
            let fileNameField = document.getElementById('file-name');
            inputFile.addEventListener('change', function(event){
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