<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro em lote matérias | Heelp!</title>
</head>

<body>
    <label>Cadastro em lote</label>
    <br>
    <a href="../download/materias.xml" download="../download/materias.xml">
        <button>Baixar modelo de planilha</button>
    </a>
    <form action="./controller/subject-batch-resgistration.controller.php" name="subject-batch-registration" method="post" enctype="multipart/form-data">
        <br />
        <br />
        <input type="file" name="subject-table-file">
        <br />
        <br />
        <input type="submit" value="Salvar">
    </form>
</body>

</html>