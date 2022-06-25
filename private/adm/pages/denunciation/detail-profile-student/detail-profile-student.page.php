<?php
require_once('/xampp/htdocs' . '/project/classes/users/StudentMethods.class.php');

try {
    $idStudent = $_GET['idStudent'];

    $student = new StudentMethods();

    $studentPerfil = $student->getDataStudentByID($idStudent);
    $studentAnswer = $student->listAnswersByStudent($idStudent);
    $studentQuestion = $student->listQuestionsByStudent($idStudent);
    $studentMaterial = $student->listMaterialsByStudent($idStudent);
    $studentPreference = $student->listPreferencesStudent($idStudent);
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
    <link rel="shortcut icon" href="../../../../../views/images/favicon/favicon-16x16.png" type="image/x-icon">
    <title>Perfil <?php echo $studentPerfil->firstName; ?> | Heelp!</title>

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

    <link rel="stylesheet" href="../../../../../views/styles/style.global.css">
    <link rel="stylesheet" href="../../../../../views/styles/fonts.style.css">
    <link rel="stylesheet" href="../../../pages/register/register.styles.css">
    <link rel="stylesheet" href="../../../pages/register/registration panel/registration-panel-style.css">
    <link rel="stylesheet" href="../../../../student/styles/feed.style.css">

        <!-- Estilo do modal de denunciar -->
        <link rel="stylesheet" href="../../../../style/modal-about.style.css">
</head>

<body>
    <div class="wrapper">
        <nav class="feed-leftbar"></nav>
        <div class="corpo-feed">
            <div class="feed-div">
                <div class="profile-div">
                    <div class="profile-top"></div>
                    <div style="padding: 20px;">
                    <div class="profile-header">
                    <div class="profile-header-left">
                        <a href="<?php echo $studentPerfil->photo; ?>" class="image-link profile-pic">
                            <img src="<?php echo $studentPerfil->photo; ?>" alt="<?php echo $studentPerfil->firstName; ?>" class="profile-pic-img">
                        </a>
                        <div class="badge rounded-pill bg-purple-light xp-profile-pill margin-left-20">
                            <?php echo $studentPerfil->xp; ?>xp
                        </div>
                    </div>
                        </div>
                        
                    
                   
                        
                            <p class="normal-16-bold-title-3 white-text question-p">
                                <?php echo $studentPerfil->firstName;
                                echo " " . $studentPerfil->surname; ?>
                            </p>

                            <p class="question-about margin-bot-15 normal-12-medium-tiny">
                                <?php echo $studentPerfil->module; ?> •
                                <?php echo $studentPerfil->course; ?> •
                                <?php echo $studentPerfil->school; ?>
                            </p>

                            <p>
                                <?php $styleLinkedin = empty($studentPerfil->linkedin) ? 'd-none' : ''; ?>
                                <a href="<?php echo $studentPerfil->linkedin; ?>" class="<?php echo $styleLinkedin; ?>" target="_blank">
                                    <img src="../../../images/icons/linkedin.svg" alt="linkedin">
                                </a>

                                <?php $styleGithub = empty($studentPerfil->github) ? 'd-none' : ''; ?>
                                <a href="<?php echo $studentPerfil->github; ?>" class="<?php echo $styleGithub; ?>" target="_blank">
                                    <img src="../../../images/icons/github.svg" alt="github">
                                </a>

                                <?php $styleFacebook = empty($studentPerfil->facebook) ? 'd-none' : ''; ?>
                                <a href="<?php echo $studentPerfil->facebook; ?>" class="<?php echo $styleFacebook; ?>" target="_blank">
                                    <img src="../../../images/icons/facebook.svg" alt="facebook">
                                </a>

                                <?php $styleInstagram = empty($studentPerfil->instagram) ? 'd-none' : ''; ?>
                                <a href="<?php echo $studentPerfil->instagram; ?>" class="<?php echo $styleInstagram; ?>" target="_blank">
                                    <img src="../../../images/icons/instagram.svg" alt="instagram">
                                </a>
                            </p>
                        
                    </div>
                
                <!-- Tabs navs -->
                <ul class="nav nav-tabs nav-fill mb-3" id="ex1" role="tablist">
                    <li class="nav-item" role="presentation">
                        <?php $styleBadgeAnswers = count($studentAnswer) != 0 ? 'badge bg-primary ms-2' : 'd-none'; ?>
                        <a class="normal-14-bold-p question-p nav-link userProfile-a active" id="ex2-tab-1" data-mdb-toggle="tab" href="#ex2-tabs-1" role="tab" aria-controls="ex2-tabs-1" aria-selected="true">Respostas &nbsp<?php echo count($studentAnswer); ?></a>
                    </li>
                    <li class="normal-14-bold-p question-p nav-item" role="presentation">
                        <?php $styleBadgeQuestions = count($studentQuestion) != 0 ? 'badge bg-primary ms-2' : 'd-none'; ?>
                        <a class="nav-link userProfile-a" id="ex2-tab-2" data-mdb-toggle="tab" href="#ex2-tabs-2" role="tab" aria-controls="ex2-tabs-2" aria-selected="false">Perguntas &nbsp<?php echo count($studentQuestion); ?></a>
                    </li>
                    <li class="normal-14-bold-p question-p nav-item" role="presentation">
                        <?php $styleBadgeMaterials = count($studentMaterial) != 0 ? 'badge bg-primary ms-2' : 'd-none'; ?>
                        <a class="nav-link userProfile-a" id="ex2-tab-3" data-mdb-toggle="tab" href="#ex2-tabs-3" role="tab" aria-controls="ex2-tabs-3" aria-selected="false">Materiais &nbsp<?php echo count($studentMaterial); ?></a>
                    </li>
                    <li class="normal-14-bold-p question-p nav-item" role="presentation">
                        <a class="nav-link userProfile-a" id="ex2-tab-4" data-mdb-toggle="tab" href="#ex2-tabs-4" role="tab" aria-controls="ex2-tabs-4" aria-selected="false">Sobre</a>
                    </li>
                </ul>
                <!-- Tabs navs -->

                <!-- Tabs content -->
                <div class="tab-content padding-20" id="ex2-content">
                    <div class="tab-pane fade show active" id="ex2-tabs-1" role="tabpanel" aria-labelledby="ex2-tab-1">

                        <!-- Lista de respostas ⬇️ -->
                        <?php for ($i = 0; $i < count($studentAnswer); $i++) {
                            $row = $studentAnswer[$i] ?>

                            <div class="question-info-2">
                                <p class="normal-14-medium-p white-text question-p" style="margin-right: 8px;">
                                    respondeu
                                </p>
                                <?php
                                $userid = $student->getUserByStudentID($row->creatorId);
                                ?>
                                <a href="../detail-question/detail-question.page.php?idQuestion=<?php echo $row->questionId; ?>&idStudent=<?php echo $userid[0]['user_id']; ?>" class="normal-14-bold-p question-p text-truncate" style="max-width: 80%; color: var(--blue-sky);" target="_blank">
                                    <?php echo $row->question; ?>
                                </a>
                                <p style="color: var(--blue-sky);">
                                    &nbsp...
                                </p>
                            </div>

                            <p class="question-about margin-bot-15 normal-12-medium-tiny">
                                <?php echo $row->created; ?> •
                                <?php echo $row->course; ?> •
                                <?php echo $row->category; ?> •
                                <?php echo $row->subject; ?>
                            </p>

                            <!-- Create the editor container -->

                            <div class="ql-snow ql-editor2">
                                <div class="ql-editor2">
                                    <span class="line-clamp-2 white-text question-text-p">
                                        <?php echo $row->answer; ?>
                                    </span>

                                </div>
                            </div>

                            <?php $styleImageAnswer = !empty($row->photo) ? '' : 'd-none'; ?>
                            <p class="<?php echo $styleImageAnswer; ?> image-question">
                                <a href="<?php echo $row->photo; ?>" class="image-link question-img">
                                    <img src="<?php echo $row->photo; ?>" alt="" width="150px">
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
                                                <?php echo $row->avgAvaliation; ?>
                                                (<?php echo $counterAvaliationAnswer; ?>)
                                            </span>

                                        </p>

                                    </div>

                                </div>

                            </div>

                            <hr class="detail-question-hr">

                        <?php } ?>

                    </div>
                    <div class="tab-pane fade" id="ex2-tabs-2" role="tabpanel" aria-labelledby="ex2-tab-2">

                        <!-- Lista de perguntas ⬇️ -->
                        <?php for ($i = 0; $i < count($studentQuestion); $i++) {
                            $row = $studentQuestion[$i] ?>

                            <p class="question-about normal-12-medium-tiny margin-bot-15">
                                <?php echo $row->created; ?> •
                                <?php echo $row->course; ?> •
                                <?php echo $row->category; ?> •
                                <?php echo $row->subject; ?>
                            </p>

                            <!-- Create the editor container -->
                            <div class="ql-snow ql-editor2">
                                <div class="ql-editor2">
                                    <span class="white-text line-clamp-2">
                                        <?php echo $row->question; ?>
                                    </span>

                                </div>
                            </div>



                            <?php $styleImageQuestions = !empty($row->photo) ? '' : 'd-none'; ?>
                            <p class="<?php echo $styleImageQuestions; ?> image-question">
                                <a href="<?php echo $row->photo; ?>" class="image-link question-img">
                                    <img src="<?php echo $row->photo; ?>" alt="" width="150">
                                </a>
                            </p>

                            <?php $styleDocumentQuestion = !empty($row->document) ? '' : 'd-none'; ?>
                            <p class="<?php echo $styleDocumentQuestion; ?> document-question">
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

                            <div class="question-footer">

                                <?php $countAnswersOfQuestion = Answer::countAnswers($row->questionId);

                                $styleCounter = empty($countAnswersOfQuestion) ? 'question-footer-div' : 'question-answers question-footer-div'; ?>

                                <div class="<?php echo $styleCounter ?>">
                                    <p class="normal-14-bold-p white-text question-p">
                                        <?php echo $countAnswersOfQuestion; ?>
                                    </p>
                                </div>

                                <?php
                                $userid = $student->getUserByStudentID($row->creatorId);
                                ?>
                                <a href="../detail-question/detail-question.page.php?idQuestion=<?php echo $row->questionId; ?>&idStudent=<?php echo $userid[0]['user_id']; ?>" class="question-give-heelp-a pedir-heelp-button-a" target="_blank">
                                    <div class="question-toAnswer question-footer-div">
                                        <p class="normal-14-bold-p question-p white-text">
                                            Ver
                                        </p>
                                    </div>
                                </a>
                            </div>

                            <hr class="detail-question-hr">

                        <?php } ?>

                    </div>
                    <div class="tab-pane fade" id="ex2-tabs-3" role="tabpanel" aria-labelledby="ex2-tab-3">

                        <!-- Lista de materiais ⬇️ -->
                        <?php for ($i = 0; $i < count($studentMaterial); $i++) {
                            $row = $studentMaterial[$i] ?>

                            <p class="question-about normal-12-medium-tiny margin-bot-15">
                                <?php echo $row->created; ?> •
                                <?php echo $row->course; ?> •
                                <?php echo $row->category; ?> •
                                <?php echo $row->subject; ?>
                            </p>

                            <!-- Create the editor container -->
                            <div class="ql-snow ql-editor2">
                                <div class="ql-editor2">
                                    <span class="line-clamp-2 white-text question-text-p">
                                        <?php echo $row->question; ?>
                                    </span>

                                </div>
                            </div>

                            <?php $styleImageMaterials = !empty($row->photo) ? '' : 'd-none'; ?>
                            <p class="<?php echo $styleImageMaterials; ?> image-question">
                                <a href="<?php echo $row->photo; ?>" class="image-link question-img">
                                    <img src="<?php echo $row->photo; ?>" alt="" width="150px">
                                </a>
                            </p>

                            <?php $styleDocumentMaterials = !empty($row->document) ? '' : 'd-none'; ?>
                            <p class="<?php echo $styleDocumentMaterials; ?> document-question">
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

                            <div class="question-footer">

                                <?php $countAnswersOfQuestion = Answer::countAnswers($row->questionId);
                                $styleCounter = empty($countAnswersOfQuestion) ? 'question-footer-div' : 'question-answers question-footer-div'; ?>

                                <div class="<?php echo $styleCounter ?>">
                                    <p class="normal-14-bold-p white-text question-p">
                                        <?php echo $countAnswersOfQuestion; ?>
                                    </p>
                                </div>

                                <?php
                                $userid = $student->getUserByStudentID($row->creatorId);
                                ?>
                                <a href="../detail-question/detail-question.page.php?idQuestion=<?php echo $row->questionId; ?>&idStudent=<?php echo $userid[0]['user_id']; ?>" class="question-give-heelp-a pedir-heelp-button-a" target="_blank">
                                    <div class="question-toAnswer question-footer-div">
                                        <p class="normal-14-bold-p question-p white-text">
                                            Ver
                                        </p>
                                    </div>
                                </a>

                            </div>

                            <hr class="detail-question-hr">

                        <?php } ?>

                    </div>
                    <div class="tab-pane fade" id="ex2-tabs-4" role="tabpanel" aria-labelledby="ex2-tab-4">

                        <!-- Sobre ⬇️ -->
                        <p class="normal-14-bold-p question-p" style="color: var(--gray7);">
                            <img src="../../../../views/images/components/date-range.svg" alt="">
                            Entrou em:
                            <?php echo $studentPerfil->created; ?>
                        </p>

                        <br>

                        <p class="normal-14-bold-p question-p margin-bot-15" style="color: var(--gray6);">
                            Preferências
                        </p>

                        <!-- Lista de preferencias ⬇️ -->
                        <?php for ($i = 0; $i < count($studentPreference); $i++) {
                            $row = $studentPreference[$i] ?>

                            <p class="normal-16-bold-title-3 white-text question-p margin-bot-15">
                                <img style="width: 32px;" src="<?php echo $row->photo; ?>" alt="<?php echo $row->name; ?>">
                                <?php echo $row->name; ?>
                            </p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <nav class="feed-leftbar feed-rightbar"></nav>
    </div>
    <!-- Tabs content -->

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