<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-student.controller.php');
require_once('/xampp/htdocs' . '/project/classes/questions/Question.class.php');
require_once('/xampp/htdocs' . '/project/classes/answers/Answer.class.php');

try {
    $id = $_GET['idQuestion'];
    $question = new Question();
    $listDetailsQuestions = $question->listDetailsQuestion($id);

    $answer = new Answer();
    $listAnswers = $answer->listAnswer($id);
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
    <title>Pergunta sobre <?php echo $listDetailsQuestions->subject; ?> | Heelp!</title>

    <!-- Include stylesheet -->
    <link href="../../../style/editor-style/editor.style.css" rel="stylesheet">

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="../../../../libs/dist/magnific-popup.css">

    <!-- CSS Avaliation -->
    <link rel="stylesheet" href="./style/avaliation.style.css">
</head>

<body>
    <!-- Mensagem de sucesso ⬇️ -->
    <?php if (isset($_SESSION['statusPositive']) && $_SESSION != '') { ?>

        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </symbol>
        </svg>

        <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                <use xlink:href="#check-circle-fill" />
            </svg>
            <div>
                <strong>Tudo certo!</strong>
                <?php echo $_SESSION['statusPositive']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php unset($_SESSION['statusPositive']);
    } ?>

    <p>
        <span class="badge rounded-pill bg-primary"> <?php echo $listDetailsQuestions->course; ?></span>

        <?php
        if ($listDetailsQuestions->category === "Erro") {
            $styleError = 'badge rounded-pill bg-danger';
            $styleQuestion = 'd-none';
            $styleHelp = 'd-none';
        }

        if ($listDetailsQuestions->category === "Dúvida") {
            $styleError = 'd-none';
            $styleQuestion = 'badge rounded-pill bg-info';
            $styleHelp = 'd-none';
        }

        if ($listDetailsQuestions->category === "Apoio") {
            $styleError = 'd-none';
            $styleQuestion = 'd-none';
            $styleHelp = 'badge rounded-pill bg-success';
        }
        ?>
        <span class="<?php echo $styleError; ?>"> <?php echo $listDetailsQuestions->category; ?></span>
        <span class="<?php echo $styleQuestion; ?>"> <?php echo $listDetailsQuestions->category; ?></span>
        <span class="<?php echo $styleHelp; ?>"> <?php echo $listDetailsQuestions->category; ?></span>
        <span class="badge rounded-pill bg-primary"> <?php echo $listDetailsQuestions->subject; ?></span>
    </p>

    <p>
        <a href="<?php echo $listDetailsQuestions->linkQuestion; ?>" class="d-none" id="linkQuestion">Link</a>
        <span onclick="copyLink()" id="spanLink">Copiar link</span>
    </p>

    <p>
        <img src="<?php echo $listDetailsQuestions->photo; ?>" alt="<?php echo $listDetailsQuestions->firstName; ?>" style="width: 50px;">
    </p>

    <p>
        <?php echo $listDetailsQuestions->firstName; ?>
        <?php echo $listDetailsQuestions->surname; ?>
    </p>


    <p>
        <?php echo $listDetailsQuestions->created; ?> •
        <?php echo $listDetailsQuestions->module; ?> •
        <?php echo $listDetailsQuestions->school; ?>
    </p>

    <!-- Create the editor container -->
    <div class="ql-snow ql-editor2">
        <div class="ql-editor2">
            <?php echo $listDetailsQuestions->question; ?>
        </div>
    </div>

    <?php $styleImageQuestion = !empty($listDetailsQuestions->image) ? '' : 'd-none'; ?>
    <p class="<?php echo $styleImageQuestion; ?>">
        <a href="<?php echo $listDetailsQuestions->image; ?>" class="image-link">
            <img src="<?php echo $listDetailsQuestions->image; ?>" alt="<?php echo $listDetailsQuestions->firstName; ?>" style="width: 150px;">
        </a>
    </p>

    <?php $styleDocumentQuestion = !empty($listDetailsQuestions->document) ? '' : 'd-none'; ?>
    <p class="<?php echo $styleDocumentQuestion; ?>">
        <?php echo $listDetailsQuestions->documentName; ?>
        <a href="<?php echo $listDetailsQuestions->document; ?>" download="<?php echo $listDetailsQuestions->documentName; ?>">
            <button>download</button>
        </a>
    </p>

    <p>
        <a href="../answer-question/answer-question.page.php?idQuestion=<?php echo $listDetailsQuestions->id; ?>">
            <button>Dar um help</button>
        </a>
        <?php echo $listDetailsQuestions->xp; ?> xp
    </p>

    <hr>

    <p>
        Respostas
    </p>

    <hr>

    <?php $styleListAnswers = !empty($listAnswers) ? '' : 'd-none'; ?>
    <div class="<?php echo $styleListAnswers; ?>">

        <!-- Lista de respostas ⬇️ -->
        <?php for ($i = 0; $i < count($listAnswers); $i++) {
            $row = $listAnswers[$i] ?>

            <p>
                <img src="<?php echo $row->photo; ?>" alt="<?php echo $row->firstName; ?>" style="width: 50px;">
            </p>

            <p>
                <?php echo $row->firstName; ?>
                <?php echo $row->surname; ?>
            </p>


            <p>
                <?php echo $row->created; ?> •
                <?php echo $row->module; ?> •
                <?php echo $row->school; ?>
            </p>

            <!-- Create the editor container -->
            <div class="ql-snow ql-editor2">
                <div class="ql-editor2">
                    <?php echo $row->answer; ?>
                </div>
            </div>

            <?php $styleImageAnswer = !empty($row->image) ? '' : 'd-none'; ?>
            <p class="<?php echo $styleImageAnswer; ?>">
                <a href="<?php echo $row->image; ?>" class="image-link">
                    <img src="<?php echo $row->image; ?>" alt="<?php echo $row->firstName; ?>" style="width: 150px;">
                </a>
            </p>

            <?php $styleDocumentAnswer = !empty($row->document) ? '' : 'd-none'; ?>
            <p class="<?php echo $styleDocumentAnswer; ?>">
                <?php echo $row->documentName; ?>
                <a href="<?php echo $row->document; ?>" download="<?php echo $row->documentName; ?>">
                    <button>download</button>
                </a>
            </p>

            <p>
                like
                <?php echo $row->like; ?>
            </p>

            <p>
                avaliações
                <?php echo $row->avaliation; ?>
            </p>

            <p>
                <div class="avaliacao">
                    <div class="star-icon ativo" data-icon="1"></div>
                    <div class="star-icon" data-icon="2"></div>
                    <div class="star-icon" data-icon="3"></div>
                    <div class="star-icon" data-icon="4"></div>
                    <div class="star-icon" data-icon="5"></div>
                </div>
            </p>

            <br>
            <br>

            <hr>
        <?php } ?>
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

    <script>
        $(document).ready(function() {
            $('.image-link').magnificPopup({
                type: 'image'
            });
        });
    </script>

    <script>
        function copyLink() {
            const link = document.getElementById("linkQuestion");
            const span = document.getElementById("spanLink");

            navigator.clipboard.writeText(link.href);

            span.innerText = "Copiado!";
            setTimeout(() => {
                span.innerText = "Copiar link";
            }, 1150);
        }
    </script>

<script>
        const stars = document.querySelectorAll('.star-icon');

        document.addEventListener('click', function(e) {
            var classStar = e.target.classList;

            if(!classStar.contains('ativo')){
                stars.forEach(function(star){
                    star.classList.remove('ativo');
                });

                classStar.add('ativo');
                console.log(e.target.getAttribute('data-icon'));
            }
        });
    </script>
</body>

</html>