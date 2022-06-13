<?php
require_once('/xampp/htdocs' . '/project/classes/schools/Course.class.php');
require_once('/xampp/htdocs' . '/project/classes/cookies/Cookie.class.php');

try {
    $nameCourse = Cookie::reader('nameCourse') ?? '';
    $course = new Course();
    $listCoursesOfSelect = $course->filteredCourseSelect($nameCourse);
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
    <title>Preferências | Heelp!</title>

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
<div class="h-100 w-100 d-flex align-items-center justify-content-center">
<div class="bg-modal-gray align-self-center my-auto form-base-plump">
<div class="d-flex justify-content-between">
<a href="./step3-register-student.page.php"><img src="../../../../private/adm/images/components/arrow.svg" alt="Seta para voltar" class="mb-2"></a>
    <label class="normal-14-bold-p">Etapa 4/4</label>
</div>
            <div class="text-center form-student-titles">
                <span class="normal-22-black-title-1 gray-title">Pronto! Essa é a ultima etapa!</span>
                <br/>
                <span class="responsive-title">Queremos saber suas preferências!</span>
                <br/>
                <p class="normal-18-bold-title-2" style="margin-top: 40px;">Além do seu curso, quais são os outros que você acha interessante?</p>
            </div>
    <form action="./controller/step4-cookie.controller.php" method="post">

        <p>
            <select name="idCourses[]" id="idCourses" class="multiple-select school-select w-100" style="width: 100%" multiple="multiple">
                <?php for ($i = 0; $i < count($listCoursesOfSelect); $i++) {
                    $row = $listCoursesOfSelect[$i] ?>
                    <option value="<?php echo $row->id ?>"> <?php echo $row->name ?> </option>
                <?php } ?>
            </select>
        </p>
        <p class="normal-12-bold-tiny gray6-title">essa etapa não é obrigatória.</p>
        <input type="submit" value="Solicitar acesso" class="register normal-14-bold-p" name="step4" id="step4" onclick="loading()">
    </form>
</div>
</div>
</body>

<!-- JS JQuery ⬇️ -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!-- JS Bootstrap ⬇️ -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

<!-- JS Select Multiple ⬇️ -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(".multiple-select").select2({
        placeholder: "Escolha dois cursos",
        allowClear: true,
        maximumSelectionLength: 2
    });
</script>

<script>
    function loading() {
        document.getElementById("step4").value = "Solicitando...";
    }
</script>

</html>