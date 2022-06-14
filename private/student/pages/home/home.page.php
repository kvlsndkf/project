<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-student.controller.php');
require_once('/xampp/htdocs' . '/project/classes/questions/Question.class.php');
require_once('/xampp/htdocs' . '/project/classes/answers/Answer.class.php');
require_once('/xampp/htdocs' . '/project/classes/users/StudentMethods.class.php');

try {
    $question = new Question();
    $listQuestions = $question->listQuestion();

    $idUser = $_SESSION['idUser'];

    $student = new StudentMethods();
    $studentId = $student->getStudentByUserID($idUser);
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
    <title>Feed | Heelp!</title>

    <!-- Include stylesheet -->
    <link href="../../../style/editor-style/editor.style.css" rel="stylesheet">

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="../../../../libs/dist/magnific-popup.css">
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

    <!-- Lista de perguntas ⬇️ -->
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
            <a href="<?php echo $row->linkQuestion; ?>" class="d-none" id="linkQuestion-<?php echo $row->id; ?>">Link</a>
            <span onclick="copyLink(<?php echo $row->id; ?>)" id="spanLink-<?php echo $row->id; ?>">Copiar link</span>
        </p>

        <?php
        $creatorQuestion = $question->getCreatorQuestionById($row->id);
        $creatorQuestionID = $creatorQuestion[0]['student_id'];
        $studentID = $studentId[0]['id'];
        $questionHasAnswers = $question->hasAnswers($row->id);

        $userCreatorQuestion = $student->getUserByStudentID($creatorQuestion[0]['student_id']);

        $styleDeleteDisplay = $questionHasAnswers || $row->isDenounced != false ? 'd-none' : '';
        $styleDeleteQuestion = $creatorQuestionID == $studentID ? '' : 'd-none';
        $styleDenunciationQuestion = $creatorQuestionID == $studentID ? 'd-none' : '';

        ?>
        <p class="<?php echo $styleDeleteQuestion; ?> <?php echo $styleDeleteDisplay; ?>">
            <a href="../question/controller/delete-question.controller.php?id=<?php echo $row->id; ?>" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete">
                Excluir
            </a>
        </p>

        <p class="<?php echo $styleDenunciationQuestion; ?>">
            <label data-bs-toggle="modal" data-bs-target="#modal-<?php echo $row->id; ?>">
                denunciar
            </label>
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

        <!-- Modal -->
        <div class="modal fade" id="modal-<?php echo $row->id; ?>" tabindex="-1" aria-labelledby="modalLabel-<?php echo $row->id; ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel-<?php echo $row->id; ?>">Relatar um problema</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Nos ajude a entender o problema, o que está acontecendo com esse post?

                        <form action="../question/controller/denunciation-question.controller.php" method="post">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="denunciation" id="radio1-<?php echo $row->id; ?>" value="Não tenho interesse nesse post" required>
                                <label class="form-check-label" for="radio1-<?php echo $row->id; ?>">
                                    Não tenho interesse nesse post
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="denunciation" id="radio2-<?php echo $row->id; ?>" value="É suspeito ou está enviando span">
                                <label class="form-check-label" for="radio2-<?php echo $row->id; ?>">
                                    É suspeito ou está enviando span
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="denunciation" id="radio3-<?php echo $row->id; ?>" value="É abusivo ou nocivo">
                                <label class="form-check-label" for="radio3-<?php echo $row->id; ?>">
                                    É abusivo ou nocivo
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="denunciation" id="radio4-<?php echo $row->id; ?>" value="As informações são enganosas">
                                <label class="form-check-label" for="radio4-<?php echo $row->id; ?>">
                                    As informações são enganosas
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="denunciation" id="radio5-<?php echo $row->id; ?>" value="Manifesta intenções de automutilação ou suicídio">
                                <label class="form-check-label" for="radio5-<?php echo $row->id; ?>">
                                    Manifesta intenções de automutilação ou suicídio
                                </label>
                            </div>

                            <div>
                                <input type="hidden" name="post_link" id="" value="<?php echo $row->linkQuestion; ?>">
                                <input type="hidden" name="createdBy" id="" value="<?php echo $idUser; ?>">
                                <input type="hidden" name="denounciedId" id="" value="<?php echo $userCreatorQuestion[0]['user_id']; ?>">
                                <input type="hidden" name="questionId" id="" value="<?php echo $row->id; ?>">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="register" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <hr>
    <?php } ?>

    <!-- JS JQuery ⬇️ -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- JS Bootstrap ⬇️ -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <!-- JS Modal Excluir ⬇️ -->
    <script src="../../js/delete-question.js"></script>

    <!-- jQuery 1.7.2+ or Zepto.js 1.0+ -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <!-- Magnific Popup core JS file -->
    <script src="../../../../libs/dist/jquery.magnific-popup.js"></script>
    <script src="../../../../libs/dist/jquery.magnific-popup.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.image-link').magnificPopup({
                type: 'image'
            });
        });
    </script>

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