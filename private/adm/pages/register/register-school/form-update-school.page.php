<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-administrator.controller.php');
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Teacher.class.php');
require_once('/xampp/htdocs' . '/project/classes/places/Place.class.php');
require_once('/xampp/htdocs' . '/project/classes/schools/School.class.php');


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

    <link rel="stylesheet" href="../../../../style/style.css">

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- CSS styles -->
    <link rel="stylesheet" href="../../../../style/form-register-teacher.page.css">
    <link rel="stylesheet" href="../../../../style/form-update-teacher.style.css">
    <link rel="stylesheet" href="../../../../../views/styles/style.global.css">
    <link rel="stylesheet" href="../../../../../views/styles/font-format.style.css">
    <link rel="stylesheet" href="../../../../../views/styles/fonts.style.css">
    <link rel="stylesheet" href="../../../../../views/styles/colors.style.css">
    <link rel="stylesheet" href="../../../../../views/styles/button.style.css">
    <link rel="shortcut icon" href="../../../../../views/images/favicon/favicon-16x16.png" type="image/x-icon">
</head>

<body>
    <div class="my-container-er">
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


        <div class="page-container d-flex align-items-center justify-content-center">
            <div class="form-base bg-modal-gray align-self-center my-auto">
                <form action="./controller/update-school.controller.php?updateSchool=<?php echo $updateSchool['id'] ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-header">
                        <a href="./list-school.page.php">
                            <img src="../image/form-teacher/components/arrow.svg" class="arrow" alt="Botão de voltar">
                        </a>
                        <label class="normal-20-bold-modaltitle title-header">Cadastro Etec</label>
                    </div>
                    <p>
                        <label class="normal-14-medium-p nome-professor">
                            Nome Etec
                        </label>
                        <input type="text" name="updateName" class="normal-12-regular-tinyinput input-text" id="updateName" autocomplete="off" required value="<?php echo $updateSchool['name'] ?>" minlength="10" pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$">
                    </p>

                    <div class="etec-location-label">
                        <p class="normal-14-medium-p etec-location-label">
                            A Etec fica localizada dentro da cidade de São Paulo?
                        </p>
                    </div>
                    <p>
                        <?php $checkedDistrict = !empty($updateSchool['in_sp_city']) ? 'checked' : 'disabled'; ?>
                        <input type="checkbox" name="districtSchool" id="checkDistrict" value="Inside city" <?php echo $checkedDistrict ?> onclick="visibilityDistrict()"><span class="normal-14-medium-p nome-professor checkbox-label"> Sim</span>

                        <?php $checkedCity = !empty($updateSchool['not_in_sp_city']) ? 'checked' : 'disabled'; ?>
                        <input type="checkbox" name="citySchool" id="checkCity" value="Outside city" <?php echo $checkedCity ?> onclick="visibilityCity()"><span class="normal-14-medium-p nome-professor checkbox-label"> Não</span>
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

                    <p class="label-social normal-14-medium-p nome-professor">
                        <?php $checkedAccount = $updateSchool['have_account'] === "Com conta" ? 'checked' : ''; ?>
                        <input type="checkbox" name="createAccount" id="createAccount" <?php echo $checkedAccount ?> onclick="createdAccount()" value="createdAccount">
                        <input type="hidden" name="haveAccount" value="<?php echo $updateSchool['have_account'] ?>">
                        <span style="display: inline-block;">
                            <span class="label-social">Criar um perfil para a Etec?</span>
                        </span>
                    </p>
                    <p class="span-warning-school normal-12-bold-tiny gray-text-6 mb-3">
                        Os campos abaixo só ficarão habilitados se escolher criar um perfil para a Etec.
                    </p>

                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item" style="border: none;">
                            <h3 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed accordion-button acc-btn collapsed normal-12-regular-tinyinput" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Dados para o perfil
                                </button>
                            </h3>

                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body" style="background-color: var(--bg-modal);">

                                    <p>
                                        <label class="normal-14-medium-p">Selecione os professores a que ela pertence</label>
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



                                    <hr class="dropdown-divider">


                                    <div>
                                        <p class="normal-14-medium-p">
                                            Sobre
                                        </p>

                                        <div id="contentTextArea">
                                            <?php $disableAbout = $updateSchool['have_account'] === "Com conta" ?: 'disabled'; ?>
                                            <textarea name="about" id="about" cols="30" rows="10" placeholder="Faça um breve texto contando sobre a Etec, ele aparecerá na página de perfil da mesma" class="text-area normal-14-medium-p" <?php echo $disableAbout; ?> onclick="colorDiv()"><?php echo $updateSchool['about'] ?></textarea>
                                            <div class="counter-container"><span id="counterTextArea" class="counterTextArea whitney-8-medium-littletiny">250</span></div>
                                        </div>

                                        <p>

                                        </p>
                                    </div>


                                    <hr class="dropdown-divider">


                                    <label class="normal-18-bold-title-2">Links</label>
                                    <p>
                                        <?php $disableLinkedin = $updateSchool['have_account'] === "Com conta" ?: 'disabled'; ?>
                                    <p class="normal-14-medium-p label-social">
                                        Linkedin
                                    </p>
                                    <input type="text" name="linkedin" id="linkedin" class="disabled-area normal-12-regular-tinyinput input-text input-social" placeholder="Copie e cole a URL" <?php echo $disableLinkedin ?> autocomplete="off" value="<?php echo $updateSchool['linkedin'] ?>">

                                    </p>

                                    <p>
                                        <?php $disableGithub = $updateSchool['have_account'] === "Com conta" ?: 'disabled'; ?>
                                    <p class="normal-14-medium-p label-social">
                                        GitHub
                                    </p>
                                    <input type="text" name="github" id="github" class="disabled-area normal-12-regular-tinyinput input-text input-social" placeholder="Copie e cole a URL" <?php echo $disableGithub ?> autocomplete="off" value="<?php echo $updateSchool['github'] ?>">

                                    </p>

                                    <p>
                                        <?php $disableFacebook = $updateSchool['have_account'] === "Com conta" ?: 'disabled'; ?>
                                    <p class="normal-14-medium-p label-social">
                                        Facebook
                                    </p>
                                    <input type="text" name="facebook" id="facebook" class="disabled-area normal-12-regular-tinyinput input-text input-social" placeholder="Copie e cole a URL" <?php echo $disableFacebook ?> autocomplete="off" value="<?php echo $updateSchool['facebook'] ?>">

                                    </p>

                                    <p>
                                        <?php $disableInstagram = $updateSchool['have_account'] === "Com conta" ?: 'disabled'; ?>
                                    <p class="normal-14-medium-p label-social">
                                        Instagram
                                    </p>
                                    <input type="url" name="instagram" id="instagram" class="disabled-area normal-12-regular-tinyinput input-text input-social" placeholder="Copie e cole a URL" <?php echo $disableInstagram ?> autocomplete="off" value="<?php echo $updateSchool['instagram'] ?>">

                                    </p>

                                    <hr class="dropdown-divider">

                                    <p>
                                        <?php $imageSelected = $updateSchool['photo'];
                                        $imageDefault = !empty($updateSchool['photo']) ? $imageSelected : '../../../images/ilustrations/no-image.svg'; ?>
                                        <label class="normal-14-medium-p label-social">Foto atual</label><br>
                                    <div class="img-container">
                                        <img width="100" class="current-photo" src="<?php echo $imageDefault ?>" alt="Foto <?php echo $updateSchool['name'] ?>">
                                    </div>
                                    </p>

                                    <p>

                                        <?php $disablePhoto = $updateSchool['have_account'] === "Com conta" ?: 'disabled'; ?>
                                        <?php $requiredPhoto = empty($updateSchool['photo']) ? 'required' : '' ?>
                                        <input type="file" class="photo" name="updatePhoto" id="photo" <?php echo $disablePhoto; ?> <?php echo $requiredPhoto; ?>>
                                        <label for="photo" class="add-arch normal-14-bold-p">Adicionar arquivos</label>
                                        <span id="file-name" class="slc-arch normal-12-medium-tiny gray-text-6">Nenhum arquivo selecionado</span>
                                        <input type="hidden" name="oldPhoto" id="oldPhoto" value="<?php echo $updateSchool['photo'] ?>">
                                    </p>


                                    <hr class="dropdown-divider">


                                </div>
                            </div>
                        </div>
                    </div>


                    <input type="submit" class="button-wide button-white-white-text normal-14-bold-p register" style="margin-top: 60px;" value="Editar" name="update">
                    <a href="./list-school.page.php"><button class="button-wide button-white-primary-text clean normal-14-bold-p" type="button">Cancelar</button></a>
                </form>
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

    <!-- JS Count Characters TextArea -->
    <script type="text/javascript" src="../../js/textarea.js"></script>

    <!-- JS arquvio selecionado -->
    <script>
        let inputFile = document.getElementById('photo');
        let fileNameField = document.getElementById('file-name');
        inputFile.addEventListener('change', function(event) {
            let uploadedFileName = event.target.files[0].name;
            fileNameField.textContent = uploadedFileName;
        })
    </script>
</body>

</html>