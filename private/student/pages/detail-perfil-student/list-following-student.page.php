<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-student.controller.php');
require_once('/xampp/htdocs' . '/project/classes/followers/Follow.class.php');
require_once('/xampp/htdocs' . '/project/classes/users/StudentMethods.class.php');

try {
    $idUser = $_SESSION['idUser'];
    $idFollower = $_GET['idFollowers'];

    $student = new StudentMethods();
    $studentSession = $student->getStudentByUserID($idUser);
    $studentPerfil = $student->getDataStudentByID($studentSession[0]['id']);

    $follower = new Follow();
    $listFollowing = $follower->listFollowing($idFollower);
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
    <title>Seguindo | Heelp!</title>

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>

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
                <img src="<?php echo $studentPerfil->photo; ?>" alt="<?php echo $studentPerfil->firstName;
                                                                        echo $studentPerfil->surname; ?>" width="100">
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
    <br>
    <br>

    <label for="">Seguindo</label>
    <!-- Lista de seguidores ⬇️ -->
    <?php for ($i = 0; $i < count($listFollowing); $i++) {
        $row = $listFollowing[$i] ?>

        <p>
            <a href=" <?php echo $row->linkProfile; ?>">
                <img src="<?php echo $row->photo; ?>" alt="<?php echo $row->firstName; ?>" width="100">
            </a>
        </p>

        <p>
            <a href=" <?php echo $row->linkProfile; ?>">
                <?php echo $row->firstName;
                echo " " . $row->surname; ?>
            </a>
        </p>

        <p>
            <?php echo $row->module; ?> •
            <?php echo $row->course; ?> •
            <?php echo $row->school; ?>
        </p>

        <?php
        $checkFollow = $follower->checkFollower($idUser, $row->userId);
        $textButton = $checkFollow == false ? 'Seguir' : 'Deixar de seguir';
        $displayFollow = $studentSession[0]['id'] == $row->studentId ? 'd-none' : '';
        ?>
        <div class="<?php echo $displayFollow; ?>">
            <form action="./controller/list-following.controller.php?idfollower=<?php echo $idUser; ?>&idFollowing=<?php echo $row->userId; ?>&idPerfil=<?php echo $idFollower; ?>" method="post">
                <input type="submit" id="follow" value="<?php echo $textButton; ?>" name="follow">
            </form>
        </div>

        <hr>
    <?php } ?>

</body>

</html>