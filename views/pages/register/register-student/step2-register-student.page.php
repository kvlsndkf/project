<?php
require_once('/xampp/htdocs' . '/project/classes/cookies/Cookie.class.php');
require_once('/xampp/htdocs' . '/project/classes/schools/School.class.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Module.class.php');

try {
    $school = new School();
    $listSchoolsOfSelect = $school->listSchoolsOfSelectResgisterCourse();

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

    <form action="./controller/student-cookie.controller.php" method="post">
        <div>
            Primeiro nome
            <br>
            <?php $firstName =  !is_null(Cookie::reader('firstName')) ? Cookie::reader('firstName') : ''; ?>
            <input type="text" name="firstName" id="firstName" required autocomplete="off" autofocus value="<?php echo $firstName; ?>">
        </div>
        <br>
        <br>


        <div>
            Sobrenome
            <br>
            <?php $surname =  !is_null(Cookie::reader('surname')) ? Cookie::reader('surname') : ''; ?>
            <input type="text" name="surname" id="surname" required autocomplete="off" value="<?php echo $surname; ?>">
        </div>
        <br>
        <br>


        <div>
            Etec
            <p>
                <select name="idSchool" id="idSchool" class="select-school" style="width: 100%" required>
                    <option value="" selected disabled>Selecione a etec</option>
                    <?php for ($i = 0; $i < count($listSchoolsOfSelect); $i++) {
                        $row = $listSchoolsOfSelect[$i] ?>
                        <option value="<?php echo $row->id ?>"> <?php echo $row->name ?> </option>
                    <?php } ?>
                </select>
            </p>
        </div>
        <br>
        <br>

        <div>
            Curso
            <p>
                <select name="idCourse" id="idCourse" class="select-course" style="width: 100%" required>
                    <option value="" selected disabled>Selecione o curso</option>
                    <?php for ($i = 0; $i < count($listSchoolsOfSelect); $i++) {
                        $row = $listSchoolsOfSelect[$i] ?>
                        <option value="<?php echo $row->id ?>"> <?php echo $row->name ?> </option>
                    <?php } ?>
                </select>
            </p>
        </div>
        <br>
        <br>


        <div>
            Módulo
            <p>
                <select name="idModule" id="idModule" class="select-module" style="width: 100%" required>
                    <option value="" selected disabled>Selecione o modulo</option>
                    <?php for ($i = 0; $i < count($listModulesOfSelect); $i++) {
                        $row = $listModulesOfSelect[$i] ?>
                        <option value="<?php echo $row->id ?>"> <?php echo $row->name ?> </option>
                    <?php } ?>
                </select>
            </p>
        </div>
        <br>
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
            placeholder: "Selecione a escola",
            allowClear: true
        });

        $(".select-module").select2({
            placeholder: "Selecione a escola",
            allowClear: true
        });
    </script>
</body>

</html>