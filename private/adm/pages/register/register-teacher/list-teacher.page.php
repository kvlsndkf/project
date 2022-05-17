<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Teacher.class.php');

session_start();

$connection = Connection::connection();

try {
    $search = $_GET['searchTeacher'] ?? '';
    $teacher = new Teacher();

    $listTeachers = $teacher->listTeacher($search);
    $countTeachers = $teacher->countTeachers($search);

    $optionOfSearch = array();
    foreach ($listTeachers as $row) {
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
    <title>Professores | Heelp!</title>

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

    <!-- Mensagem de erro ⬇️ -->
    <?php if (isset($_SESSION['statusNegative']) && $_SESSION != '') { ?>

        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </symbol>
        </svg>

        <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                <use xlink:href="#exclamation-triangle-fill" />
            </svg>
            <div>
                <strong>Ops...</strong>
                <?php echo $_SESSION['statusNegative']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php unset($_SESSION['statusNegative']);
    } ?>

    <!-- Mensagem de alerta ⬇️ -->
    <?php if (isset($_SESSION['statusAlert']) && $_SESSION != '') { ?>

        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </symbol>
        </svg>

        <div class="alert alert-warning d-flex align-items-center  alert-dismissible fade show" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:">
                <use xlink:href="#exclamation-triangle-fill" />
            </svg>
            <div>
                <strong>Ops...</strong>
                <?php echo $_SESSION['statusAlert']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php unset($_SESSION['statusAlert']);
    } ?>

    <!-- Cadastro professor ⬇️ -->
    <a href="./form-register-teacher.page.php">
        <div class="bg-primary text-white p-5">
            Card cadastro
        </div>
    </a>

    <!-- Barra de pesquisa ⬇️ -->
    <form action="./list-teacher.page.php" method="GET">
        <input type="text" name="searchTeacher" id="searchTeacher" placeholder="Pesquise por professores" autocomplete="off">
        <input type="submit" value="Pesquisar">
    </form>

    <!-- Contador de professores ⬇️ -->
    <p>
        <?php echo $countTeachers ?>
    </p>

    <!-- Lista de professores ⬇️ -->
    <?php for ($i = 0; $i < count($listTeachers); $i++) {
        $row = $listTeachers[$i] ?>
        <p>
            Nome:
            <?php echo $row->name; ?>
        </p>

        <p>
            <img width="100" src="<?php echo $row->photo; ?>" alt="<?php echo $row->name; ?>">
        </p>

        <p>
            <a href="./form-update-teacher.page.php?updateTeacher=<?php echo $row->id; ?>">Editar</a>
            <a href="./controller/delete-teacher.controller.php?id=<?php echo $row->id; ?>" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete">Excluir</a>
        </p>
        <hr>
    <?php } ?>

    <!-- Paginação ⬇️ -->
    <?php
    //Receber o numero de página
    $current_page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
    $page = (!empty($current_page)) ? $current_page : 1;
    
    //Setar a quantidade de registros por página
    $limit_result = 9;

    //Calcular o inicio da vizualização
    $start = ($limit_result * $page) - $limit_result;

    if($search == null) {
            //Contar a quantidade de registros no bd 
    $query_qnt_register = "SELECT COUNT(id) AS 'id' FROM teachers";
    $result_qnt_register = $connection->prepare($query_qnt_register);
    $result_qnt_register->execute();
    $row_qnt_register = $result_qnt_register->fetch(PDO::FETCH_ASSOC);

    //Quantidade de páginas
    $page_qnt = ceil($row_qnt_register['id'] / $limit_result);

    $prev_page = $page - 1;

    $next_page = $page + 1;

    ?>

    <ul class="pagination">
        <?php
        //botão para voltar
        if ($prev_page != 0) { ?>
            <li class="page-item">
                <a class="page-link" href="./list-teacher.page.php?page=<?php echo $prev_page; ?>" tabindex="-1" aria-disabled="true">Anterior</a>
            </li>
        <?php    } else { ?>
            <li class="page-item disabled">
                <a class="page-link disable" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
            </li>
        <?php }  ?>

        <?php
        //Apresentar a paginação
        for ($i = 1; $i < $page_qnt + 1; $i++) { ?>
            <li class="page-item"><a class="page-link" href="./list-teacher.page.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php }
        ?>

        <?php
        //botão para avançar
        if ($next_page <= $page_qnt) { ?>
            <li class="page-item">
                <a class="page-link" href="./list-teacher.page.php?page=<?php echo $next_page; ?>" tabindex="-1" aria-disabled="true">Próximo</a>
            </li>
        <?php    } else { ?>
            <li class="page-item disabled">
                <a class="page-link disable" href="#" tabindex="-1" aria-disabled="true">Próximo</a>
            </li>
        <?php }  ?>
    </ul>
    <?php }else { 
        
        //Contar a quantidade de registros no bd 
        $query_qnt_register = "SELECT COUNT(id) AS 'id' FROM teachers WHERE name LIKE '%$search%' ORDER BY name";
        $result_qnt_register = $connection->prepare($query_qnt_register);
        $result_qnt_register->execute();
        $row_qnt_register = $result_qnt_register->fetch(PDO::FETCH_ASSOC);

        //Quantidade de páginas
        $page_qnt = ceil($row_qnt_register['id'] / $limit_result);

        //Maximo de links
        $max_links = 5;

        $prev_page = $page - 1;

        $next_page = $page + 1;

    ?>

    <ul class="pagination">
        <?php
        //botão para voltar
        if ($prev_page != 0) { ?>
            <li class="page-item">
                <a class="page-link" href="./list-teacher.page.php?page=<?php echo $prev_page; ?> &searchTeacher=<?php echo $search; ?>" tabindex="-1" aria-disabled="true">Anterior</a>
            </li>
        <?php    } else { ?>
            <li class="page-item disabled">
                <a class="page-link disable" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
            </li>
        <?php }  ?>

        <?php
        //Apresentar a paginação
        for ($i = 1; $i < $page_qnt + 1; $i++) { ?>
            <li class="page-item"><a class="page-link" href="./list-teacher.page.php?page=<?php echo $i; ?> &searchTeacher=<?php echo $search; ?>"><?php echo $i; ?></a></li>
        <?php }
        ?>

        <?php
        //botão para avançar
        if ($next_page <= $page_qnt) { ?>
            <li class="page-item">
                <a class="page-link" href="./list-teacher.page.php?page=<?php echo $next_page; ?> &searchTeacher=<?php echo $search; ?>" tabindex="-1" aria-disabled="true">Próximo</a>
            </li>
        <?php    } else { ?>
            <li class="page-item disabled">
                <a class="page-link disable" href="#" tabindex="-1" aria-disabled="true">Próximo</a>
            </li>
        <?php }  ?>
    </ul>
    <?php } ?>
    
    <!-- JS Bootstrap ⬇️ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- JS Modal Excluir ⬇️ -->
    <script src="../../js/delete-teacher.js"></script>

    <!-- JS Search bar -->
    <script src="../../js/autocomplete.js"></script>

    <!-- JS Search bar ⬇️ -->
    <script>
        const field = document.getElementById('searchTeacher');
        const ac = new Autocomplete(field, {
            data: <?php echo json_encode($optionOfSearch); ?>,
            maximumItems: 8,
            treshold: 1,
        });
    </script>
</body>

</html>