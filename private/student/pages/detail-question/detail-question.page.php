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
    <title>Dar um Heelp! <?php echo $listDetailsQuestions->subject; ?> | Heelp!</title>

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="../../../../libs/magnific-popup/dist/magnific-popup.css">
</head>

<body>
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

    <div id="question">
        <textarea name="" id="questionValue" class="d-none"><?php echo $listDetailsQuestions->question; ?></textarea>
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
        <a href="../detail-question/detail-question.page.php?idQuestion=<?php echo $listDetailsQuestions->id; ?>">
            <button>Dar um help</button>
        </a>
        <?php echo $listDetailsQuestions->xp; ?> xp
    </p>

    <hr>

    <!-- JS JQuery ⬇️ -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- JS Bootstrap ⬇️ -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <!-- jQuery 1.7.2+ or Zepto.js 1.0+ -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <!-- Magnific Popup core JS file -->
    <script src="../../../../libs/magnific-popup/dist/jquery.magnific-popup.js"></script>

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
</body>

</html>