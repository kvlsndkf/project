<?php
require_once('/xampp/htdocs' . '/project/classes/cookies/Cookie.class.php');
require_once('/xampp/htdocs' . '/project/classes/schools/School.class.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Module.class.php');

session_start();

try {
    $school = new School();
    $listSchoolsOfSelect = $school->schoolsHasCourses();

    $module = new Module();
    $listModulesOfSelect = $module->listModulesOfSelectResgisterUser();
} catch (Exception $e) {
    echo $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados pessoais | Heelp!</title>

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- STYLES -->
    <!-- STYLES -->
    <link rel="stylesheet" href="../../../styles/style.global.css">
    <link rel="stylesheet" href="../../../styles/colors.style.css">
    <link rel="stylesheet" href="../../../styles/font-format.style.css">
    <link rel="stylesheet" href="../../../styles/fonts.style.css">
    <link rel="stylesheet" href="../../../styles/input.style.css">
    <link rel="stylesheet" href="../../../styles/button.style.css">
    <link rel="stylesheet" href="./register-student.style.css">
    <link rel="shortcut icon" href="../../../../views/images/favicon/favicon-16x16.png" type="image/x-icon">
</head>

<body>
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

    <div class="h-100 w-100 d-flex align-items-center justify-content-center">
        <div class="bg-modal-gray align-self-center my-auto form-base-plump">
            <div class="d-flex justify-content-between">
                <a href="./step1-register-student.page.php"><img src="../../../../private/adm/images/components/arrow.svg" alt="Seta para voltar" class="mb-2"></a>
                <label class="normal-14-bold-p">Etapa 2/4</label>
            </div>
            <div class="text-center form-student-titles">
                <span class="normal-22-black-title-1 gray-title">Falta pouco...</span>
                <br />
                <span class="nord-32-black-display">Nos conte um pouco sobre você!</span>
            </div>
            <label class="normal-18-bold-title-2 subtitle-data">Dados pessoais</label>

            <br>
            <br>

            <form action="./controller/step2-cookie.controller.php" method="post">


                <p class="normal-14-bold-p gray-title forms-label-student">Primeiro nome<span style="color: var(--red);">*</span></p>
                <div>

                    <?php $firstName =  !is_null(Cookie::reader('firstName')) ? Cookie::reader('firstName') : ''; ?>
                    <input class="normal-12-regular-tinyinput input-text" placeholder="Digite seu primeiro nome" type="text" name="firstName" id="firstName" required minlength="2" autocomplete="off" autofocus value="<?php echo $firstName; ?>">
                </div>
                <br>


                <div>
                    <p class="normal-14-bold-p gray-title forms-label-student">Sobrenome<span style="color: var(--red);">*</span></p>


                    <?php $surname =  !is_null(Cookie::reader('surname')) ? Cookie::reader('surname') : ''; ?>
                    <input class="normal-12-regular-tinyinput input-text" placeholder="Digite seu sobrenome" type="text" name="surname" id="surname" required autocomplete="off" value="<?php echo $surname; ?>">
                </div>
                <br>


                <div>
                    <p class="normal-14-bold-p gray-title forms-label-student">Etec<span style="color: var(--red);">*</span></p>

                    <p>
                        <?php
                        $nameSchool =  !is_null(Cookie::reader('nameSchool')) ? Cookie::reader('nameSchool') : "Selecione a escola";
                        $schoolDisabled = $nameSchool === "Selecione a escola" ? 'disabled' : "";
                        ?>
                        <select name="nameSchool" id="nameSchool" class="select-school" style="width: 100%" onchange="schoolValue()" required>
                            <option value="<?php echo $nameSchool; ?>" <?php echo $schoolDisabled; ?> selected><?php echo $nameSchool ?></option>
                            <?php for ($i = 0; $i < count($listSchoolsOfSelect); $i++) {
                                $row = $listSchoolsOfSelect[$i] ?>
                                <option value="<?php echo $row->name ?>"> <?php echo $row->name ?> </option>
                            <?php } ?>
                        </select>
                    </p>
                </div>
                <br>

                <div>
                    <p class="normal-14-bold-p gray-title forms-label-student">Curso<span style="color: var(--red);">*</span></p>
                    <p>
                        <select name="nameCourse" id="nameCourse" class="select-course" style="width: 100%" disabled required>
                            <option value="" disabled selected>Selecione o curso</option>
                        </select>
                    </p>
                </div>
                <br>


                <div>
                    <p class="normal-14-bold-p gray-title forms-label-student">Módulo<span style="color: var(--red);">*</span></p>
                    <p>
                        <?php
                        $nameModule =  !is_null(Cookie::reader('nameModule')) ? Cookie::reader('nameModule') : "Selecione o módulo";
                        $moduleDisabled = $nameModule === "Selecione o módulo" ? 'disabled' : "";
                        ?>
                        <select name="nameModule" id="nameModule" class="select-module" style="width: 100%" required>
                            <option value="<?php echo $nameModule; ?>" <?php echo $moduleDisabled ?> selected><?php echo $nameModule; ?></option>
                            <?php for ($i = 0; $i < count($listModulesOfSelect); $i++) {
                                $row = $listModulesOfSelect[$i] ?>
                                <option value="<?php echo $row->name ?>"> <?php echo $row->name ?> </option>
                            <?php } ?>
                        </select>
                    </p>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" style=" color: inherit; text-decoration: inherit; text-decoration:none;"><span class="normal-12-bold-tiny blue-title">Não encontrou o seu dado? Clique aqui.</span></a>
                </div>
                <br>


                <hr>
                <label class="normal-18-bold-title-2">Links</label>
                <p>
                <p class="normal-14-medium-p">Linkedin</p>
                <?php $linkedin =  !is_null(Cookie::reader('linkedin')) ? Cookie::reader('linkedin') : ''; ?>
                <input class="normal-12-regular-tinyinput input-text" type="text" name="linkedin" id="linkedin" placeholder="Copie e cole a URL" autocomplete="off" value="<?php echo $linkedin; ?>">
                </p>

                <p>
                <p class="normal-14-medium-p">GitHub</p>
                <?php $github =  !is_null(Cookie::reader('github')) ? Cookie::reader('github') : ''; ?>
                <input class="normal-12-regular-tinyinput input-text" type="text" name="github" id="github" placeholder="Copie e cole a URL" autocomplete="off" value="<?php echo $github; ?>">
                </p>

                <p>
                <p class="normal-14-medium-p">Facebook</p>
                <?php $facebook =  !is_null(Cookie::reader('facebook')) ? Cookie::reader('facebook') : ''; ?>
                <input class="normal-12-regular-tinyinput input-text" type="text" name="facebook" id="facebook" placeholder="Copie e cole a URL" autocomplete="off" value="<?php echo $facebook; ?>">
                </p>

                <p>
                <p class="normal-14-medium-p">Instagram</p>
                <?php $instagram =  !is_null(Cookie::reader('instagram')) ? Cookie::reader('instagram') : ''; ?>
                <input class="normal-12-regular-tinyinput input-text" type="url" name="instagram" id="instagram" placeholder="Copie e cole a URL" autocomplete="off" value="<?php echo $instagram; ?>">
                </p>
                <input type="submit" class="register button-wide submit-button-primary normal-14-bold-p" value="Continuar" name="step2">
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel"> Solicitação de informações </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3 needs-validation" action="./controller/register-solicitation-category.controller.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email para contato</label>
                            <input name="contact" type="email" class="form-control" id="exampleFormControlInput1" required placeholder="contato@email.com" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <select required name="selectCategory_id" id="selectCategory_id">
                                <option value="">Selecione a Categoria</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1">Titulo</label>
                            <input name="title" type="text" class="form-control" id="title" placeholder="Digite o título da informação" required autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Em que podemos ajudar</label>
                            <div id="contentTextArea"><textarea name="description" id="description" class="form-control" cols="30" rows="10" placeholder="Nos conte como foi/está sendo a sua experiência" onclick="colorDiv();" required maxlength="200"></textarea></div>
                            <div><span id="counterTextArea">200</span></div>
                            <hr>
                        </div>
                        <div class="col-12">
                            <input class="btn btn-primary" type="submit" value="Enviar" name="register" onclick="GFG_Fun()"></input>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

                        </div>
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
        $(".select-school").select2({
            allowClear: true
        });

        $(".select-module").select2({
            allowClear: true
        });

        $(".select-course").select2({
            allowClear: true
        });
    </script>

    <script>
        function getCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        async function schoolValue() {
            const select = document.getElementById("nameSchool");
            const courseList = document.getElementById("nameCourse");
            const courseCookie = getCookie('nameCourse');
            const course = decodeURI(courseCookie);

            if (select.value != "Selecione a escola") {
                courseList.disabled = false;
                const dados = await fetch('./controller/json-step2.controller.php?nameSchool=' + select.value);

                const json_school = await dados.json();
                const convert_into_string = JSON.stringify(json_school);
                const object_school = JSON.parse(convert_into_string);

                courseList.innerHTML = "";

                array_courses = object_school['course'];

                for (i = 0; i < array_courses.length; i++) {
                    const optionElement = document.createElement("option");

                    optionElement.value = array_courses[i]['name'];
                    optionElement.textContent = array_courses[i]['name'];
                    optionElement.selected = course == array_courses[i]['name'];

                    courseList.appendChild(optionElement);
                }

                return;
            }
            courseList.disabled = true;

        }

        (async function() {
            await schoolValue();
        }());
    </script>

    <script>
        const category = document.getElementById("category_id");
        if (category) {
            listCategory();
        }

        async function listCategory() {
            await fetch('listCategory');
        }
    </script>

    <!-- JS Select da Categoria ⬇️ -->
    <script>
        const selectCategory = document.getElementById("selectCategory_id");

        if (selectCategory) {
            selectCategorySolicitation();
        }

        async function selectCategorySolicitation() {
            const dados = await fetch('./controller/list-category.controller.php');
            const json_category = await dados.json();
            // console.log(json_category)

            if (json_category['status']) {
                var option = "<option value=''>Selecione a Categoria</option>'";
                for (var i = 0; i < json_category.dados.length; i++) {
                    // console.log(json_category.dados[i]['id']);
                    // console.log(json_category.dados[i]['name']);
                    option += '<option value="' + json_category.dados[i]['id'] + '">' + json_category.dados[i]['name'] + '</option>';
                }
                selectCategory.innerHTML = option;
            }
        }
    </script>

    <script>
        //  JS APENAS permitir: letras, acentuação, espaço e hífen 
        $('#firstName, #surname').on('keypress', function(event) {
            var regex = new RegExp("^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        });
    </script>

    <!-- JS bloquear colagem (paste) -->

    <script>
        var myElement = document.getElementById('firstName');

        myElement.addEventListener('paste', e => e.preventDefault());
    </script>

    <script>
        var myElementSurname = document.getElementById('surname');
        myElementSurname.addEventListener('paste', e => e.preventDefault());
    </script>
</body>

</html>