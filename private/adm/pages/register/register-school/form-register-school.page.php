<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-administrator.controller.php');
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Teacher.class.php');
require_once('/xampp/htdocs' . '/project/classes/places/Place.class.php');

try {
    $teacher = new Teacher();
    $listTeachersOfSelect = $teacher->listTeachersOfSelectResgisterSchool();

    $place = new Place();
    $places = $place->getPlaces();
} catch (Exception $e) {
    echo $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Cadastrar Etec | Heelp!</title>

    <link rel="stylesheet" href="../../../../style/style.css">

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- CSS styles -->
    <link rel="stylesheet" href="../../../../style/form-register-teacher.page.css">
    <link rel="stylesheet" href="../../../../../views/styles/style.global.css">
    <link rel="stylesheet" href="../../../../../views/styles/font-format.style.css">
    <link rel="stylesheet" href="../../../../../views/styles/fonts.style.css">
    <link rel="stylesheet" href="../../../../../views/styles/colors.style.css">
    <link rel="stylesheet" href="../../../../../views/styles/button.style.css">
    <link rel="shortcut icon" href="../../../../../views/images/favicon/favicon-16x16.png" type="image/x-icon">
    <!-- JS Disabled Inputs -->
    <script type="text/javascript" src="../../js/disabled-inputs.js"></script>
    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
    <div class="my-container-er">
        <!-- Mensagem de erro ⬇️ -->
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

        <!-- Mensagem de alerta ⬇️ -->
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

        <div class="page-container d-flex align-items-center justify-content-center">
            <div class="form-base bg-modal-gray align-self-center my-auto">
                <div class="form-header">
                    <a href="./list-school.page.php">
                        <img src="../image/form-teacher/components/arrow.svg" class="arrow" alt="Botão de voltar">
                    </a>
                    <label class="normal-20-bold-modaltitle title-header">Cadastro Etec</label>
                </div>
                <div class="container">
                    <form action="./controller/school-unit-registration.controller.php" method="POST" enctype="multipart/form-data">
                        <label class="normal-14-medium-p nome-professor">
                            Nome Etec<span style="color: var(--red);">*</span>
                        </label>
                        <input type="text" name="name" id="name" class="normal-12-regular-tinyinput input-text" placeholder="Digite o nome da ETEC" autocomplete="off" required autofocus pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$" minlength="10">
                        <div>
                            <span id="min-leng-name"></span>
                        </div>
                        <br />
                        <p class="normal-14-medium-p etec-location-label">
                            A Etec fica localizada dentro da cidade de São Paulo?<span style="color: var(--red);">*</span>
                        </p>

                        <p>
                            <input type="checkbox" name="districtSchool" id="checkDistrict" value="Inside city" required onclick="visibilityDistrict()"> <span class="normal-14-medium-p nome-professor checkbox-label">Sim</span>

                            <input type="checkbox" name="citySchool" id="checkCity" value="Outside city" required onclick="visibilityCity()"> <span class="normal-14-medium-p nome-professor">Não</span>
                        </p>

                        <p id="textDistrict" style="display:none">
                            Distrito<span style="color: var(--red);">*</span>
                            <select name="address" id="district" class="select-district" style="width: 100%" disabled required>
                                <option value="" selected disabled>Selecione o respectivo distrito</option>
                                <?php foreach ($places->districts as $row) { ?>
                                    <option value="<?php echo $row->name ?>"> <?php echo $row->name ?> </option>
                                <?php } ?>
                            </select>
                        </p>


                        <p id="textCity" style="display:none">
                            Município<span style="color: var(--red);">*</span>
                            <select name="address" id="city" class="select-city" style="width: 100%" disabled required>
                                <option value="" selected disabled>Selecione o respectivo município</option>
                                <?php foreach ($places->cities as $row) { ?>
                                    <option value="<?php echo $row->name ?>"> <?php echo $row->name ?> </option>
                                <?php } ?>
                            </select>
                        </p>
                        <hr class="dropdwon-divider" />
                        <span class="normal-14-medium-p nome-professor">
                            <input type="checkbox" name="createAccount" id="createAccount" onclick="createdAccount()" value="createdAccount">
                            <p style="display: inline-block;">
                                <span class="label-social">Criar um perfil para a Etec?</span>
                            </p>
                        </span>
                        <p class="span-warning-school normal-12-bold-tiny gray-text-6 mb-3">
                            Os campos abaixo só ficarão habilitados se escolher criar um perfil para a Etec.
                        </p>

                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item" style="border: none;">
                                <h3 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button acc-btn collapsed normal-12-regular-tinyinput" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Dados para o perfil
                                    </button>
                                </h3>

                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body" style="background-color: var(--bg-modal);">

                                        <p>
                                            <label class="normal-14-medium-p ">Selecione os professores a que ela pertence<span style="color: var(--red);">*</span></label>
                                        </p>
                                        <p>
                                            <select name="idTeachers[]" id="idTeachers" class="multiple-select bg-modal disabled-area" style="width: 100%;" multiple="multiple" disabled required>
                                                <?php for ($i = 0; $i < count($listTeachersOfSelect); $i++) {
                                                    $row = $listTeachersOfSelect[$i] ?>
                                                    <option value="<?php echo $row->id ?>"> <?php echo $row->name ?> </option>
                                                <?php } ?>
                                            </select>
                                        </p>


                                        <hr class="dropdown-divider">


                                        <div>
                                            <p class="normal-14-medium-p">
                                                Sobre<span style="color: var(--red);">*</span>
                                            </p>

                                            <div id="contentTextArea">
                                                <textarea name="about" id="about" cols="30" rows="7" placeholder="Faça um breve texto contando sobre a Etec, ele aparecerá na página de perfil da mesma" class="text-area normal-14-medium-p" divlaceholder="Digite sobre a etec" disabled onclick="colorDiv()" minlength="100" maxlength="250"></textarea>
                                                <div class="counter-container"><span id="counterTextArea" class="counterTextArea whitney-8-medium-littletiny">250</span></div>
                                            </div>

                                        </div>
                                        <div class="min-length slc-arch normal-12-medium-tiny gray-text-6" id="min-length">
                                            <span></span>
                                        </div>
                                        <hr class="dropdown-divider">
                                        <label class="normal-18-bold-title-2">Links</label>
                                        <p class="normal-14-medium-p">
                                        <p class="normal-14-medium-p label-social">Linkedin</p>
                                        <input type="text" name="linkedin" class="normal-12-regular-tinyinput input-text input-social disabled-area" id="linkedin" placeholder="Copie e cole a URL" disabled autocomplete="off">
                                        </p>

                                        <p class="normal-14-medium-p">
                                        <p class="normal-14-medium-p label-social">GitHub</p>
                                        <input type="text" name="github" class="normal-12-regular-tinyinput input-text input-social disabled-area" id="github" placeholder="Copie e cole a URL" disabled autocomplete="off">
                                        </p>

                                        <p class="normal-14-medium-p">
                                        <p class="normal-14-medium-p label-social">Facebook</p>
                                        <input type="text" name="facebook" class="normal-12-regular-tinyinput input-text input-social disabled-area" id="facebook" placeholder="Copie e cole a URL" disabled autocomplete="off">
                                        </p>

                                        <p class="normal-14-medium-p">
                                        <p class="normal-14-medium-p label-social">Instagram</p>
                                        <input type="url" name="instagram" class="normal-12-regular-tinyinput input-text input-social disabled-area" id="instagram" placeholder="Copie e cole a URL" disabled autocomplete="off">
                                        </p>
                                        <hr class="dropdown-divider">
                                        <p class="normal-14-medium-p">
                                            <label class="normal-14-medium-p foto-text">Foto<span style="color: var(--red);">*</span></label><br />
                                            <label for="photo" class="add-arch normal-14-bold-p">Adicionar arquivos</label>
                                            <input type="file" class="photo" name="photo" id="photo" disabled required>
                                            <span id="file-name" class="slc-arch normal-12-medium-tiny gray-text-6">Nenhum arquivo selecionado</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="button-wide button-white-white-text register normal-14-bold-p" name="register" onclick="GFG_Fun(); checkLength()">Cadastrar</button>
                        <button type="reset" id="reset" class="button-wide button-white-primary-text clean normal-14-bold-p">Limpar</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- JS JQuery ⬇️ -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- JS Bootstrap ⬇️ -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <!-- JS Select Multiple ⬇️ -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(".multiple-select").select2({
            placeholder: "Selecione os professores",
            allowClear: true
        });

        $(".select-district").select2({
            placeholder: "Selecione o respectivo distrito",
            allowClear: true
        });

        $(".select-city").select2({
            placeholder: "Selecione o respectivo município",
            allowClear: true
        });
    </script>

    <!-- JS Visibility Inputs -->
    <script type="text/javascript" src="../../js/visibility-inputs.js"></script>

    <!-- JS Count Characters TextArea -->
    <script type="text/javascript" src="../../js/textarea.js"></script>
    <!-- JS arquvio selecionado -->
    <script type="text/javascript">
        let inputFile = document.getElementById('photo');
        let fileNameField = document.getElementById('file-name');
        inputFile.addEventListener('change', function(event) {
            let uploadedFileName = event.target.files[0].name;
            fileNameField.textContent = uploadedFileName;
        });

        document.getElementById("reset").addEventListener("click", function() {
            document.getElementById("file-name").innerText = "Nenhum arquivo selecionado";
        });

        var down = document.getElementById('file-name');
        var file = document.getElementById("photo");
        var uploadedFileName = event.target.files[0].name;


        function GFG_Fun() {
            if (file.files.length == 0) {
                down.style.color = "#ED4245";
                down.innerText = "SELECIONE UM ARQUIVO!";
            } else {
                true
            }
        }
    </script>

    <!-- JS tamanho minimo text area -->
    <script>
        var textArea = document.getElementById('about');
        var minLength = document.getElementById('min-length');

        function checkLength() {
            if (textArea.value.length < 100) {
                minLength.style.color = "#ED4245";
                minLength.innerText = "Mínimo de caracteres: 100";
            } if (textArea.value.length > 250) {
                minLength.style.color = "#ED4245";
                minLength.innerText = "Máximo de caracteres: 250";
            }
        }
    </script>

    <!-- JS tamanho máximo textarea  -->

    <script>
        $(document).ready(function() {
            $('#about').on('input propertychange', function() {
                charLimit(this, 240);
            });
        });

        function charLimit(input, maxChar) {
            var len = $(input).val().length;
            if (len > maxChar) {
                $(input).val($(input).val().substring(0, maxChar));
            }
        }
    </script>
</body>

</html>