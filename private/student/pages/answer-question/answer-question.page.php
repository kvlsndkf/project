<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-student.controller.php');
require_once('/xampp/htdocs' . '/project/classes/questions/Question.class.php');

try {
    $id = $_GET['idQuestion'];
    $question = new Question();
    $listDetailsQuestions = $question->listDetailsQuestion($id);
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
    <title>Responder pergunta | Heelp!</title>

    <!-- Include stylesheet -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <!-- Include stylesheet -->
    <link href="../../../style/editor-style/editor.style.css" rel="stylesheet">

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="../../../../libs/dist/magnific-popup.css">

    <!-- CSS global -->
    <link rel="stylesheet" href="../../../../views/styles/colors.style.css">
    <link rel="stylesheet" href="../../../../views/styles/font-format.style.css">
    <link rel="stylesheet" href="../../../../views/styles/fonts.style.css">
    <link rel="stylesheet" href="../../../../views/styles/input.style.css">
    <link rel="stylesheet" href="../../../../views/styles/button.style.css">

    <!-- CSS Style -->
    <link rel="stylesheet" href="./answer-question.style.css">

    <!-- FAVICON -->
    <link rel="shortcut icon" href="../../../../views/images/favicon/favicon-16x16.png" type="image/x-icon">
</head>

<body>

    <div class="aq-navbar bg-gray1">
        <div class="container">
            <div class="navbar-container">
                <a href="../detail-question/detail-question.page.php?idQuestion=<?php echo $listDetailsQuestions->id; ?>" class="pointer">
                    <img src="./images/arrow-back-mod.svg">
                </a>

                <div>
                    <label for="answer" class="btn-heelp normal-14-bold-p pointer"><img src="./images/blue-logo.svg" class="d-none d-xs-block d-sm-block d-md-block d-lg-block d-xl-block">Dar um help</label>
                </div>
            </div>
        </div>
    </div>
    <div class="content-page-container">
        <div class="container">
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
        </div>
        <div class="container">
            <div class="divs-container">
                <div class="question-container">
                    <p class="normal-18-bold-title-2 white-title">
                        Pergunta
                    </p>

                    <hr>

                    <!-- Create the editor container -->
                    <div class="ql-snow ql-editor2" style="height: fit-content;">
                        <div class="ql-editor2 whitney-16-medium-text gray7-title">
                            <?php echo $listDetailsQuestions->question; ?>
                        </div>
                    </div>
                    <div class="img-container">
                        <?php $styleImageQuestion = !empty($listDetailsQuestions->image) ? '' : 'd-none'; ?>
                        <p class="<?php echo $styleImageQuestion; ?>">
                            <a href="<?php echo $listDetailsQuestions->image; ?>" class="image-link">
                                <img src="<?php echo $listDetailsQuestions->image; ?>" alt="<?php echo $listDetailsQuestions->firstName; ?>" class="current-photo">
                            </a>
                        </p>
                    </div>

                    <?php $styleDocumentQuestion = !empty($listDetailsQuestions->document) ? '' : 'd-none'; ?>
                    <p class="<?php echo $styleDocumentQuestion; ?> document-question">
                    <span class="document-icon">
                        <img src="../../../../views/images/components/file-icon.svg">
                    </span>
                    <span class="normal-14-medium-p white-title text-truncate document-name">
                        <?php echo $listDetailsQuestions->documentName; ?>
                        </span>
                        <a href="<?php echo $listDetailsQuestions->document; ?>" class="download-file-button" download="<?php echo $listDetailsQuestions->documentName; ?>">
                            <img src="../../../../views/images/components/download-icon.svg">
                        </a>
                    </p>

                </div>
                <div class="answer-container">
                    <p class="normal-18-bold-title-2 white-title">
                        Resposta
                    </p>

                    <hr>

                    <form action="./controller/answer-question.controller.php?idQuestion=<?php echo $listDetailsQuestions->id; ?>" method="post" enctype="multipart/form-data">
                        <!-- Create the editor container -->
                        <div id="editor" class="white-title"></div>
                        <textarea name="textAnswer" id="textArea" class="d-none"></textarea>
                        <br /><br />
                        <label class="normal-18-bold-title-2 white-title">Foto</label>
                        <div class="" id="imgContainer">
                            <img src="" alt="" id="imageFile" class="current-img" style="margin-top: 10px; margin-bottom: 10px;">
                        </div>
                        <label for="photo2" class="add-arch normal-14-bold-p">Adicionar foto a partir dos meus arquivos</label>

                        <span id="step3" class="slc-arch normal-12-medium-tiny gray-text-6">Nenhum arquivo selecionado</span>
                        
                        <br>
                        <input type="file" name="photo" class="d-none" id="photo2" onchange="previewImage(this)">


                        <br /><br />
                        <label class="normal-18-bold-title-2 white-title">Documento</label>
                        <br /><br />
                        <label for="document" class="add-arch normal-14-bold-p">Adicionar documento a partir dos meus arquivos</label>

                        <span id="step4" class="slc-arch normal-12-medium-tiny gray-text-6">Nenhum arquivo selecionado</span>
                        <br>
                        <input type="file" name="document" id="document" class="d-none">

                        <br>
                        <br>

                        <button type="submit" id="answer" name="answer" class="d-none"></button>

                        <br>
                        <br>
                    </form>
                </div>
            </div>

            <!-- <a href="../detail-question/detail-question.page.php?idQuestion=<?php echo $listDetailsQuestions->id; ?>">
                        <button>Cancelar</button>
                    </a> -->
        </div>
    </div>
    </div>


    <!-- JS JQuery ⬇️ -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- JS Bootstrap ⬇️ -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <!-- jQuery 1.7.2+ or Zepto.js 1.0+ -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <!-- Magnific Popup core JS file -->
    <script src="../../../../libs/dist/jquery.magnific-popup.js"></script>

    <!-- Include the Quill library -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script>
        $(document).ready(function() {
            $('.image-link').magnificPopup({
                type: 'image'
            });
        });
    </script>

    <!-- Initialize Quill editor -->
    <script>
        var options = [
            [{
                'header': '1'
            }, {
                'header': '2'
            }],
            ['bold', 'italic', 'strike', 'underline', 'blockquote'],
            [{
                'list': 'ordered'
            }, {
                'list': 'bullet'
            }, {
                'align': []
            }, {
                'direction': 'rtl'
            }],
            ['code', 'code-block', {
                'script': 'super'
            }, {
                'script': 'sub'
            }],
            ['link', 'video']
        ]

        var editor = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Deixe aqui seu heelp...',
            modules: {
                toolbar: options
            }
        });

        editor.on('text-change', function() {
            const valueTextArea = editor.root.innerHTML;
            const text = document.getElementById('textArea');

            text.innerText = valueTextArea;
        });
    </script>

    <script>
        function previewImage(self) {
            const imageFile = document.getElementById("imageFile");
            const file = self && self.files[0];

            if (!file) {
                imageFile.style.display = "none";
                imgContainer.style.display = "none";
                return;
            }

            if (file) {
                imageFile.style.display = "block";
                imgContainer.style.display = "block";
                imageFile.classList.add("current-photo");
                imageFile.src = URL.createObjectURL(file);
                return;
            }
        }
    </script>
    <!-- JS arquvio selecionado -->
    <script type="text/javascript">
        let inputFile = document.getElementById('photo2');
        let fileNameField = document.getElementById('step3');
        inputFile.addEventListener('change', function(event) {
            let uploadedFileName = event.target.files[0].name;
            fileNameField.textContent = uploadedFileName;

        });

        var down = document.getElementById('step4');
        var file = document.getElementById("photo");
        var uploadedFileName = event.target.files[0].name;
    </script>
    <script type="text/javascript">
        let inputDocFile = document.getElementById('document');
        let docNameField = document.getElementById('step4');
        inputDocFile.addEventListener('change', function(event) {
            let uploadedFileName = event.target.files[0].name;
            docNameField.textContent = uploadedFileName;

        });
        var uploadedFileName = event.target.files[0].name;
    </script>
</body>

</html>