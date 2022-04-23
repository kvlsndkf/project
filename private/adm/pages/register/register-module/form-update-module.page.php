<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
$connection = Connection::connection();

//update teacher
if (isset($_GET['updateModule'])) {

    $id = $_GET['updateModule'];

    $stmt = $connection->prepare("SELECT * FROM modules WHERE id = $id");

    $stmt->execute();
    $rowCat = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    $rowCat['name'] = " ";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar módulo | Heelp!</title>

</head>

<body>
    <form action="./controller/update-module.controller.php?updateModule=<?php echo $rowCat['id'] ?>" method="POST" enctype="multipart/form-data">
        <label>Editar módulo</label>
        <p>
            <label>Nome módulo</label>
            <input type="text" name="updateName" id="updateName" value="<?php echo $rowCat['name'] ?>">
        </p>

        <input type="submit" value="Editar" name="update">
        <a href="./list-module.page.php"><button type="button">Cancelar</button></a>
    </form>
</body>

</html>