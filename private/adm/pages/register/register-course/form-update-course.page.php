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

</head>

<body>
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

    <label>Cadastro curso</label>
    <form action="./controller/update-course.controller.php?updateCourse=<?php echo $updateCourse['id'] ?>" method="post" enctype="multipart/form-data">
        <p>
            Nome
            <input type="text" name="updateName" id="updateName" required autocomplete="off" value="<?php echo $updateCourse['name'] ?>">
        </p>

        <p>
            <label>Selecione as Etec's a que ele pertence</label>
        </p>

        <p>
            <select name="idSchools[]" id="idSchools" class="multiple-select w-100" required style="width: 100%" multiple="multiple" required>
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

        <p>
            <label>Selecione os professores a que lecionam este curso</label>
        </p>

        <p>
            <select name="idTeachers[]" id="idTeachers" class="multiple-select w-100" required style="width: 100%" multiple="multiple" required>
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

        <p>
            <label>Selecione as matérias deste curso</label>
        </p>

        <p>
            <select name="idSubjects[]" id="idSubjects" class="multiple-select w-100" required style="width: 100%" multiple="multiple" required>
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
            <p>
                Sobre
            </p>

            <div id="contentTextArea">
                <textarea name="about" id="about" cols="30" rows="10" required onclick="colorDiv()"><?php echo $updateCourse['about'] ?></textarea>
                <div><span id="counterTextArea">250</span></div>
            </div>
        </div>

        <hr>

        <p>
            <label>Foto</label>
            <br>
            <img width="50" src="<?php echo $updateCourse['photo'] ?>" alt="Foto <?php echo $updateCourse['name'] ?>">
            <br>
            <input type="file" name="updatePhoto" id="updatePhoto">
            <input type="hidden" name="oldPhoto" id="oldPhoto" value="<?php echo $updateCourse['photo'] ?>">
        </p>

        <hr>

        <input type="submit" value="Editar" name="update">
        <a href="./list-course.page.php"><button type="button">Cancelar</button></a>
    </form>

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

</body>

</html>