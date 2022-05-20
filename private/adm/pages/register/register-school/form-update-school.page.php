<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Teacher.class.php');
require_once('/xampp/htdocs' . '/project/classes/places/Place.class.php');
require_once('/xampp/htdocs' . '/project/classes/schools/School.class.php');

session_start();

try {
    $teacher = new Teacher();
    $listTeachersOfSelect = $teacher->listTeachersOfSelectResgisterSchool();

    $place = new Place();
    $places = $place->getPlaces();

    $school = new School();

    if (isset($_GET['updateSchool'])) {
        $id = $_GET['updateSchool'];
        $updateSchool = $school->searchSchoolForUpdate($id);
        $teachersUsedBySchool = $school->selectTeachersUsedBySchool($id);
        $teacherAvailable = $school->selectAvailableTeachersForSchool($id);
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Etec | Heelp!</title>

    <link rel="stylesheet" href="https://unpkg.com/@stackoverflow/stacks/dist/css/stacks.min.css">
    <link rel="stylesheet" href="https://unpkg.com/@stackoverflow/stacks-editor/dist/styles.css">

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

    <form action="./controller/update-school.controller.php?updateSchool=<?php echo $updateSchool['id'] ?>" method="POST" enctype="multipart/form-data">
        <p>
            Nome Etec
            <input type="text" name="updateName" id="updateName" autocomplete="off" required value="<?php echo $updateSchool['name'] ?>">
        </p>

        <p>
            A Etec fica localizada dentro da cidade de São Paulo?
        </p>

        <p>
            <?php $checkedDistrict = !empty($updateSchool['in_sp_city']) ? 'checked' : 'disabled'; ?>
            <input type="checkbox" name="districtSchool" id="checkDistrict" value="Inside city" <?php echo $checkedDistrict ?> onclick="visibilityDistrict()"> Sim

            <?php $checkedCity = !empty($updateSchool['not_in_sp_city']) ? 'checked' : 'disabled'; ?>
            <input type="checkbox" name="citySchool" id="checkCity" value="Outside city" <?php echo $checkedCity ?> onclick="visibilityCity()"> Não
        </p>

        <?php $displaySelectDistrict = !empty($updateSchool['in_sp_city']) ? 'display:block' : 'display:none'; ?>
        <p id="textDistrict" style="<?php echo $displaySelectDistrict ?>">
            <?php $disableDistrict = !empty($updateSchool['in_sp_city']) ? '' : 'disabled'; ?>
            Distrito
            <select name="address" id="district" class="select-district" style="width: 100%" <?php echo $disableDistrict ?>>
                <optgroup label="Local atual">
                    <option value="<?php echo $updateSchool['address'] ?>"> <?php echo $updateSchool['address'] ?> </option>
                </optgroup>

                <optgroup label="Distritos disponíveis">
                    <?php foreach ($places->districts as $row) { ?>
                        <option value="<?php echo $row->name ?>"> <?php echo $row->name ?> </option>
                    <?php } ?>
                </optgroup>
            </select>
        </p>

        <?php $displaySelectCity = !empty($updateSchool['not_in_sp_city']) ? 'display:block' : 'display:none'; ?>
        <p id="textCity" style="<?php echo $displaySelectCity ?>">
            <?php $disableCity = !empty($updateSchool['not_in_sp_city']) ? '' : 'disabled'; ?>
            Município
            <select name="address" id="city" class="select-city" style="width: 100%" <?php echo $disableCity ?>>
                <optgroup label="Local atual">
                    <option value="<?php echo $updateSchool['address'] ?>"> <?php echo $updateSchool['address'] ?> </option>
                </optgroup>

                <optgroup label="Municípios disponíveis">
                    <?php foreach ($places->cities as $row) { ?>
                        <option value="<?php echo $row->name ?>"> <?php echo $row->name ?> </option>
                    <?php } ?>
                </optgroup>
            </select>
        </p>

        <p>
            <?php $checkedAccount = $updateSchool['have_account'] === "Com conta" ? 'checked' : ''; ?>
            <input type="checkbox" name="createAccount" id="createAccount" <?php echo $checkedAccount ?> onclick="createdAccount()" value="createdAccount">
            <input type="hidden" name="haveAccount" value="<?php echo $updateSchool['have_account'] ?>">
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
                            <?php $disableSelectTeachers = $updateSchool['have_account'] === "Com conta" ? '' : 'disabled'; ?>
                            <select name="idTeachers[]" id="idTeachers" class="multiple-select w-100" style="width: 100%" multiple="multiple" <?php echo $disableSelectTeachers ?> required>
                                <optgroup label="Professores selecionados">
                                    <?php foreach ($teachersUsedBySchool as $row) { ?>
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


                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <div>
                            <p>
                                Sobre
                            <div>
                                <?php echo $updateSchool['about'] ?>
                            </div>
                            </p>

                            <p>
                                <?php $disableAbout = $updateSchool['have_account'] === "Com conta" ?: 'disabled'; ?>
                                <textarea id="forDataBase" name="aboutForDatabase"class="d-none"></textarea>
                                <input type="button" id="about" value="Atualizar sobre a Etec" <?php echo $disableAbout; ?> onclick="aboutSchool()">
                            <div id="editor-container" style="display: none"></div>
                            </p>
                        </div>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <label>Links</label>
                        <p>
                            <?php $disableLinkedin = $updateSchool['have_account'] === "Com conta" ?: 'disabled'; ?>
                            Linkedin
                            <input type="text" name="linkedin" id="linkedin" placeholder="Copie e cole a URL" <?php echo $disableLinkedin ?> autocomplete="off" value="<?php echo $updateSchool['linkedin'] ?>">
                        </p>

                        <p>
                            <?php $disableGithub = $updateSchool['have_account'] === "Com conta" ?: 'disabled'; ?>
                            GitHub
                            <input type="text" name="github" id="github" placeholder="Copie e cole a URL" <?php echo $disableGithub ?> autocomplete="off" value="<?php echo $updateSchool['github'] ?>">
                        </p>

                        <p>
                            <?php $disableFacebook = $updateSchool['have_account'] === "Com conta" ?: 'disabled'; ?>
                            Facebook
                            <input type="text" name="facebook" id="facebook" placeholder="Copie e cole a URL" <?php echo $disableFacebook ?> autocomplete="off" value="<?php echo $updateSchool['facebook'] ?>">
                        </p>

                        <p>
                            <?php $disableInstagram = $updateSchool['have_account'] === "Com conta" ?: 'disabled'; ?>
                            Instagram
                            <input type="url" name="instagram" id="instagram" placeholder="Copie e cole a URL" <?php echo $disableInstagram ?> autocomplete="off" value="<?php echo $updateSchool['instagram'] ?>">
                        </p>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <p>
                            <?php $imageSelected = $updateSchool['photo'];
                            $imageDefault = !empty($updateSchool['photo']) ? $imageSelected : '../../../images/ilustrations/no-image.svg'; ?>
                            <label>Foto</label>
                            <img width="100" src="<?php echo $imageDefault ?>" alt="Foto <?php echo $updateSchool['name'] ?>">
                        </p>

                        <p>
                            <?php $disablePhoto = $updateSchool['have_account'] === "Com conta" ?: 'disabled'; ?>
                            <?php $requiredPhoto = empty($updateSchool['photo']) ? 'required' : '' ?>
                            <input type="file" name="updatePhoto" id="photo" <?php echo $disablePhoto; ?> <?php echo $requiredPhoto; ?>>
                            <input type="hidden" name="oldPhoto" id="oldPhoto" value="<?php echo $updateSchool['photo'] ?>">
                        </p>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                    </div>
                </div>
            </div>
        </div>


        <input type="submit" value="Editar" name="update">
        <a href="./list-school.page.php"><button type="button">Cancelar</button></a>

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

    <script src="https://unpkg.com/@stackoverflow/stacks/dist/js/stacks.min.js"></script>
    <script src="https://unpkg.com/@highlightjs/cdn-assets@latest/highlight.min.js"></script>
    <script src="https://unpkg.com/@stackoverflow/stacks-editor/dist/app.bundle.js"></script>

    <script>
        function aboutSchool() {

            new window.stacksEditor.StacksEditor(
                document.querySelector("#editor-container"),
                document.querySelector("#forDataBase").value, {}
            );

            document.getElementById("editor-container").style.display = "block";
            const node = document.querySelector("[data-key='insertImage']");
            const div = document.querySelector(".ml24");
            const help = document.querySelector("[data-key='Help']");
            const table = document.querySelector("[data-key='insertTable']");
            const link = document.querySelector("[data-key='toggleLink']");
            const blockCode = document.querySelector("[data-key='toggleCodeblock']");
            const blockquote = document.querySelector("[data-key='toggleBlockquote']");

            node.parentNode.removeChild(node);
            div.innerHTML = "";
            help.parentNode.removeChild(help);
            table.parentNode.removeChild(table);
            link.parentNode.removeChild(link);
            blockCode.parentNode.removeChild(blockCode);
            blockquote.parentNode.removeChild(blockquote);

            document.getElementById("editor-container").addEventListener("keyup", touchHandler, false);

            function touchHandler(e) {
                // document.querySelector("#forTextArea").innerText = event.target.innerText;
                document.querySelector("#forDataBase").innerHTML = event.target.innerHTML;
            }
        }
    </script>
</body>

</html>