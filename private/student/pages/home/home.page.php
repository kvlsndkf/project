<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-student.controller.php');
require_once('/xampp/htdocs' . '/project/classes/questions/Question.class.php');

try {
    $question = new Question();
    $listQuestions = $question->listQuestion();
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
    <title>Document</title>

    <!-- Include stylesheet -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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

    <a href="../question/question.page.php">
        <button>Fazer pergunta</button>
    </a>

    <br>
    <br>
    <br>

    <!-- Lista de módulos ⬇️ -->
    <?php for ($i = 0; $i < count($listQuestions); $i++) {
        $row = $listQuestions[$i] ?>

        <p>
            <span class="badge rounded-pill bg-primary"> <?php echo $row->course; ?></span>

            <?php
            if ($row->category === "Erro") {
                $styleError = 'badge rounded-pill bg-danger';
                $styleQuestion = 'd-none';
                $styleHelp = 'd-none';
            }

            if ($row->category === "Dúvida") {
                $styleError = 'd-none';
                $styleQuestion = 'badge rounded-pill bg-info';
                $styleHelp = 'd-none';
            }

            if ($row->category === "Apoio") {
                $styleError = 'd-none';
                $styleQuestion = 'd-none';
                $styleHelp = 'badge rounded-pill bg-success';
            }
            ?>
            <span class="<?php echo $styleError; ?>"> <?php echo $row->category; ?></span>
            <span class="<?php echo $styleQuestion; ?>"> <?php echo $row->category; ?></span>
            <span class="<?php echo $styleHelp; ?>"> <?php echo $row->category; ?></span>
            <span class="badge rounded-pill bg-primary"> <?php echo $row->subject; ?></span>
        </p>

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

        <p>
            <?php echo $row->question; ?>
        </p>

        <p>
            <button>Dar um help</button>
            <?php echo $row->xp; ?> xp
        </p>

        <hr>
    <?php } ?>

    <!-- JS JQuery ⬇️ -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- JS Bootstrap ⬇️ -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>