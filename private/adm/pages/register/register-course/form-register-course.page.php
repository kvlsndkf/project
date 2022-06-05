<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-administrator.controller.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Teacher.class.php');
require_once('/xampp/htdocs' . '/project/classes/schools/School.class.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Subject.class.php');


try {
    $teacher = new Teacher();
    $listTeachersOfSelect = $teacher->listTeachersOfSelectResgisterSchool();

    $school = new School();
    $listSchoolsOfSelect = $school->listSchoolsOfSelectResgisterCourse();

    $subject = new Subject();
    $listSubjectsOfSelect = $subject->listSubjectsOfSelectResgisterCourse();
} catch (Exception $e) {
    echo $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar curso | Heelp!</title>

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
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css" rel="stylesheet" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
</head>

<style>
    body {
        overflow-x: hidden;
    }
</style>

<body>
    <div class="my-container-er">
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
        <div class="page-container d-flex align-items-center justify-content-center">
            <div class="form-base bg-modal-gray align-self-center my-auto">

                <form action="./controller/course-unit-registration.controller.php" method="post" enctype="multipart/form-data">
                    <div class="form-header">
                        <a href="./list-course.page.php">
                            <img src="../image/form-teacher/components/arrow.svg" class="arrow" alt="Botão de voltar">
                        </a>
                        <label class="normal-20-bold-modaltitle title-header">Cadastro curso</label>
                    </div>
                    <label class="normal-14-medium-p nome-professor">
                        Nome
                    </label>
                    <input type="text" name="name" class="normal-12-regular-tinyinput input-text" id="name" style="margin-bottom: 15px;" placeholder="Digite o nome do curso" required autocomplete="off" autofocus pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ-]+$" minlength="5">



                    <label class="normal-14-medium-p nome-professor">Selecione as Etec's a que ele pertence</label>


                    <p>
                        <select name="idSchools[]" id="idSchools" class="multiple-select w-100" style="width: 100%" multiple="multiple" required>
                            <?php for ($i = 0; $i < count($listSchoolsOfSelect); $i++) {
                                $row = $listSchoolsOfSelect[$i] ?>
                                <option value="<?php echo $row->id ?>"> <?php echo $row->name ?> </option>
                            <?php } ?>
                        </select>
                    </p>


                    <label class="normal-14-medium-p nome-professor">Selecione os professores que lecionam este curso</label>


                    <p>
                        <select name="idTeachers[]" id="idTeachers" class="multiple-select school-select w-100" style="width: 100%" multiple="multiple" required>
                            <?php for ($i = 0; $i < count($listTeachersOfSelect); $i++) {
                                $row = $listTeachersOfSelect[$i] ?>
                                <option value="<?php echo $row->id ?>"> <?php echo $row->name ?> </option>
                            <?php } ?>
                        </select>
                    </p>


                    <label class="normal-14-medium-p nome-professor">Selecione as matérias deste curso</label>


                    <p>
                        <select name="idSubjects[]" id="idSubjects" class="multiple-select subject-select w-100" style="width: 100%" multiple="multiple" required>
                            <?php for ($i = 0; $i < count($listSubjectsOfSelect); $i++) {
                                $row = $listSubjectsOfSelect[$i] ?>
                                <option value="<?php echo $row->id ?>"> <?php echo $row->name ?> </option>
                            <?php } ?>
                        </select>
                    </p>

                    <div>
                        <p class="normal-14-medium-p nome-professor">
                            Sobre
                        </p>

                        <div id="contentTextArea">
                            <textarea name="about" id="about" cols="30" rows="7" placeholder="Digite sobre o curso" class="text-area normal-14-medium-p" required onclick="colorDiv()" minlength="100" maxlength="250"></textarea>
                            <div class="counter-container"><span id="counterTextArea" class="counterTextArea whitney-8-medium-littletiny">250</span></div>
                        </div>
                    </div>
                    <div class="min-length slc-arch normal-12-medium-tiny gray-text-6" id="min-length">
                        <span></span>
                    </div>
                    <hr>

                    <p>
                        <label class="normal-14-medium-p nome-professor">Foto</label>
                        <input type="file" name="photo" class="photo" id="photo" required>
                        <label for="photo" class="add-arch normal-14-bold-p">Adicionar arquivos</label>

                        <span id="file-name" class="slc-arch normal-12-medium-tiny gray-text-6">Nenhum arquivo selecionado</span>
                    </p>

                    <hr>

                    <button type="submit" name="register" class="button-wide button-white-white-text register normal-14-bold-p" onclick="GFG_Fun(); checkLength()">Cadastrar</button>
                    <button type="reset" id="reset" class="button-wide button-white-primary-text clean normal-14-bold-p">Limpar</button>

                </form>
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
            placeholder: "Selecione as Etec's",
            allowClear: true
        });

        $(".school-select").select2({
            placeholder: "Selecione os professores",
            allowClear: true
        });

        $(".subject-select").select2({
            placeholder: "Selecione as matérias",
            allowClear: true
        });
    </script>

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
            }
            if (textArea.value.length > 240) {
                minLength.style.color = "#ED4245";
                minLength.innerText = "Máximo de caracteres: 240";
            }
        }
    </script>

    <script>
        const noNumbersInput = document.querySelector("#name");
            noNumbersInput.addEventListener("keypress", function(numberEvent) {
                const keyCode = (numberEvent.keyCode ? numberEvent.keyCode : numberEvent.wich);

                if(keyCode > 47 && keyCode < 58) {
                    numberEvent.preventDefault();
                }
            })
    </script>

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