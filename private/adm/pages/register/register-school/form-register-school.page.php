<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Teacher.class.php');
require_once('/xampp/htdocs' . '/project/classes/places/Place.class.php');

session_start();

try {
    $teacher = new Teacher();
    $listTeachersOfSelect = $teacher->listTeachersOfSelectResgisterSchool();

    $place = new Place();
    $places = $place->getPlaces();
} catch (Exception $e) {
    echo $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar Etec | Heelp!</title>

    <link rel="stylesheet" href="https://stackedit.io/style.css" />

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

    <label>Cadastro Etec</label>

    <form action="./controller/school-unit-registration.controller.php" method="POST" enctype="multipart/form-data">
        <p>
            Nome Etec
            <input type="text" name="name" id="name" placeholder="Digite o nome da etec" autocomplete="off" required>
        </p>

        <p>
            A Etec fica localizada dentro da cidade de São Paulo?
        </p>

        <p>
            <input type="checkbox" name="isInTheState" id="checkDistrict" value="Sim" onclick="visibilityDistrict()"> Sim

            <input type="checkbox" name="isNotInTheState" id="checkCity" value="Não" onclick="visibilityCity()"> Não
        </p>

        <p id="textDistrict" style="display:none">
            Distrito
            <select name="address" id="district" class="select-district" style="width: 100%" disabled>
                <option selected="selected">Selecione o respectivo distrito</option>
                <?php foreach ($places->districts as $row) { ?>
                    <option value="<?php echo $row->name ?>"> <?php echo $row->name ?> </option>
                <?php } ?>
            </select>
        </p>


        <p id="textCity" style="display:none">
            Município
            <select name="address" id="city" class="select-city" style="width: 100%" disabled>
                <option selected="selected">Selecione o respectivo município</option>
                <?php foreach ($places->cities as $row) { ?>
                    <option value="<?php echo $row->name ?>"> <?php echo $row->name ?> </option>
                <?php } ?>
            </select>
        </p>

        <p>
            <input type="checkbox" name="createAccount" id="createAccount" onclick="createdAccount()" value="createdAccount">
            Criar um perfil para a Etec?
        </p>


        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h3 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Dados para o perfil
                    </button>
                </h3>

                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                        <p>
                            <label>Selecione os professores a que ela pertence</label>
                        </p>
                        <p>
                            <select name="idTeachers[]" id="idTeachers" class="multiple-select w-100" style="width: 100%" multiple="multiple" disabled required>
                                <?php for ($i = 0; $i < count($listTeachersOfSelect); $i++) {
                                    $row = $listTeachersOfSelect[$i] ?>
                                    <option value="<?php echo $row->id ?>"> <?php echo $row->name ?> </option>
                                <?php } ?>
                            </select>
                        </p>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <div>
                            <p>
                                Sobre
                            </p>

                            <p>
                                <textarea class="d-none" cols="30" rows="5" id="textarea" name="about"></textarea>
                                <input type="button" id="about" value="Escrever sobre a Etec" disabled required onclick="aboutSchool()">
                            <div id="divAbout"></div>
                            </p>
                        </div>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <label>Links</label>
                        <p>
                            Linkedin
                            <input type="text" name="linkedin" id="linkedin" placeholder="Copie e cole a URL" disabled required>
                        </p>

                        <p>
                            GitHub
                            <input type="text" name="github" id="github" placeholder="Copie e cole a URL" disabled required>
                        </p>

                        <p>
                            Facebook
                            <input type="text" name="facebook" id="facebook" placeholder="Copie e cole a URL" disabled required>
                        </p>

                        <p>
                            Instagram
                            <input type="url" name="instagram" id="instagram" placeholder="Copie e cole a URL" disabled required>
                        </p>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <p>
                            <label>Foto</label>
                            <input type="file" name="photo" id="photo" required>
                        </p>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                    </div>
                </div>
            </div>
        </div>


        <button type="submit" name="register">Cadastrar</button>
        <button type="reset">Limpar</button>

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
            placeholder: "Selecione os professores",
            allowClear: true
        });

        $(".select-district").select2({
            placeholder: "Selecione o respectivo distrito",
            allowClear: true
        });

        $(".select-city").select2({
            placeholder: "Selecione o respectivo município",
            allowClear: true
        });
    </script>

    <!-- JS Disabled Inputs -->
    <script type="text/javascript" src="../../js/disabled-inputs.js"></script>

    <!-- JS Visibility Inputs -->
    <script type="text/javascript" src="../../js/visibility-inputs.js"></script>

    <!-- JS StackEdit -->
    <script src="https://unpkg.com/stackedit-js@1.0.7/docs/lib/stackedit.min.js"></script>

    <script>
        function aboutSchool() {
            const el = document.getElementById('textarea');
            const stackedit = new Stackedit();

            // Open the iframe
            stackedit.openFile({
                name: 'Filename', // with an optional filename
                content: {
                    text: el.value // and the Markdown content.
                }
            });

            // Listen to StackEdit events and apply the changes to the textarea.
            stackedit.on('fileChange', (file) => {
                el.value = file.content.text;
            });

            // In silent mode, the `fileChange` event is emitted only once.
            stackedit.on('fileChange', (file) => {
                const divEl = document.getElementById("divAbout");
                divEl.innerHTML = file.content.html;
                console.log(file);
            });
        }
    </script>
</body>

</html>