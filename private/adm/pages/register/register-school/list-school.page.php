<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/schools/School.class.php');

session_start();

try {
    $search = $_GET['searchSchool'] ?? '';
    $filter = $_GET['filterSchool'] ?? '';

    $school = new School();

    $listSchools = $school->listSchool($search, $filter);
    $countSchools = $school->countSchools($search, $filter);
    $listSchoolsOfSearch = $school->listSchoolOfSearchBar();

    $optionOfSearch = array();
    foreach ($listSchoolsOfSearch as $row) {
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Etec's | Heelp!</title>

    <!-- CSS Stack Edit -->
    <link rel="stylesheet" href="https://stackedit.io/style.css" />

    <link rel="stylesheet" href="../../../../style/style.css">

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- CSS Search Bar -->
    <link rel="stylesheet" href="../../../../style/search-bar.style.css">
</head>

<body>
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

    <!-- Cadastro escola ⬇️ -->
    <a href="./form-register-school.page.php">
        <div class="bg-primary text-white p-5">
            Cadastro etec
        </div>
    </a>

    <!-- Barra de pesquisa ⬇️ -->
    <form action="./list-school.page.php" method="GET">
        <input type="text" name="searchSchool" id="searchSchool" placeholder="Pesquise por Etec's" autocomplete="off">
        <input type="submit" value="Pesquisar">
    </form>

    <!-- Filtro ⬇️ -->
    <form action="./list-school.page.php" method="GET">
        <?php $filter = $_GET['filterSchool'] ?? '';
        $styleFilter = $filter == "" ? 'btn btn-primary' : 'btn btn-outline-primary';  ?>
        <input type="hidden" name="filterSchool" value="">
        <button type="submit" class="<?php echo $styleFilter; ?>" id="all">Todos</button>
    </form>

    <form action="./list-school.page.php" method="GET">
        <?php $filter = $_GET['filterSchool'] ?? '';
        $styleFilter = $filter == "Comconta" ? 'btn btn-primary' : 'btn btn-outline-primary';  ?>
        <input type="hidden" name="filterSchool" value="Comconta">
        <button type="submit" class="<?php echo $styleFilter; ?>" id="have-account">Com conta</button>
    </form>

    <form action="./list-school.page.php" method="GET">
        <?php $filter = $_GET['filterSchool'] ?? '';
        $styleFilter = $filter == "Semconta" ? 'btn btn-primary' : 'btn btn-outline-primary';  ?>
        <input type="hidden" name="filterSchool" value="Semconta">
        <button type="submit" class="<?php echo $styleFilter; ?>" id="not-have-account">Sem conta</button>
    </form>


    <!-- Contador de professores ⬇️ -->
    <p>
        <?php echo $countSchools ?>
    </p>

    <!-- Lista de professores ⬇️ -->
    <?php for ($i = 0; $i < count($listSchools); $i++) {
        $row = $listSchools[$i] ?>

        <?php $countTeachersInSchool = $school->countTeachersInSchool($row->id); ?>

        <p>
            <?php echo $row->name; ?>
        </p>

        <p>
            <?php echo $row->address; ?>, São Paulo
        </p>


        <p>
            Sobre
            <?php echo $row->about; ?>
        </p>

        <?php $style = $row->haveAccount == "Sem conta" ? 'badge rounded-pill bg-warning text-dark' : 'badge rounded-pill bg-help-primary'; ?>
        <span class="<?php echo $style; ?>"><?php echo $row->haveAccount; ?></span>

        <?php $style = $countTeachersInSchool == 0 ? 'badge rounded-pill bg-primary d-none' : 'badge rounded-pill bg-primary'; ?>
        <span class="<?php echo $style; ?>"> Professores: <?php echo $countTeachersInSchool ?></span>

        <br><br>

        <button type="button" class="btn btn-primary">Ver mais detalhes</button>

        <p>
            <a href="./form-update-school.page.php?updateSchool=<?php echo $row->id; ?>">Editar</a>
            <a href="./controller/delete-school.controller.php?id=<?php echo $row->id; ?>" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete">Excluir</a>
        </p>
        <hr>
    <?php } ?>

    <!-- JS Bootstrap ⬇️ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- JS Modal Excluir ⬇️ -->
    <script src="../../js/delete-teacher.js"></script>

    <!-- JS Search bar -->
    <script src="../../js/autocomplete.js"></script>

    <!-- JS Search bar ⬇️ -->
    <script>
        const field = document.getElementById('searchSchool');
        const ac = new Autocomplete(field, {
            data: <?php echo json_encode($optionOfSearch); ?>,
            maximumItems: 8,
            treshold: 1,
        });
    </script>

    <!-- JS Button Filter -->
    <script src="../../js/button-filter.js"></script>
</body>

</html>