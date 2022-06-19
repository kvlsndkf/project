<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-student.controller.php');
require_once('/xampp/htdocs' . '/project/classes/preferences/Preference.class.php');
require_once('/xampp/htdocs' . '/project/classes/answers/Answer.class.php');
require_once('/xampp/htdocs' . '/project/classes/questions/Question.class.php');
require_once('/xampp/htdocs' . '/project/classes/users/StudentMethods.class.php');

try {
    $preferenceID = $_GET['preference'];
    $idUser = $_SESSION['idUser'];

    $preference = new Preference();
    $listPreference = $preference->listPrefereces($preferenceID);
    $detailsPreference = $preference->getNamePreference($preferenceID);

    $question = new Question();

    $student = new StudentMethods();
    $studentId = $student->getStudentByUserID($idUser);
    $studentPerfil = $student->getDataStudentByID($studentId[0]['id']);
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
    <title>Feed <?php echo $detailsPreference->name; ?> | Heelp!</title>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.css" rel="stylesheet" />

    <!-- Include stylesheet -->
    <link href="../../../style/editor-style/editor.style.css" rel="stylesheet">

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>

    <!-- Perfil do canto -->
    <div>
        <p>
            <a href="../../../logout/logout.controller.php">
                sair
            </a>

            <a href="../detail-perfil-student/detail-perfil-student.page.php?idStudent=<?php echo $studentPerfil->id; ?>" target="_blank">
                perfil
            </a>

            <a href="../detail-perfil-student/update-perfil-student.page.php?idStudentLogged=<?php echo $studentPerfil->id; ?>" target="_blank">
                configurações
            </a>
        </p>

        <p>
            <a href="../detail-perfil-student/detail-perfil-student.page.php?idStudent=<?php echo $studentPerfil->id; ?>" target="_blank">
                <img src="<?php echo $studentPerfil->photo; ?>" alt="<?php echo $studentPerfil->firstName; ?>" width="100">
            </a>
        </p>

        <p>
            <?php echo $studentPerfil->xp; ?>
            xp
        </p>

        <p>
            <a href="../detail-perfil-student/detail-perfil-student.page.php?idStudent=<?php echo $studentPerfil->id; ?>" target="_blank">
                <?php echo $studentPerfil->firstName;
                echo " " . $studentPerfil->surname; ?>
            </a>
        </p>
    </div>

    <!-- Barra de pesquisa -->
    <form action="../search/search.page.php" method="get">
        <input type="text" name="search" id="" placeholder="Encontre perguntas, pessoas ou materiais" autocomplete="off">
        <input type="submit" value="pesquisar">
    </form>

    <?php
    if (count($listPreference) == 0) {
        $styleNotFound = 'd-block';
        $stylePreferences = 'd-none';
    } else {
        $styleNotFound = 'd-none';
        $stylePreferences = 'd-block';
    }
    ?>

    <div class="<?php echo $styleNotFound;?>">
        <img src="../../images/no-preferences.svg" alt="">
        <p>Sem posts relacionados a <strong><?php echo $detailsPreference->name; ?></strong></p>
    </div>

    <div class="<?php echo $stylePreferences;?>">
        <!-- Lista de perguntas ⬇️ -->
        <?php for ($i = 0; $i < count($listPreference); $i++) {
            $row = $listPreference[$i] ?>

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

                if ($row->category === "Material de Apoio") {
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
                <a href="<?php echo $row->linkQuestion; ?>" class="d-none" id="linkQuestion-<?php echo $row->id; ?>">Link</a>
                <span onclick="copyLink(<?php echo $row->id; ?>)" id="spanLink-<?php echo $row->id; ?>">Copiar link</span>
            </p>

            <?php
            $creatorQuestion = $question->getCreatorQuestionById($row->id);
            $creatorQuestionID = $creatorQuestion[0]['student_id'];
            $studentID = $studentId[0]['id'];
            $hasAnswers = $question->hasAnswers($row->id);

            $styleDeleteDisplay = $hasAnswers ? 'd-none' : '';
            $styleDeleteQuestion = $creatorQuestionID == $studentID ? '' : 'd-none';
            ?>
            <p class="<?php echo $styleDeleteQuestion; ?> <?php echo $styleDeleteDisplay; ?>">
                <a href="../question/controller/delete-question.controller.php?id=<?php echo $row->id; ?>" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete">
                    Excluir
                </a>
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

            <!-- Create the editor container -->
            <div class="ql-snow ql-editor2">
                <div class="ql-editor2">
                    <?php echo $row->question; ?>
                </div>
            </div>

            <br>
            <br>

            <?php $styleImageQuestion = !empty($row->image) ? '' : 'd-none'; ?>
            <p class="<?php echo $styleImageQuestion; ?>">
                <a href="<?php echo $row->image; ?>" class="image-link">
                    <img src="<?php echo $row->image; ?>" alt="<?php echo $row->firstName; ?>" style="width: 150px;">
                </a>
            </p>

            <?php $styleDocumentQuestion = !empty($row->document) ? '' : 'd-none'; ?>
            <p class="<?php echo $styleDocumentQuestion; ?>">
                <?php echo $row->documentName; ?>
                <a href="<?php echo $row->document; ?>" download="<?php echo $row->documentName; ?>">
                    <button>download</button>
                </a>
            </p>

            <p>
                <?php
                $answer = new Answer();
                $totalAnswersOfQuestion = $answer->countAnswers($row->id);

                echo $totalAnswersOfQuestion;
                ?>
            </p>

            <p>
                <a href="../detail-question/detail-question.page.php?idQuestion=<?php echo $row->id; ?>">
                    <button>Dar um help</button>
                </a>
                <?php echo $row->xp; ?> xp
            </p>

            <hr>
        <?php } ?>
    </div>


    <!-- JS JQuery ⬇️ -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- JS Bootstrap ⬇️ -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.js"></script>

    <!-- JS Modal Excluir ⬇️ -->
    <script src="../../js/delete-question.js"></script>

    <script>
        function copyLink(id) {
            const link = document.getElementById(`linkQuestion-${id}`);
            const span = document.getElementById(`spanLink-${id}`);

            navigator.clipboard.writeText(link.href);

            span.innerText = "Copiado!";
            setTimeout(() => {
                span.innerText = "Copiar link";
            }, 1150);
        }
    </script>
</body>

</html>