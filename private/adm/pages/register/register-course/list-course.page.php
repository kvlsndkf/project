<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Course.class.php');

session_start();

try {
    $search = $_GET['searchCourse'] ?? '';

    $course = new Course();
    $listCourses = $course->listCourse($search);
    $countCourses = $course->countCourses($search);
    $listCoursesOfSearch = $course->listCoursesOfSearchBar();

    $optionOfSearchCourse = array();
    foreach ($listCoursesOfSearch as $row) {
        $optionOfSearchCourse[] = array(
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
    <title>Cursos | Heelp!</title>

    <link rel="stylesheet" href="../../../../style/style.css">

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

    <!-- Cadastro curso ⬇️ -->
    <a href="./form-register-course.page.php">
        <div class="bg-primary text-white p-5">
            Cadastro curso
        </div>
    </a>

    <!-- Barra de pesquisa ⬇️ -->
    <form action="./list-course.page.php" method="GET">
        <input type="text" name="searchCourse" id="searchCourse" placeholder="Pesquise por cursos" autocomplete="off">
        <input type="submit" value="Pesquisar">
    </form>

    <!-- Contador de cursos ⬇️ -->
    <p>
        <?php echo $countCourses ?>
    </p>

    <!-- Lista de professores ⬇️ -->
    <?php for ($i = 0; $i < count($listCourses); $i++) {
        $row = $listCourses[$i] ?>

        <?php $countTeachersInCourse = $course->countTeachersInCourse($row->id); ?>
        <?php $countSchoolsInCourse = $course->countSchoolsInCourse($row->id); ?>

        <p>
            <img src="<?php echo $row->photo; ?>" alt=" <?php echo $row->name; ?>">

        </p>

        <p>
            Curso
            <?php echo $row->name; ?>
        </p>

        <?php $style = $countSchoolsInCourse == 0 ? 'badge rounded-pill bg-primary d-none' : 'badge rounded-pill bg-help-primary'; ?>
        <span class="<?php echo $style; ?>"> Etec's: <?php echo $countSchoolsInCourse ?></span>

        <?php $style = $countTeachersInCourse == 0 ? 'badge rounded-pill bg-primary d-none' : 'badge rounded-pill bg-primary'; ?>
        <span class="<?php echo $style; ?>"> Professores: <?php echo $countTeachersInCourse ?></span>

        <br><br>
        <button type="submit" data-bs-toggle="modal" data-bs-target="#myModal" data-id="<?php echo $row->id; ?>" onclick="schoolModal(this)">Ver mais detalhes</button>

        <p>
            <a href="./form-update-course.page.php?updateCourse=<?php echo $row->id; ?>">Editar</a>
            <a href="./controller/delete-course.controller.php?id=<?php echo $row->id; ?>" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete">Excluir</a>
        </p>
        <hr>
    <?php } ?>

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Detalhes do curso</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <!-- Modal body -->
                    <p>
                        <a href="" id="course-edit">Editar</a>
                        <a href="" id="course-delete" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete">Excluir</a>
                    </p>

                    <div class="modal-body">
                        <img src="" alt="" id="photo-course">
                        <div id="name-course"></div>

                        <br>

                        <label>Sobre</label>
                        <div id="about-course"></div>

                        <hr>

                        <!-- Tabs navs -->
                        <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="ex1-tab-1" data-mdb-toggle="tab" href="#ex1-tabs-1" role="tab" aria-controls="ex1-tabs-1" aria-selected="true">Etec's</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="ex1-tab-2" data-mdb-toggle="tab" href="#ex1-tabs-2" role="tab" aria-controls="ex1-tabs-2" aria-selected="false">Professores</a>
                            </li>
                        </ul>
                        <!-- Tabs navs -->

                        <!-- Tabs content -->
                        <div class="tab-content" id="ex1-content">
                            <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                                <div id="schools-list">

                                </div>
                            </div>
                            <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                                <div id="teachers-list">

                                </div>
                            </div>
                        </div>
                        <!-- Tabs content -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Bootstrap ⬇️ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- JS Modal Excluir ⬇️ -->
    <script src="../../js/delete-course.js"></script>

    <!-- JS Search bar -->
    <script src="../../js/autocomplete.js"></script>

    <!-- JS Search bar ⬇️ -->
    <script>
        const field = document.getElementById('searchCourse');
        const acc = new Autocomplete(field, {
            data: <?php echo json_encode($optionOfSearchCourse); ?>,
            maximumItems: 8,
            treshold: 1,
        });
    </script>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>

    <script>
        function assingValueInElementById(name, atr, value) {
            document.getElementById(name)[atr] = value;
        }

        async function schoolModal(self) {
            const id = self.getAttribute("data-id");
            const dados = await fetch('./controller/json-course.controller.php?idCourse=' + id);

            const json_course = await dados.json();
            const convert_into_string = JSON.stringify(json_course);
            const object_course = JSON.parse(convert_into_string);
            const course = object_course['course'][0];

            console.log(object_course);

            document.getElementById('course-edit').href = "./form-update-course.page.php?updateCourse=" + course['id'];
            document.getElementById('course-delete').href = "./controller/delete-course.controller.php?id=" + course['id'];

            assingValueInElementById('photo-course', 'src', course['photo']);
            assingValueInElementById('name-course', 'innerHTML', course['name']);
            assingValueInElementById('about-course', 'innerHTML', course['about']);

            //lista de etec's
            const schoolsList = document.getElementById("schools-list");
            schoolsList.innerHTML = "";

            array_schools = object_course['schools'];

            for (i = 0; i < array_schools.length; i++) {
                const divElementSchool = document.createElement("div");
                divElementSchool.className = "divSchools";
                const tElementSchool = document.createElement("p");
                tElementSchool.className = "schools";
                const photoElementSchool = document.createElement("img");
                photoElementSchool.className = "photoSchools";

                tElementSchool.innerHTML = array_schools[i]['name'];
                photoElementSchool.src = array_schools[i]['photo'];

                divElementSchool.id = i;
                divElementSchool.appendChild(tElementSchool);
                divElementSchool.appendChild(photoElementSchool);

                document.getElementById("schools-list").appendChild(divElementSchool);
            }

            //lista de professores
            const teachersList = document.getElementById("teachers-list");
            teachersList.innerHTML = "";

            array_teachers = object_course['teachers'];

            for (i = 0; i < array_teachers.length; i++) {
                const divElement = document.createElement("div");
                divElement.className = "divTeachers";
                const tElement = document.createElement("p");
                tElement.className = "teachers";
                const photoElement = document.createElement("img");
                photoElement.className = "photoTeachers";

                tElement.innerHTML = array_teachers[i]['name'];
                photoElement.src = array_teachers[i]['photo'];

                divElement.id = i;
                divElement.appendChild(tElement);
                divElement.appendChild(photoElement);

                document.getElementById("teachers-list").appendChild(divElement);
            }

            // assingOptionalValueInElementById('linkedin-school', 'href', linkedin);
            // assingOptionalValueInElementById('github-school', 'href', github);
            // assingOptionalValueInElementById('facebook-school', 'href', facebook);
            // assingOptionalValueInElementById('instagram-school', 'href', instagram);

            // assingValueInElementById('photo-school', "src", school['photo']);
            // assingValueInElementById('name-school', 'innerHTML', school['name']);
            // assingValueInElementById('address-school', 'innerHTML', school['address'] + ", São Paulo");
            // assingValueInElementById('about-school', 'innerHTML', school['about']);

            // const teachersList = document.getElementById("teachers-list");
            // teachersList.innerHTML = "";

            // array_teachers = object_school['teachers'];


            // for (i = 0; i < array_teachers.length; i++) {
            //     const divElement = document.createElement("div");
            //     divElement.className = "";
            //     const tElement = document.createElement("p");
            //     tElement.className = "";
            //     const photoElement = document.createElement("img");
            //     photoElement.className = "";

            //     tElement.innerHTML = array_teachers[i]['name'];
            //     photoElement.src = array_teachers[i]['photo'];

            //     divElement.id = i;
            //     divElement.appendChild(tElement);
            //     divElement.appendChild(photoElement);

            //     document.getElementById("teachers-list").appendChild(divElement);
            // }
        }
    </script>
</body>

</html>