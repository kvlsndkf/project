<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-student.controller.php');
require_once('/xampp/htdocs' . '/project/classes/users/StudentMethods.class.php');

try {
    $idStudent = $_GET['idStudentLogged'];

    $student = new StudentMethods();
    $studentPerfil = $student->getDataStudentByID($idStudent);
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
    <title>Editar perfil | Heelp!</title>

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <form action="" method="post" enctype="">

        <img src="<?php echo $studentPerfil->photo; ?>" alt="<?php echo $studentPerfil->firstName; ?>" width="150">
        <p>
            <input type="hidden" name="oldPhoto" value="<?php echo $studentPerfil->photo; ?>">
            <input type="file" name="" id="">
        </p>

        Dados principais
        <p>
            <label for="">Nome</label>
            <input type="text" name="firstName" id="" value="<?php echo $studentPerfil->firstName; ?>">
        </p>

        <p>
            <label for="">Sobrenome</label>
            <input type="text" name="surname" id="" value="<?php echo $studentPerfil->surname; ?>">
        </p>

        <p>
            <label for="">Módulo</label>
            <select name="module">
                <optgroup label="Módulo atual">
                    <option value="<?php echo $studentPerfil->moduleId; ?>"><?php echo $studentPerfil->module; ?></option>
                </optgroup>

                <optgroup label="Lista de módulos">

                </optgroup>
            </select>
        </p>

        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Links
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <p>
                            <label for="">Linkedin</label>
                            <input type="text" name="linkedin" id="" value="<?php echo $studentPerfil->linkedin; ?>">
                        </p>

                        <p>
                            <label for="">GitHub</label>
                            <input type="text" name="" id="" value="<?php echo $studentPerfil->github; ?>">
                        </p>

                        <p>
                            <label for="">Facebook</label>
                            <input type="text" name="" id="" value="<?php echo $studentPerfil->facebook; ?>">
                        </p>

                        <p>
                            <label for="">Instagram</label>
                            <input type="text" name="" id="" value="<?php echo $studentPerfil->instagram; ?>">
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        Senha
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">


                    </div>
                </div>
            </div>
        </div>

        <p>
            <input type="button" value="Cancelar">
            <input type="submit" value="Atualizar perfil">
        </p>
    </form>

    <!-- JS JQuery ⬇️ -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- JS Bootstrap ⬇️ -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>