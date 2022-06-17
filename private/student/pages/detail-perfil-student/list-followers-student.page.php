<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-student.controller.php');
require_once('/xampp/htdocs' . '/project/classes/followers/Follow.class.php');
require_once('/xampp/htdocs' . '/project/classes/users/StudentMethods.class.php');

try {
    $idUser = $_SESSION['idUser'];
    $idFollower = $_GET['idFollowers'];

    $student = new StudentMethods();
    $studentSession = $student->getStudentByUserID($idUser);

    $follower = new Follow();
    $listFollowers = $follower->listFollowers($idFollower);
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
    <title>Seguidores | Heelp!</title>

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>

    <label for="">Seguidores</label>
    <!-- Lista de seguidores ⬇️ -->
    <?php for ($i = 0; $i < count($listFollowers); $i++) {
        $row = $listFollowers[$i] ?>

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
            <form action="./controller/list-followers.controller.php?idfollower=<?php echo $idUser; ?>&idFollowing=<?php echo $row->userId; ?>&idPerfil=<?php echo $idFollower; ?>" method="post">
                <input type="submit" id="follow" value="<?php echo $textButton; ?>" name="follow">
            </form>
        </div>

        <hr>
    <?php } ?>

</body>

</html>