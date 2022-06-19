<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-student.controller.php');
require_once('/xampp/htdocs' . '/project/classes/users/StudentMethods.class.php');
require_once('/xampp/htdocs' . '/project/classes/followers/Follow.class.php');

try {
    $idUser = $_SESSION['idUser'];
    $idStudent = $_GET['idStudent'];

    $student = new StudentMethods();

    $studentLogged = $student->getStudentByUserID($idUser);
    $studentProfile = $student->getDataStudentByID($studentLogged[0]['id']);

    $studentPerfil = $student->getDataStudentByID($idStudent);
    $idUserPerfil = $student->getUserByStudentID($studentPerfil->id);
    $studentAnswer = $student->listAnswersByStudent($idStudent);
    $studentQuestion = $student->listQuestionsByStudent($idStudent);
    $studentMaterial = $student->listMaterialsByStudent($idStudent);
    $studentPreference = $student->listPreferencesStudent($idStudent);

    $follow = new Follow();
    $checkFollow = $follow->checkFollower($idUser, $idUserPerfil[0]['user_id']);
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
    <title>Perfil <?php echo $studentPerfil->firstName; ?> | Heelp!</title>

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.css" rel="stylesheet" />

    <!-- Like -->
    <link rel="stylesheet" href="../detail-question/style/like.style.css">

    <!-- Avaliation -->
    <link rel="stylesheet" href="../detail-question/style/avaliation.style.css">

    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="../../../../libs/dist/magnific-popup.css">

    <!-- Include stylesheet -->
    <link href="../../../style/editor-style/editor.style.css" rel="stylesheet">
</head>

<body>

    <div>
        perfil do canto
        <p>
            <a href="../../../logout/logout.controller.php">
                sair
            </a>
        </p>

        <p>
            <img src="<?php echo $studentProfile->photo; ?>" alt="<?php echo $studentProfile->firstName; ?>" width="100">
        </p>

        <p>
            <?php echo $studentProfile->xp; ?>
            xp
        </p>

        <p>
            <?php echo $studentProfile->firstName;
            echo " " . $studentProfile->surname; ?>
        </p>
    </div>

    <br>
    <br>

    <div>
        perfil detalhe
        <p>
            <a href="<?php echo $studentPerfil->photo; ?>" class="image-link">
                <img src="<?php echo $studentPerfil->photo; ?>" alt="<?php echo $studentPerfil->firstName; ?>" width="100">
            </a>
        </p>

        <p>
            <?php echo $studentPerfil->xp; ?>
            xp
        </p>

        <p>
            <?php echo $studentPerfil->firstName;
            echo " " . $studentPerfil->surname; ?>
        </p>

        <p>
            <?php echo $studentPerfil->module; ?> •
            <?php echo $studentPerfil->course; ?> •
            <?php echo $studentPerfil->school; ?>
        </p>

        <p>
            <?php $following = $follow->getFollowing($idUserPerfil[0]['user_id']); ?>
            <a href="./list-following-student.page.php?idFollowers=<?php echo $idUserPerfil[0]['user_id']; ?>">
                Seguindo
                <?php echo $following[0]['total'] ?>
            </a>
        </p>

        <p>
            <?php $followers = $follow->getFollowers($idUserPerfil[0]['user_id']); ?>
            <a href="./list-followers-student.page.php?idFollowers=<?php echo $idUserPerfil[0]['user_id']; ?>">
                Seguidores
                <?php echo $followers[0]['total'] ?>
            </a>
        </p>

        <p>
            <?php $styleLinkedin = empty($studentPerfil->linkedin) ? 'd-none' : ''; ?>
            <a href="<?php echo $studentPerfil->linkedin; ?>" class="<?php echo $styleLinkedin; ?>" target="_blank">
                <img src="../../../adm/images/icons/linkedin.svg" alt="linkedin">
            </a>

            <?php $styleGithub = empty($studentPerfil->github) ? 'd-none' : ''; ?>
            <a href="<?php echo $studentPerfil->github; ?>" class="<?php echo $styleGithub; ?>" target="_blank">
                <img src="../../../adm/images/icons/github.svg" alt="github">
            </a>

            <?php $styleFacebook = empty($studentPerfil->facebook) ? 'd-none' : ''; ?>
            <a href="<?php echo $studentPerfil->facebook; ?>" class="<?php echo $styleFacebook; ?>" target="_blank">
                <img src="../../../adm/images/icons/facebook.svg" alt="facebook">
            </a>

            <?php $styleInstagram = empty($studentPerfil->instagram) ? 'd-none' : ''; ?>
            <a href="<?php echo $studentPerfil->instagram; ?>" class="<?php echo $styleInstagram; ?>" target="_blank">
                <img src="../../../adm/images/icons/instagram.svg" alt="instagram">
            </a>
        </p>

        <?php
        $buttonEdit = $studentLogged[0]['id'] == $studentPerfil->id ? '' : 'd-none';
        $buttonFollow = $studentLogged[0]['id'] == $studentPerfil->id ? 'd-none' : '';

        $textButton = $checkFollow == false ? 'Seguir' : 'Deixar de seguir';
        ?>
        <div class="<?php echo $buttonEdit; ?>">
            <a href="./update-perfil-student.page.php?idStudentLogged=<?php echo $studentLogged[0]['id']; ?>">
                <button>Editar perfil</button>
            </a>
        </div>

        <div class="<?php echo $buttonFollow; ?>">
            <form action="./controller/follow-user.controller.php?idfollower=<?php echo $idUser; ?>&idFollowing=<?php echo $idUserPerfil[0]['user_id']; ?>&idStudentPerfil=<?php echo $studentPerfil->id; ?>" method="post">
                <input type="submit" id="follow" value="<?php echo $textButton; ?>" name="follow">
            </form>
        </div>
    </div>

    <!-- Tabs navs -->
    <ul class="nav nav-tabs nav-fill mb-3" id="ex1" role="tablist">
        <li class="nav-item" role="presentation">
            <?php $styleBadgeAnswers = count($studentAnswer) != 0 ? 'badge bg-primary ms-2' : 'd-none'; ?>
            <a class="nav-link active" id="ex2-tab-1" data-mdb-toggle="tab" href="#ex2-tabs-1" role="tab" aria-controls="ex2-tabs-1" aria-selected="true">Respostas <span class="<?php echo $styleBadgeAnswers; ?>"><?php echo count($studentAnswer); ?></span></a>
        </li>
        <li class="nav-item" role="presentation">
            <?php $styleBadgeQuestions = count($studentQuestion) != 0 ? 'badge bg-primary ms-2' : 'd-none'; ?>
            <a class="nav-link" id="ex2-tab-2" data-mdb-toggle="tab" href="#ex2-tabs-2" role="tab" aria-controls="ex2-tabs-2" aria-selected="false">Perguntas <span class="<?php echo $styleBadgeQuestions; ?>"><?php echo count($studentQuestion); ?></span></a>
        </li>
        <li class="nav-item" role="presentation">
            <?php $styleBadgeMaterials = count($studentMaterial) != 0 ? 'badge bg-primary ms-2' : 'd-none'; ?>
            <a class="nav-link" id="ex2-tab-3" data-mdb-toggle="tab" href="#ex2-tabs-3" role="tab" aria-controls="ex2-tabs-3" aria-selected="false">Materiais <span class="<?php echo $styleBadgeMaterials; ?>"><?php echo count($studentMaterial); ?></span></a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="ex2-tab-4" data-mdb-toggle="tab" href="#ex2-tabs-4" role="tab" aria-controls="ex2-tabs-4" aria-selected="false">Sobre</a>
        </li>
    </ul>
    <!-- Tabs navs -->

    <!-- Tabs content -->
    <div class="tab-content" id="ex2-content">
        <div class="tab-pane fade show active" id="ex2-tabs-1" role="tabpanel" aria-labelledby="ex2-tab-1">

            <!-- Lista de respostas ⬇️ -->
            <?php for ($i = 0; $i < count($studentAnswer); $i++) {
                $row = $studentAnswer[$i] ?>

                <p>
                    respondeu
                    <a href="<?php echo $row->linkQuestion; ?>" target="_blank">
                        <?php echo $row->question; ?>
                    </a>
                </p>

                <p>
                    <?php echo $row->created; ?> •
                    <?php echo $row->course; ?> •
                    <?php echo $row->category; ?> •
                    <?php echo $row->subject; ?>
                </p>

                <!-- Create the editor container -->
                <div class="ql-snow ql-editor2">
                    <div class="ql-editor2">
                        <?php echo $row->answer; ?>
                    </div>
                </div>

                <?php $styleImageAnswer = !empty($row->photo) ? '' : 'd-none'; ?>
                <p class="<?php echo $styleImageAnswer; ?>">
                    <a href="<?php echo $row->photo; ?>" class="image-link">
                        <img src="<?php echo $row->photo; ?>" alt="" width="100">
                    </a>
                </p>


                <?php $styleDocumentAnswer = !empty($row->document) ? '' : 'd-none'; ?>
                <p class="<?php echo $styleDocumentAnswer; ?>">
                    <?php echo $row->documentName; ?>
                    <a href="<?php echo $row->document; ?>" download="<?php echo $row->documentName; ?>">
                        <button>download</button>
                    </a>
                </p>

                <?php $counterLikeAnswer = empty($row->totalLikeAnswer) ? 0 : $row->totalLikeAnswer; ?>
                <div class="heart">
                    <svg xmlns="http://www.w3.org/2000/svg" height="48" width="48">
                        <path d="M21.95 40.2 19.3 37.75Q13.1 32 8.55 26.775Q4 21.55 4 15.85Q4 11.35 7.025 8.325Q10.05 5.3 14.5 5.3Q17.05 5.3 19.55 6.525Q22.05 7.75 24 10.55Q26.2 7.75 28.55 6.525Q30.9 5.3 33.5 5.3Q37.95 5.3 40.975 8.325Q44 11.35 44 15.85Q44 21.55 39.45 26.775Q34.9 32 28.7 37.75L26.05 40.2Q25.2 41 24 41Q22.8 41 21.95 40.2Z" />
                    </svg>
                    <?php echo $counterLikeAnswer; ?>
                </div>


                <?php $counterAvaliationAnswer = empty($row->totalAvaliationAnswer) ? 0 : $row->totalAvaliationAnswer; ?>
                <div class="star-icon">
                    <?php echo $row->avgAvaliation; ?>
                    (<?php echo $counterAvaliationAnswer; ?>)
                </div>

                <hr>
            <?php } ?>

        </div>
        <div class="tab-pane fade" id="ex2-tabs-2" role="tabpanel" aria-labelledby="ex2-tab-2">

            <!-- Lista de perguntas ⬇️ -->
            <?php for ($i = 0; $i < count($studentQuestion); $i++) {
                $row = $studentQuestion[$i] ?>

                <p>
                    <?php echo $row->created; ?> •
                    <?php echo $row->course; ?> •
                    <?php echo $row->category; ?> •
                    <?php echo $row->subject; ?>
                </p>

                <!-- Create the editor container -->
                <div class="ql-snow ql-editor2">
                    <div class="ql-editor2">
                        <?php echo $row->question; ?>
                    </div>
                </div>

                <?php $styleImageQuestions = !empty($row->photo) ? '' : 'd-none'; ?>
                <p class="<?php echo $styleImageQuestions; ?>">
                    <a href="<?php echo $row->photo; ?>" class="image-link">
                        <img src="<?php echo $row->photo; ?>" alt="" width="100">
                    </a>
                </p>

                <?php $styleDocumentQuestion = !empty($row->document) ? '' : 'd-none'; ?>
                <p class="<?php echo $styleDocumentQuestion; ?>">
                    <?php echo $row->documentName; ?>
                    <a href="<?php echo $row->document; ?>" download="<?php echo $row->documentName; ?>">
                        <button>download</button>
                    </a>
                </p>

                <a href="<?php echo $row->linkQuestion; ?>" target="_blank">
                    <button>Ver</button>
                </a>

                <?php $countAnswersOfQuestion = Answer::countAnswers($row->questionId); ?>

                <p>
                    <?php echo $countAnswersOfQuestion; ?>
                </p>

                <hr>

            <?php } ?>

        </div>
        <div class="tab-pane fade" id="ex2-tabs-3" role="tabpanel" aria-labelledby="ex2-tab-3">

            <!-- Lista de materiais ⬇️ -->
            <?php for ($i = 0; $i < count($studentMaterial); $i++) {
                $row = $studentMaterial[$i] ?>

                <p>
                    <?php echo $row->created; ?> •
                    <?php echo $row->course; ?> •
                    <?php echo $row->category; ?> •
                    <?php echo $row->subject; ?>
                </p>

                <!-- Create the editor container -->
                <div class="ql-snow ql-editor2">
                    <div class="ql-editor2">
                        <?php echo $row->question; ?>
                    </div>
                </div>

                <?php $styleImageMaterials = !empty($row->photo) ? '' : 'd-none'; ?>
                <p class="<?php echo $styleImageMaterials; ?>">
                    <a href="<?php echo $row->photo; ?>" class="image-link">
                        <img src="<?php echo $row->photo; ?>" alt="" width="100">
                    </a>
                </p>

                <?php $styleDocumentMaterials = !empty($row->document) ? '' : 'd-none'; ?>
                <p class="<?php echo $styleDocumentMaterials; ?>">
                    <?php echo $row->documentName; ?>
                    <a href="<?php echo $row->document; ?>" download="<?php echo $row->documentName; ?>">
                        <button>download</button>
                    </a>
                </p>

                <a href="<?php echo $row->linkQuestion; ?>" target="_blank">
                    <button>Ver</button>
                </a>

                <?php $countAnswersOfQuestion = Answer::countAnswers($row->questionId); ?>

                <p>
                    <?php echo $countAnswersOfQuestion; ?>
                </p>

                <hr>

            <?php } ?>

        </div>
        <div class="tab-pane fade" id="ex2-tabs-4" role="tabpanel" aria-labelledby="ex2-tab-4">

            <!-- Sobre ⬇️ -->
            <p>
                Entrou em:
                <?php echo $studentPerfil->created; ?>
            </p>

            <br>

            Preferências
            <!-- Lista de preferencias ⬇️ -->
            <?php for ($i = 0; $i < count($studentPreference); $i++) {
                $row = $studentPreference[$i] ?>

                <p>
                    <img src="<?php echo $row->photo; ?>" alt="<?php echo $row->name; ?>">
                    <?php echo $row->name; ?>
                </p>

                <hr>

            <?php } ?>
        </div>
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