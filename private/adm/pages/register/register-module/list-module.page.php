<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Module.class.php');

session_start();

try {
    $search = $_GET['searchModule'] ?? '';
    $module = new Module();

    $listModules = $module->listModule($search);
    $countModules = $module->countModules($search);

    $optionOfSearch = array();
    foreach ($listModules as $row) {
        $optionOfSearch[] = array(
            'label' => $row->name,
            'value' => $row->name
        );
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Módulos | Heelp!</title>

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- CSS Search Bar -->
    <link rel="stylesheet" href="../../../../style/search-bar.style.css">
</head>

<body class="container">
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

    <!-- Cadastro módulo ⬇️ -->
    <a href="./form-register-module.page.php">
        <div class="bg-primary text-white p-5">
            Cadastro módulo
        </div>
    </a>

    <!-- Barra de pesquisa ⬇️ -->
    <form action="./list-module.page.php" method="GET">
        <input type="text" name="searchModule" id="searchModule" placeholder="Pesquise por módulos" autocomplete="off">
        <input type="submit" value="Pesquisar">
    </form>

    <!-- Contador de módulos ⬇️ -->
    <p>
        <?php echo $countModules ?>
    </p>

    <!-- Lista de módulos ⬇️ -->
    <?php for ($i = 0; $i < count($listModules); $i++) {
        $row = $listModules[$i] ?>
        <p>
            Nome:
            <?php echo $row->name; ?>
        </p>

        <p>
            <a href="./form-update-module.page.php?updateModule=<?php echo $row->id; ?>">Editar</a>
            <a href="./controller/delete-module.controller.php?id=<?php echo $row->id; ?>" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete">Excluir</a>
        </p>
        <hr>
    <?php } ?>

    <!-- JS Bootstrap ⬇️ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- JS Modal Excluir ⬇️ -->
    <script src="../../js/delete-module.js"></script>

    <!-- JS Search bar -->
    <script src="../../js/autocomplete.js"></script>

    <!-- JS Search bar ⬇️ -->
    <script>
        const field = document.getElementById('searchModule');
        const ac = new Autocomplete(field, {
            data: <?php echo json_encode($optionOfSearch); ?>,
            maximumItems: 8,
            treshold: 1,
        });
    </script>
</body>

</html>