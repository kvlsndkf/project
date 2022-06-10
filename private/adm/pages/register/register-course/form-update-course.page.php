<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-administrator.controller.php');
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Teacher.class.php');
require_once('/xampp/htdocs' . '/project/classes/schools/School.class.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Course.class.php');

try {
    $course = new Course();

    if (isset($_GET['updateCourse'])) {
        $id = $_GET['updateCourse'];
        $updateCourse = $course->searchCourseForUpdate($id);

        $schoolsUsedByCourse = $course->selectSchoolsUsedByCourse($id);
        $schoolAvailable = $course->selectAvailableSchoolsForCourse($id);

        $teachersUsedByCourse = $course->selectTeachersUsedByCourse($id);
        $teacherAvailable = $course->selectAvailableTeachersForCourse($id);

        $subjectsUsedByCourse = $course->selectSubjectsUsedByCourse($id);
        $subjectAvailable = $course->selectAvailableSubjectsForCourse($id);
    }
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
    <link rel="stylesheet" href="../../../../style/form-register-teacher.page.css">
    <link rel="stylesheet" href="../../../../style/form-update-teacher.style.css">
    <link rel="stylesheet" href="../../register/register.styles.css">
    <link rel="stylesheet" href="../../../../../views/styles/style.global.css">
    <link rel="stylesheet" href="../../../../../views/styles/font-format.style.css">
    <link rel="stylesheet" href="../../../../../views/styles/fonts.style.css">
    <link rel="stylesheet" href="../../../../../views/styles/colors.style.css">
    <link rel="stylesheet" href="../../../../../views/styles/button.style.css">
    <link rel="shortcut icon" href="../../../../../views/images/favicon/favicon-16x16.png" type="image/x-icon">
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

</head>

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
        <div class="d-flex align-items-center justify-content-center">
            <div class="form-base bg-modal-gray align-self-center my-auto mt-3 mb-3">
                <form action="./controller/update-course.controller.php?updateCourse=<?php echo $updateCourse['id'] ?>" method="post" enctype="multipart/form-data">
                    <div class="form-header">
                        <a href="./list-course.page.php">
                            <img src="../image/form-teacher/components/arrow.svg" class="arrow" alt="Botão de voltar">
                        </a>
                        <label class="normal-20-bold-modaltitle title-header">Cadastro curso</label>
                    </div>
                    <p>
                        <label class="normal-14-medium-p nome-professor">Nome</label>
                        <input type="text" name="updateName" id="name" style="margin-bottom: 28px;" class="normal-12-regular-tinyinput input-text" id="updateName" required autocomplete="off" minlength="5" pattern="\s*\S+.*" value="<?php echo $updateCourse['name'] ?>">
                    </p>

                    <p class="normal-14-medium-p etec-location-label">
                        <label>Selecione as Etec's a que ele pertence</label>
                    </p>

                    <p>
                        <select name="idSchools[]" id="idSchools" class="multiple-select" required style="width: 100%" multiple="multiple" required>
                            <optgroup label="Etec's selecionadas">
                                <?php foreach ($schoolsUsedByCourse as $row) { ?>
                                    <option selected="selected" value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
                                <?php } ?>
                            </optgroup>

                            <optgroup label="Etec's disponíveis">
                                <?php foreach ($schoolAvailable as $row) { ?>
                                    <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
                                <?php } ?>
                            </optgroup>
                        </select>
                    </p>

                    <p class="normal-14-medium-p etec-location-label">
                        <label>Selecione os professores a que lecionam este curso</label>
                    </p>

                    <p>
                        <select name="idTeachers[]" id="idTeachers" class="multiple-select" required style="width: 100%" multiple="multiple" required>
                            <optgroup label="Professores selecionados">
                                <?php foreach ($teachersUsedByCourse as $row) { ?>
                                    <option selected="selected" value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
                                <?php } ?>
                            </optgroup>

                            <optgroup label="Professores disponíveis">
                                <?php foreach ($teacherAvailable as $row) { ?>
                                    <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
                                <?php } ?>
                            </optgroup>
                        </select>
                    </p>

                    <p class="normal-14-medium-p etec-location-label">
                        <label>Selecione as matérias deste curso</label>
                    </p>

                    <p>
                        <select name="idSubjects[]" id="idSubjects" class="multiple-select" required style="width: 100%" multiple="multiple" required>
                            <optgroup label="Matérias selecionadas">
                                <?php foreach ($subjectsUsedByCourse as $row) { ?>
                                    <option selected="selected" value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
                                <?php } ?>
                            </optgroup>

                            <optgroup label="Matérias disponíveis">
                                <?php foreach ($subjectAvailable as $row) { ?>
                                    <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
                                <?php } ?>
                            </optgroup>
                        </select>
                    </p>

                    <div>
                        <p class="normal-14-medium-p etec-location-label">
                            Sobre
                        </p>

                        <div id="contentTextArea">
                            <textarea name="about" id="about" cols="30" rows="10" class="text-area normal-14-medium-p" minlength="100" required onclick="colorDiv(); checkLength()"><?php echo $updateCourse['about'] ?></textarea>
                            <div class="counter-container"><span id="counterTextArea" class="counterTextArea whitney-8-medium-littletiny">250</span></div>
                        </div>
                    </div>
                    <div class="min-length slc-arch normal-12-medium-tiny gray-text-6" id="min-length">
                        <span></span>
                    </div>
                    <hr>

                    <p>
                        <label class="normal-14-medium-p etec-location-label">Foto</label>
                        <br>
                    <div style="  width: 100%;
                                    height: fit-content;
                                    display: flex;
                                    justify-content: center;
                                    ">
                        <img class="img-curso" src="<?php echo $updateCourse['photo'] ?>" alt="Foto <?php echo $updateCourse['name'] ?>">
                    </div>
                    <br>
                    <label for="updatePhoto" class="add-arch normal-14-bold-p">Adicionar arquivos</label>
                    <span id="file-name" class="slc-arch normal-12-medium-tiny gray-text-6">Nenhum arquivo selecionado</span>
                    <input type="file" class="photo" name="updatePhoto" id="updatePhoto">
                    <input type="hidden" name="oldPhoto" id="oldPhoto" value="<?php echo $updateCourse['photo'] ?>">
                    </p>

                    <hr>

                    <input type="submit" class="button-wide button-white-white-text normal-14-bold-p register" style="margin-top: 60px;" value="Editar" name="update">
                    <a href="./list-course.page.php"><button type="button" class="button-wide button-white-primary-text clean normal-14-bold-p">Cancelar</button></a>
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
    <script>
        let inputFile = document.getElementById('updatePhoto');
        let fileNameField = document.getElementById('file-name');
        inputFile.addEventListener('change', function(event) {
            let uploadedFileName = event.target.files[0].name;
            fileNameField.textContent = uploadedFileName;
        })
    </script>

    <script>
        const noNumbersInput = document.querySelector("#name");
        noNumbersInput.addEventListener("keypress", function(numberEvent) {
            const keyCode = (numberEvent.keyCode ? numberEvent.keyCode : numberEvent.wich);

            if (keyCode > 47 && keyCode < 58) {
                numberEvent.preventDefault();
            }
        })
    </script>

    <!-- JQuery char limit textarea -->
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

    <!-- JS APENAS permitir: letras, acentuação, espaço e hífen  -->

    <script>
        $('#name').on('keypress', function(event) {
            var regex = new RegExp("^[-A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        });
    </script>

    <!-- JS bloquear colagem (paste) -->

    <script>
        var myElement = document.getElementById('name');
        myElement.addEventListener('paste', e => e.preventDefault());
    </script>


</body>

</html>