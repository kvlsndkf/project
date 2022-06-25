<?php
require_once('/xampp/htdocs' . '/project/classes/questions/Question.class.php');
require_once('/xampp/htdocs' . '/project/classes/answers/Answer.class.php');
require_once('/xampp/htdocs' . '/project/classes/users/StudentMethods.class.php');

$id = $_GET['idQuestion'];
$studentId = $_GET['idStudent'];

$student = new StudentMethods();
$idStudent = $student->getStudentByUserID($studentId);


$question = new Question();
$listDetailsQuestions = $question->listDetailsQuestion($id);

$answer = new Answer();
$listAnswers = $answer->listAnswer($id, $idStudent);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pergunta | Heelp!</title>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.css" rel="stylesheet" />

    <!-- Like -->
    <link rel="stylesheet" href="../../../../student/pages/detail-question/style/like.style.css">

    <!-- Avaliation -->
    <link rel="stylesheet" href="../../../../student/pages/detail-question/style/avaliation.style.css">

    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="../../../../../libs/dist/magnific-popup.css">

    <!-- Include stylesheet -->
    <link href="../../../../style/editor-style/editor.style.css" rel="stylesheet">
</head>

<body>
    <p class="margin-60">
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

        if ($listDetailsQuestions->category === "Material de Apoio") {
            $styleError = 'd-none';
            $styleQuestion = 'd-none';
            $styleHelp = 'badge rounded-pill bg-success';
        }
        ?>
        <span class="<?php echo $styleError; ?>"> <?php echo $listDetailsQuestions->category; ?></span>
        <span class="<?php echo $styleQuestion; ?>"> <?php echo $listDetailsQuestions->category; ?></span>
        <span class="<?php echo $styleHelp; ?>"> <?php echo $listDetailsQuestions->category; ?></span>
        <span class="badge rounded-pill bg-little-blue"> <?php echo $listDetailsQuestions->subject; ?></span>
    </p>

    <a href="../detail-profile-student/detail-profile-student.page.php?idStudent=<?php echo $listDetailsQuestions->creatorId; ?>" target="_blank">
        <img src="<?php echo $listDetailsQuestions->photo; ?>" alt="<?php echo $listDetailsQuestions->firstName; ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50px; margin-right: 8px;">
    </a>
    <div class="question-info-text">
        <a href="../detail-profile-student/detail-profile-student.page.php?idStudent=<?php echo $listDetailsQuestions->creatorId; ?>" target="_blank" class="question-name question-about-a normal-14-medium-p">
            <?php echo $listDetailsQuestions->firstName; ?>
            <?php echo $listDetailsQuestions->surname; ?>
        </a>


        <div class="question-about normal-12-medium-tiny">
            <?php echo $listDetailsQuestions->created; ?>
            •
            <?php echo $listDetailsQuestions->module; ?>
            •
            <?php echo $listDetailsQuestions->school; ?>
        </div>
    </div>


    <?php $styleImageQuestion = !empty($listDetailsQuestions->image) ? '' : 'd-none'; ?>
    <p class="<?php echo $styleImageQuestion; ?>  image-question">
        <a href="<?php echo $listDetailsQuestions->image; ?>" class="image-link question-img">
            <img src="<?php echo $listDetailsQuestions->image; ?>" alt="<?php echo $listDetailsQuestions->firstName; ?>" style="width: 150px;">
        </a>
    </p>

    <!-- Create the editor container -->
    <div class="ql-snow ql-editor2">
        <div class="ql-editor2 question-text-div">
            <span class="question-text-p white-text line-clamp-2 whitney-16-medium-text" id="questionText-<?php echo $listDetailsQuestions->id; ?>">
                <?php echo $listDetailsQuestions->question; ?>
            </span>
        </div>
    </div>

    <?php $styleDocumentQuestion = !empty($listDetailsQuestions->document) ? '' : 'd-none'; ?>
    <p class="<?php echo $styleDocumentQuestion; ?> document-question">
        <span class="document-icon">
            <img src="../../../../views/images/components/file-icon.svg">
        </span>
        <span class="normal-14-medium-p white-text text-truncate document-name">
            <?php echo $listDetailsQuestions->documentName; ?>
        </span>
        <a href="<?php echo $listDetailsQuestions->document; ?>" class="download-file-button" download="<?php echo $listDetailsQuestions->documentName; ?>">
            <img src="../../../../views/images/components/download-icon.svg" alt="">
        </a>
    </p>

    <div class="question-footer">

        <?php
        $answer = new Answer();
        $totalAnswersOfQuestion = $answer->countAnswers($listDetailsQuestions->id);

        $styleCounter = empty($totalAnswersOfQuestion) ? 'question-footer-div' : 'question-answers question-footer-div';
        ?>
        <div class="<?php echo $styleCounter; ?>" id="respostaQuant">
            <p class="normal-14-bold-p white-text question-p">
                <?php echo $totalAnswersOfQuestion; ?>
            </p>

        </div>
    </div>

    <hr class="detail-question-hr">

    <p class="normal-18-bold-title-2 white-text question-p">
        Respostas
    </p>

    <hr class="detail-question-hr">

    <?php $styleListAnswers = !empty($listAnswers) ? '' : 'd-none';

    ?>
    <div class="<?php echo $styleListAnswers; ?>">

        <!-- Lista de respostas ⬇️ -->
        <?php for ($i = 0; $i < count($listAnswers); $i++) {
            $row = $listAnswers[$i] ?>

            <div class="space-between-header">

                <div class="question-info">
                    <a href="../detail-profile-student/detail-profile-student.page.php?idStudent=<?php echo $row->creatorID; ?>" target="_blank">
                        <img src="<?php echo $row->photo; ?>" alt="<?php echo $row->firstName; ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50px; margin-right: 8px;">
                    </a>
                    <div class="question-info-text">
                        <a href="../detail-profile-student/detail-profile-student.page.php?idStudent=<?php echo $row->creatorID; ?>" target="_blank" class="question-name question-about-a normal-14-medium-p">
                            <?php echo $row->firstName; ?>
                            <?php echo $row->surname; ?>
                        </a>
                        <div class="question-about normal-12-medium-tiny">
                            <?php echo $row->created; ?>
                            •
                            <?php echo $row->module; ?>
                            •
                            <?php echo $row->school; ?>
                        </div>
                    </div>
                </div>

            </div>

            <div class="question-core">
                <!-- Create the editor container -->
                <div class="ql-snow ql-editor2">
                    <div class="ql-editor2">
                        <span class="question-text-p white-text line-clamp-2 whitney-16-medium-text" id="questionText-<?php echo $row->id; ?>">
                            <?php echo $row->answer; ?>
                        </span>
                    </div>
                </div>

                <?php $styleImageAnswer = !empty($row->image) ? '' : 'd-none'; ?>
                <p class="<?php echo $styleImageAnswer; ?> image-question">
                    <a href="<?php echo $row->image; ?>" class="image-link question-img">
                        <img src="<?php echo $row->image; ?>" alt="<?php echo $row->firstName; ?>" style="width: 150px;">
                    </a>
                </p>

                <?php $styleDocumentAnswer = !empty($row->document) ? '' : 'd-none'; ?>
                <p class="<?php echo $styleDocumentAnswer; ?> document-question">
                    <span class="document-icon">
                        <img src="../../../../views/images/components/file-icon.svg">
                    </span>
                    <span class="normal-14-medium-p white-text text-truncate document-name">
                        <?php echo $row->documentName; ?>
                    </span>
                    <a href="<?php echo $row->document; ?>" class="download-file-button" download="<?php echo $row->documentName; ?>">
                        <img src="../../../../views/images/components/download-icon.svg" alt="">
                    </a>
                </p>


                <?php $counterLikeAnswer = empty($row->totalLikeAnswer) ? 0 : $row->totalLikeAnswer; ?>
                <div class="functions-answer">
                    <div class="like-answer">
                        <div class="heart">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewbox="0 0 50 50">
                                <path d="M21.95 40.2 19.3 37.75Q13.1 32 8.55 26.775Q4 21.55 4 15.85Q4 11.35 7.025 8.325Q10.05 5.3 14.5 5.3Q17.05 5.3 19.55 6.525Q22.05 7.75 24 10.55Q26.2 7.75 28.55 6.525Q30.9 5.3 33.5 5.3Q37.95 5.3 40.975 8.325Q44 11.35 44 15.85Q44 21.55 39.45 26.775Q34.9 32 28.7 37.75L26.05 40.2Q25.2 41 24 41Q22.8 41 21.95 40.2Z" />
                            </svg>
                        </div>
                        <p class="normal-14-bold-p question-p" style="color: var(--fuchsia); margin-top: 2px;">
                            <?php echo $counterLikeAnswer; ?>
                        </p>

                    </div>

                    <div class="avaliation-answer">

                        <?php $counterAvaliationAnswer = empty($row->totalAvaliationAnswer) ? 0 : $row->totalLikeAnswer; ?>
                        <div class="star-icon question-info">
                            <p class="normal-14-bold-p question-p avaliation-text" style="color: var(--yellow);" style="margin-bottom: -10px;">
                                <span class="functions-answer-text avaliation-text">
                                    <?php echo $row->avaliation; ?>
                                    (<?php echo $counterAvaliationAnswer; ?>)
                                </span>

                            </p>
                        </div>
                    </div>
                </div>
            </div>

    </div>
<?php } ?>
</div>

<!-- JS JQuery ⬇️ -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!-- JS Bootstrap ⬇️ -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.js"></script>

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
</body>

</html>