<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-administrator.controller.php');
require_once('/xampp/htdocs' . '/project/classes/users/StudentController.class.php');


try {
    $search = $_GET['searchProfile'] ?? '';

    $student = new StudentController();

    $listActiveStudents = $student->ListActiveStudents();
    $listBlockedStudents = $student->ListBlockedStudents();
    $listSearch = $student->listSearchProfiles($search);

    $countActiveStudents = $student->countActiveStudents();
    $countBlockedStudents = $student->countBlockedStudents();

    $listProfilesOfSearch = $student->listSearchBarProfiles();

    $optionOfSearchProfile = array();
    foreach ($listProfilesOfSearch as $row) {
        $optionOfSearchProfile[] = array(
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfis | Heelp!</title>

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- CSS MdBootstrap -->
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="../../../style/style.css">
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

    <!-- Barra de pesquisa ⬇️ -->
    <form action="./list-profiles.page.php" method="GET">
        <input type="text" name="searchProfile" id="searchProfile" placeholder="Pesquise por perfis" autocomplete="off">
        <input type="submit" value="pesquisar">
    </form>

    

    <!-- Tabs navs -->
    <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="ex1-tab-1" data-mdb-toggle="tab" href="#ex1-tabs-1" role="tab" aria-controls="ex1-tabs-1" aria-selected="true">Ativos</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link " id="ex1-tab-2" data-mdb-toggle="tab" href="#ex1-tabs-2" role="tab" aria-controls="ex1-tabs-2" aria-selected="false">Bloqueados</a>
        </li>
    </ul>

    <!-- Tabs navs -->

    <!-- Tabs content -->
    <div class="tab-content" id="ex1-content">
        <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
            <div id="message-new-list">

                <!-- Contador de usuários ativos -->
                <p>
                    <?php echo  $countActiveStudents ?>
                </p>

                <!-- Usuários ativos -->
                <?php for ($i = 0; $i < count($listActiveStudents); $i++) {
                    $row = $listActiveStudents[$i] ?>

                    <?php $styleActive = $row->isBlocked == false ? 'badge rounded-pill bg-primary' : 'd-none'; ?>
                    <span class="<?php echo $styleActive; ?>">Ativo</span>

                    <?php $styleTypeUser = $row->typeUser == 'student' ? 'badge rounded-pill bg-primary' : 'd-none'; ?>
                    <span class="<?php echo $styleActive; ?>">Aluno</span>

                    <div>
                        <img src="<?php echo $row->photo; ?>" alt="<?php echo $row->firstName; ?>" width="100">
                        <div>
                            <?php echo $row->firstName; ?>
                            <?php echo $row->surname; ?>
                        </div>

                        <div>
                            <?php echo $row->module; ?> •
                            <?php echo $row->course; ?> •
                            <?php echo $row->school; ?>
                        </div>
                    </div>

                    <div>
                        <label for="">Entrou em</label>
                        <?php echo $row->created; ?>
                    </div>

                    <div>
                        <a href="../denunciation/detail-profile-student/detail-profile-student.page.php?idStudent=<?php echo $row->studentID; ?>" target="__blank">Ver perfil</a>
                    </div>

                    <button data-bs-toggle="modal" data-bs-target="#modal-<?php echo $row->userID; ?>">Bloquear usuário</button>

                    <!-- Modal -->
                    <div class="modal fade" id="modal-<?php echo $row->userID; ?>" tabindex="-1" aria-labelledby="exampleModalLabel-<?php echo $row->userID; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel-<?php echo $row->userID; ?>">Bloquear usuário</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="./controller/block-student.controller.php?userID=<?php echo $row->userID; ?>" method="post">
                                        <div>
                                            <p>
                                                Motivo
                                            </p>

                                            <div id="contentTextArea">
                                                <textarea name="reason" id="about" cols="30" rows="10" placeholder="Faça uma breve descrição sobre o bloqueio" required onclick="colorDiv()"></textarea>
                                                <div><span id="counterTextArea">250</span></div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" name="block" class="btn btn-primary">Bloquear usuário</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                <?php } ?>

            </div>
        </div>

        <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
            <div id="message-read-list">

                <!-- Contador de usuários bloqueados -->
                <p>
                    <?php echo  $countBlockedStudents ?>
                </p>

                <!-- Usuários bloqueados -->
                <?php for ($i = 0; $i < count($listBlockedStudents); $i++) {
                    $row = $listBlockedStudents[$i] ?>

                    <?php $styleActive = $row->isBlocked != false ? 'badge rounded-pill bg-primary' : 'd-none'; ?>
                    <span class="<?php echo $styleActive; ?>">Bloqueado</span>

                    <?php $styleTypeUser = $row->typeUser == 'student' ? 'badge rounded-pill bg-primary' : 'd-none'; ?>
                    <span class="<?php echo $styleActive; ?>">Aluno</span>

                    <div>
                        <img src="<?php echo $row->photo; ?>" alt="<?php echo $row->firstName; ?>" width="100">
                        <div>
                            <?php echo $row->firstName; ?>
                            <?php echo $row->surname; ?>
                        </div>

                        <div>
                            <?php echo $row->module; ?> •
                            <?php echo $row->course; ?> •
                            <?php echo $row->school; ?>
                        </div>
                    </div>

                    <div>
                        <label for="">Bloqueado em</label>
                        <?php echo $row->blocked; ?>
                    </div>

                    <div>
                        <a href="../denunciation/detail-profile-student/detail-profile-student.page.php?idStudent=<?php echo $row->studentID; ?>" target="__blank">Ver perfil</a>
                    </div>

                    <div>
                        Motivo
                        <?php echo $row->reason; ?>
                    </div>

                    <button data-bs-toggle="modal" data-bs-target="#modal-<?php echo $row->userID; ?>">Desbloquear usuário</button>

                    <!-- Modal -->
                    <div class="modal fade" id="modal-<?php echo $row->userID; ?>" tabindex="-1" aria-labelledby="exampleModalLabel-<?php echo $row->userID; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel-<?php echo $row->userID; ?>">Desbloquear usuário</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Tem certeza de que deseja desbloquear este usuário?
                                    <form action="./controller/unlock-student.controller.php?userID=<?php echo $row->userID; ?>" method="post">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" name="unlock" class="btn btn-primary">Sim, quero</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                <?php } ?>

            </div>
        </div>
    </div>
    <!-- Tabs content -->

    <!-- JS Bootstrap ⬇️ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.js"></script>

    <!-- JS Count Characters TextArea -->
    <script type="text/javascript" src="../js/textarea.js"></script>

    <!-- JS Search bar -->
    <script src="../js/autocomplete.js"></script>

    <!-- JS Search bar ⬇️ -->
    <script>
        const field = document.getElementById('searchProfile');
        const acc = new Autocomplete(field, {
            data: <?php echo json_encode($optionOfSearchProfile); ?>,
            maximumItems: 8,
            treshold: 1,
        });
    </script>
</body>

</html>