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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preferências | Heelp!</title>

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <a href="./step3-register-student.page.php">Voltar</a>
    <br>
    <br>
    <label>Etapa 4/4</label>
    <br>
    <br>
    <form action="./controller/step4-cookie.controller.php" method="post">
        <p>
            <label>Cursos</label>
        </p>

        <p>
            <select name="idCourses[]" id="idCourses" class="multiple-select school-select w-100" style="width: 100%" multiple="multiple">
                <?php for ($i = 0; $i < count($listCoursesOfSelect); $i++) {
                    $row = $listCoursesOfSelect[$i] ?>
                    <option value="<?php echo $row->id ?>"> <?php echo $row->name ?> </option>
                <?php } ?>
            </select>
        </p>
        <input type="submit" value="Solicitar acesso" name="step4" id="step4" onclick="loading()">
    </form>
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
    function loading(){
        document.getElementById("step4").value = "Solicitando...";
    }
</script>

</html>