<?php
require_once('/xampp/htdocs' . '/project/classes/cookies/Cookie.class.php');
require_once('/xampp/htdocs' . '/project/classes/schools/School.class.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Module.class.php');

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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados pessoais | Heelp!</title>

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <a href="./step1-register-student.page.php">Voltar</a>
    <br>
    <br>

    <label for="">Etapa 2/4</label>
    <br>
    <br>

    <label for="">Dados pessoais</label>
    <br>
    <br>

    <form action="./controller/step2-cookie.controller.php" method="post">
        <div>
            Primeiro nome
            <br>
            <?php $firstName =  !is_null(Cookie::reader('firstName')) ? Cookie::reader('firstName') : ''; ?>
            <input type="text" name="firstName" id="firstName" required autocomplete="off" autofocus value="<?php echo $firstName; ?>">
        </div>
        <br>


        <div>
            Sobrenome
            <br>
            <?php $surname =  !is_null(Cookie::reader('surname')) ? Cookie::reader('surname') : ''; ?>
            <input type="text" name="surname" id="surname" required autocomplete="off" value="<?php echo $surname; ?>">
        </div>
        <br>


        <div>
            Etec
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
            Curso
            <p>
                <select name="nameCourse" id="nameCourse" class="select-course" style="width: 100%" disabled required>
                    <option value="" disabled selected>Selecione o curso</option>
                </select>
            </p>
        </div>
        <br>


        <div>
            Módulo
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
        </div>
        <br>


        <hr>
        <label>Links</label>
        <p>
            Linkedin
            <?php $linkedin =  !is_null(Cookie::reader('linkedin')) ? Cookie::reader('linkedin') : ''; ?>
            <input type="text" name="linkedin" id="linkedin" placeholder="Copie e cole a URL" autocomplete="off" value="<?php echo $linkedin; ?>">
        </p>

        <p>
            GitHub
            <?php $github =  !is_null(Cookie::reader('github')) ? Cookie::reader('github') : ''; ?>
            <input type="text" name="github" id="github" placeholder="Copie e cole a URL" autocomplete="off" value="<?php echo $github; ?>">
        </p>

        <p>
            Facebook
            <?php $facebook =  !is_null(Cookie::reader('facebook')) ? Cookie::reader('facebook') : ''; ?>
            <input type="text" name="facebook" id="facebook" placeholder="Copie e cole a URL" autocomplete="off" value="<?php echo $facebook; ?>">
        </p>

        <p>
            Instagram
            <?php $instagram =  !is_null(Cookie::reader('instagram')) ? Cookie::reader('instagram') : ''; ?>
            <input type="url" name="instagram" id="instagram" placeholder="Copie e cole a URL" autocomplete="off" value="<?php echo $instagram; ?>">
        </p>
        <input type="submit" value="Continuar" name="step2">
    </form>

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
                console.log("value", select.value);
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
</body>

</html>