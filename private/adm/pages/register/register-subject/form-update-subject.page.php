<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Subject.class.php');

session_start();

try {
    $subject = new Subject();

    if (isset($_GET['updateSubject'])) {
        $id = $_GET['updateSubject'];
        $updateSubject = $subject->searchSubjectForUpdate($id);
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar matéria | Heelp!</title>
</head>

<body>
    <form action="./controller/update-subject.controller.php?updateSubject=<?php echo $updateSubject['id'] ?>" method="post">
        <p>
            Nome
            <input type="text" name="updateName" id="updateName" required autofocus autocomplete="off" value="<?php echo $updateSubject['name'] ?>">
        </p>

        <p>
            <input type="submit" value="Editar" name="update">
            <a href="./list-subject.page.php"><button type="button">Cancelar</button></a>
        </p>
    </form>
</body>

</html>