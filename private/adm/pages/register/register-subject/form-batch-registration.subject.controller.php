<!DOCTYPE html>
<html lang="pt-br">

    <head>
        
        <!-- Base -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro em lote matérias | Heelp!</title>
        <link rel="shortcut icon" href="../../../../../views/images/favicon/favicon-16x16.png" type="image/x-icon">

        <!-- Estilos -->
        <link rel="stylesheet" href="../../../../../views/styles/colors.style.css">
        <link rel="stylesheet" href="../../../../../views/styles/style.global.css">
        <link rel="stylesheet" href="../../../../../views/styles/fonts.style.css">

        <link rel="stylesheet" href="../../../../style/form-register-teacher.page.css">
        <link rel="stylesheet" href="../../../../style/form-update-teacher.style.css">
        <link rel="stylesheet" href="../../../../../views/styles/button.style.css">

    </head>

    <body>

        <div class="my-container">
            <div class="page-container">
                <div class="form-base bg-modal-gray">
                    
                    <div class="form-header">
                        <a onclick="window.history.go(-1);">
                            <img src="../../../images/components/arrow.svg" class="module-arrow" alt="Botão de voltar">
                        </a>
                        <label class="normal-20-bold-modaltitle title-header">Cadastro em lote matéria</label>
                    </div>

                    <p class="normal-14-medium-p name">Para efetuar o cadastro em lote baixe aqui o modelo da planilha</p>
                    <button class="download-model normal-14-bold-p">Baixar modelo de planilha</button>

                    <hr class="hr-batch-modal">

                    <form action="./controller/subject-batch-resgistration.controller.php" name="subject-batch-registration" method="post" enctype="multipart/form-data">
                        <br />
                        <br />


                        <p class="normal-14-medium-p name">Envie o modelo da planilha preenchido</p>

                        <!-- <input type="file" name="subject-table-file" required> -->
                        <p class="classe-p">
                            <label for="subject-table-file" style="width: 100%;" class="add-arch normal-14-bold-p">Adicionar arquivos</label>
                            <input type="file" style="display: none;" name="subject-table-file" id="subject-table-file" required>
                            <span id="file-name" class="slc-arch normal-12-medium-tiny gray-text-6">Nenhum arquivo selecionado</span>
                            <input type="hidden" name="oldPhoto" id="oldPhoto" value="<?php echo $rowCat['photo'] ?>">
                        </p>

                        <br>

                        <br />
                        <br />
                        <input type="submit" class="register normal-14-bold-p" value="Cadastrar em lote" onclick = "GFG_Fun()">
                        <button type="reset" class="clean normal-14-bold-p" id="reset">Limpar</button>
                    </form>

                </div>
            </div>
        </div>

        <!-- JS arquvio selecionado -->
        <script>
            let inputFile = document.getElementById('subject-table-file');
            let fileNameField = document.getElementById('file-name');
            inputFile.addEventListener('change', function(event) {
                let uploadedFileName = event.target.files[0].name;
                fileNameField.textContent = uploadedFileName;
            })

            document.getElementById("reset").addEventListener("click", function(){
            document.getElementById("file-name").innerText = "Nenhum arquivo selecionado";});

            var down = document.getElementById('file-name');
            var file = document.getElementById("subject-table-file");
            var uploadedFileName = event.target.files[0].name;
            
            
            function GFG_Fun() {
                if(file.files.length == 0 ){
                    down.style.color = "#ED4245";
                    down.innerText = "SELECIONE UM ARQUIVO!";
                } else {
                    true
                }
            }
        </script>

        <!-- JS Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>

</html>