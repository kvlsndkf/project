<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
$connection = Connection::connection();

//update teacher
if (isset($_GET['updateTeacher'])) {

    $id = $_GET['updateTeacher'];

    $stmt = $connection->prepare("SELECT * FROM teachers WHERE id = $id");

    $stmt->execute();
    $rowCat = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    $rowCat['name'] = " ";
    $rowCat['photo'] = " ";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar professor | Heelp!</title>
    
</head>

<body>
    <form action="./controller/update-teacher.controller.php?updateTeacher=<?php echo $rowCat['id'] ?>" method="POST" enctype="multipart/form-data">
        <label>Atualizar do professor</label>
        <p>
            <label>Nome professor</label>
            <input type="text" name="updateName" id="updateName" value="<?php echo $rowCat['name'] ?>">
        </p>

        <p>
            <label>Foto</label>
            <img width="100" src="<?php echo $rowCat['photo'] ?>" alt="Foto <?php echo $rowCat['name'] ?>">
        </p>

        <p>
            <input type="file" name="updatePhoto" id="updatePhoto">
            <input type="hidden" name="oldPhoto" id="oldPhoto" value="<?php echo $rowCat['photo'] ?>">
        </p>

        <input type="submit" value="Editar" name="update">
        <input type="reset" value="Limpar">
    </form>
</body>

</html>