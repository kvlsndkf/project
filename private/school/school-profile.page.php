<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-student.controller.php');
require_once('/xampp/htdocs' . '/project/classes/schools/School.class.php');
require_once('/xampp/htdocs' . '/project/classes/users/StudentMethods.class.php');

try {
    $idUser = $_SESSION['idUser'];
    $schoolID = $_GET['schoolID'];

    $school = new School();
    $profileSchool = $school->schoolProfile($schoolID);
    $studentsInSchool = $school->countStudentsInSchool($schoolID);
    $teachersInSchool = $school->countTeachersInSchool($schoolID);
    $coursesInSchool = $school->getCoursesInSchool($schoolID);

    $listTeachersInSchool = $school->listTeachersInSchool($schoolID);

    $student = new StudentMethods();
    $studentLogged = $student->getStudentByUserID($idUser);
    $studentPerfil = $student->getDataStudentByID($studentLogged[0]['id']);
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
    <title><?php echo $profileSchool->name; ?> | Heelp!</title>

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.css" rel="stylesheet" />
</head>

<body>
    <!-- Barra de pesquisa -->
    <form action="../student/pages/search/search.page.php" method="get">
        <input type="text" name="search" id="" placeholder="Encontre perguntas, pessoas ou materiais" autocomplete="off">
        <input type="submit" value="pesquisar">
    </form>

    <!-- Perfil do canto -->
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
                <img src="<?php echo $studentPerfil->photo; ?>" alt="<?php echo $studentPerfil->firstName; ?>" width="100">
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

    <div>
        <img src="<?php echo $profileSchool->photo; ?>" alt="<?php echo $profileSchool->name; ?>">
    </div>

    <div>
        <?php echo $profileSchool->name; ?> <br>
        <?php echo $profileSchool->address; ?>, São Paulo
    </div>

    <div>
        <?php echo $studentsInSchool[0]['total']; ?>
        alunos
    </div>

    <div>
        <?php echo $teachersInSchool; ?>
        professores
    </div>

    <p>
        <?php $styleLinkedin = empty($profileSchool->linkedin) ? 'd-none' : ''; ?>
        <a href="<?php echo $profileSchool->linkedin; ?>" class="<?php echo $styleLinkedin; ?>" target="_blank">
            <img src="../adm/images/icons/linkedin.svg" alt="linkedin">
        </a>

        <?php $styleGithub = empty($profileSchool->github) ? 'd-none' : ''; ?>
        <a href="<?php echo $profileSchool->github; ?>" class="<?php echo $styleGithub; ?>" target="_blank">
            <img src="../adm/images/icons/github.svg" alt="github">
        </a>

        <?php $styleFacebook = empty($profileSchool->facebook) ? 'd-none' : ''; ?>
        <a href="<?php echo $profileSchool->facebook; ?>" class="<?php echo $styleFacebook; ?>" target="_blank">
            <img src="../adm/images/icons/facebook.svg" alt="facebook">
        </a>

        <?php $styleInstagram = empty($profileSchool->instagram) ? 'd-none' : ''; ?>
        <a href="<?php echo $profileSchool->instagram; ?>" class="<?php echo $styleInstagram; ?>" target="_blank">
            <img src="../adm/images/icons/instagram.svg" alt="instagram">
        </a>
    </p>



    <!-- Tabs navs -->
    <ul class="nav nav-tabs nav-fill mb-3" id="ex1" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="ex2-tab-1" data-mdb-toggle="tab" href="#ex2-tabs-1" role="tab" aria-controls="ex2-tabs-1" aria-selected="true">Sobre</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="ex2-tab-2" data-mdb-toggle="tab" href="#ex2-tabs-2" role="tab" aria-controls="ex2-tabs-2" aria-selected="false">Cursos</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="ex2-tab-3" data-mdb-toggle="tab" href="#ex2-tabs-3" role="tab" aria-controls="ex2-tabs-3" aria-selected="false">Professores</a>
        </li>
    </ul>
    <!-- Tabs navs -->

    <!-- Tabs content -->
    <div class="tab-content" id="ex2-content">
        <div class="tab-pane fade show active" id="ex2-tabs-1" role="tabpanel" aria-labelledby="ex2-tab-1">
            <label for="">Sobre a Etec</label>

            <br>
            <?php echo $profileSchool->about; ?>
        </div>
        <div class="tab-pane fade" id="ex2-tabs-2" role="tabpanel" aria-labelledby="ex2-tab-2">

            <!-- Lista de cursos ⬇️ -->
            <label for="">Cursos</label>
            <?php for ($i = 0; $i < count($coursesInSchool); $i++) {
                $row = $coursesInSchool[$i] ?>

                <div>
                    <img src="<?php echo $row->photo; ?>" alt="<?php echo $row->name; ?>">
                    <?php echo $row->name; ?>
                </div>

                <div>
                    <?php echo $row->about; ?>
                </div>

                <hr>
            <?php } ?>
        </div>
        <div class="tab-pane fade" id="ex2-tabs-3" role="tabpanel" aria-labelledby="ex2-tab-3">

            <!-- Lista de professores ⬇️ -->
            <label for="">Professores</label>
            <?php for ($i = 0; $i < count($listTeachersInSchool); $i++) {
                $row = $listTeachersInSchool[$i] ?>

                <div>
                    <img src="<?php echo $row->photo; ?>" alt="<?php echo $row->name; ?>" width="80">
                    <div>
                        <?php echo $row->name; ?>
                    </div>

                    <div>
                        <?php
                        foreach ($row->courses as $value) {
                            echo $value . " • ";
                        }
                        ?>
                    </div>
                </div>

                <hr>
            <?php } ?>
        </div>
    </div>
    <!-- Tabs content -->

    <!-- JS JQuery ⬇️ -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- JS Bootstrap ⬇️ -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.js"></script>
</body>

</html>