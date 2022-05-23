<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Subject.class.php');

session_start();

$connection = Connection::connection();

try {
    $search = $_GET['searchSubject'] ?? '';
    $subject = new Subject();

    $listSubjects = $subject->listSubject($search);
    $countSubjects = $subject->countSubjects($search);
    $listSubjectsOfSearch = $subject->listSubjectsOfSearchBar();

    $optionOfSearch = array();
    foreach ($listSubjectsOfSearch as $row) {
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matérias | Heelp!</title>

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- CSS MdBootstrap -->
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css" rel="stylesheet" />
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

    <!-- Cadastro matéria ⬇️ -->
    <a href="./form-register-subject.page.php">
        <div class="bg-primary text-white p-5">
            Cadastro matéria
        </div>
    </a>
    <br>
    <!-- Cadastro matéria ⬇️ -->
    <a href="./form-batch-registration.subject.controller.php">
        <div class="bg-success text-white p-5">
            Cadastro matéria em lote
        </div>
    </a>

    <!-- Barra de pesquisa ⬇️ -->
    <form action="./list-subject.page.php" method="GET">
        <input type="text" name="searchSubject" id="searchSubject" placeholder="Pesquise por matérias" autocomplete="off">
        <input type="submit" value="Pesquisar">
    </form>

    <!-- Contador de matérias ⬇️ -->
    <p>
        <?php echo $countSubjects ?>
    </p>

    <!-- Lista de matérias ⬇️ -->
    <?php for ($i = 0; $i < count($listSubjects); $i++) {
        $row = $listSubjects[$i] ?>

        <p>
            Matéria
            <?php echo $row->name; ?>
        </p>

        <p>
            <a href="./form-update-subject.page.php?updateSubject=<?php echo $row->id; ?>">Editar</a>
            <a href="./controller/delete-subject.controller.php?id=<?php echo $row->id; ?>" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete">Excluir</a>
        </p>
        <hr>
    <?php } ?>

    <!-- JS Bootstrap ⬇️ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- JS Modal Excluir ⬇️ -->
    <script src="../../js/delete-subject.js"></script>

    <!-- JS Search bar -->
    <script src="../../js/autocomplete.js"></script>

    <!-- JS Search bar ⬇️ -->
    <script>
        const field = document.getElementById('searchSubject');
        const ac = new Autocomplete(field, {
            data: <?php echo json_encode($optionOfSearch); ?>,
            maximumItems: 8,
            treshold: 1,
        });
    </script>
</body>

</html>