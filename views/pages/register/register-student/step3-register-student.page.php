<?php
require_once('/xampp/htdocs' . '/project/classes/cookies/Cookie.class.php');

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identificação | Heelp!</title>

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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

    <div class="h-100 w-100 d-flex align-items-center justify-content-center">
        <div class="bg-modal-gray align-self-center my-auto form-base-plump">
            <div class="d-flex justify-content-between">
                <a href="./step2-register-student.page.php"><img src="../../../../private/adm/images/components/arrow.svg" alt="Seta para voltar" class="mb-2"></a>


                <label class="normal-14-bold-p">Etapa 3/4</label>
            </div>
            <div class="text-center form-student-titles">
                <span class="normal-22-black-title-1 gray-title">Bora lá...</span>
                <br />
                <span class="nord-32-black-display">Identificação</span>
            </div>
            <form action="./controller/step3-cookie.controller.php" method="post" enctype="multipart/form-data">
                <label class="normal-18-bold-title-2">Foto<span style="color: var(--red);">*</span></label>
                <br>
                <?php
                $photoCookie =  !is_null(Cookie::reader('photoUser')) ? Cookie::reader('photoUser') : '';
                $photoRequired = !empty($photoCookie) ? "" : 'required';
                ?>
                <div id="img-container">
                    <div id="pathCookie" class="current-photo"></div>
                </div>
                <div id="another-img-container">
                    <img src="#" alt="" id="imageFile">
                </div>


                <input type="hidden" name="oldPhoto" value="<?php echo $photoCookie; ?>">
                <input type="file" class="photo" name="photo" id="photo" <?php echo $photoRequired; ?> onchange="cookiePhoto(this)">

                <label for="photo" class="add-arch normal-14-bold-p">Adicionar arquivos</label>

                <span id="step3" class="slc-arch normal-12-medium-tiny gray-text-6">Nenhum arquivo selecionado</span>
                <br>
                <input type="submit" class="register normal-14-bold-p" value="Continuar" name="step3" onclick="GFG_Fun()">
            </form>
        </div>
    </div>


    <!-- JS Bootstrap ⬇️ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

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

        function cookiePhoto(self = null) {
            const pathCookie = getCookie('photoUser');
            const path = decodeURIComponent(pathCookie);
            const divPhoto = document.getElementById("pathCookie");

            const imageFile = document.getElementById("imageFile");
            const file = self && self.files[0];

            if (!file && !pathCookie) {
                divPhoto.style.display = "none";
                imageFile.style.display = "none";
                return;
            }

            if (file) {
                divPhoto.style.display = "none";
                imageFile.style.display = "block";

                const imgContainer = document.getElementById("img-container");
                imgContainer.className = "img-container";

                const anotherImgContainer = document.getElementById("another-img-container");
                imgContainer.classList = "d-none";

                anotherImgContainer.className = "img-container";

                imageFile.src = URL.createObjectURL(file);
                return;
            }

            divPhoto.style.display = "block";

            imageFile.style.display = "none";
            const image = document.createElement("img");
            
            imageFile.className = "current-photo";
            image.className = "current-photo";
            divPhoto.className = "img-container";
            image.src = path;

            divPhoto.appendChild(image);
        }


        (function() {
            cookiePhoto();
        }());
    </script>

    <!-- JS arquvio selecionado -->
    <script type="text/javascript">
        let inputFile = document.getElementById('photo');
        let fileNameField = document.getElementById('step3');
        inputFile.addEventListener('change', function(event) {
            let uploadedFileName = event.target.files[0].name;
            fileNameField.textContent = uploadedFileName;
        });

        var down = document.getElementById('step3');
        var file = document.getElementById("photo");
        var uploadedFileName = event.target.files[0].name;


        function GFG_Fun() {
            if (file.files.length == 0) {
                down.style.color = "#ED4245";
                down.innerText = "SELECIONE UM ARQUIVO!";
            } else {
                true
            }
        }
    </script>
</body>

</html>