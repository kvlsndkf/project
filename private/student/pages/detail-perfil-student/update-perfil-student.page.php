<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-student.controller.php');
require_once('/xampp/htdocs' . '/project/classes/users/StudentMethods.class.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Module.class.php');

try {
    $idStudent = $_GET['idStudentLogged'];

    $student = new StudentMethods();
    $studentPerfil = $student->getDataStudentByID($idStudent);

    $module = new Module();
    $listModules = $module->getModuleForStudentUpdate($studentPerfil->moduleId);
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

    <form action="./controller/update-perfil-student.controller.php?idStudentLogged=<?php echo $studentPerfil->id; ?>&idUser=<?php echo $studentPerfil->userId; ?>" method="post" enctype="multipart/form-data">

        <img src="<?php echo $studentPerfil->photo; ?>" alt="<?php echo $studentPerfil->firstName; ?>" width="150" id="imageFile">
        <p>
            <input type="hidden" name="oldPhoto" value="<?php echo $studentPerfil->photo; ?>">
            <input type="file" name="updatePhoto" id="" onchange="previewImage(this)">
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
            <select name="module" class="selectModule w-100">
                <optgroup label="Módulo atual">
                    <option value="<?php echo $studentPerfil->moduleId; ?>"><?php echo $studentPerfil->module; ?></option>
                </optgroup>

                <optgroup label="Lista de módulos">
                    <?php for ($i = 0; $i < count($listModules); $i++) {
                        $row = $listModules[$i] ?>
                        <option value="<?php echo $row->id ?>"> <?php echo $row->name ?> </option>
                    <?php } ?>
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
                            <input type="text" name="github" id="" value="<?php echo $studentPerfil->github; ?>">
                        </p>

                        <p>
                            <label for="">Facebook</label>
                            <input type="text" name="facebook" id="" value="<?php echo $studentPerfil->facebook; ?>">
                        </p>

                        <p>
                            <label for="">Instagram</label>
                            <input type="text" name="instagram" id="" value="<?php echo $studentPerfil->instagram; ?>">
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

                        <p>
                            <label for="">Senha antiga</label>
                            <input type="password" name="oldPassword" id="" placeholder="Digite a sua senha antiga">
                        </p>

                        <p>
                            <label for="">Senha atual</label>
                            <input type="password" name="newPassword" id="" placeholder="Digite a sua nova senha">
                        </p>

                        <p>
                            <label for="">Confirme a sua senha atual</label>
                            <input type="password" name="passwordConfirm" id="" placeholder="Confirme a sua senha">
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <p>
            <input type="button" value="Cancelar"  onclick="history.go(-1)">
            <input type="submit" name="update" value="Atualizar perfil">
        </p>
    </form>

    <!-- JS JQuery ⬇️ -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- JS Bootstrap ⬇️ -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <!-- JS Select Multiple ⬇️ -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(".selectModule").select2({
            allowClear: true
        });
    </script>

    <script>
        function previewImage(self) {
            const imageFile = document.getElementById("imageFile");
            const file = self && self.files[0];

            if (!file) {
                imageFile.style.display = "none";
                return;
            }

            if (file) {
                imageFile.style.display = "block";
                imageFile.src = URL.createObjectURL(file);
                return;
            }
        }
    </script>
</body>

</html>