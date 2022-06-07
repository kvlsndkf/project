<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-student.controller.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Course.class.php');
require_once('/xampp/htdocs' . '/project/classes/categories/Category.class.php');

try {
    $course = new Course();
    $listCourseOfStudent = $course->courseOfStudent();

    $listAllCourses = $course->listCoursesOfSearchBar();

    $category = new Category();
    $listCategories = $category->listCategory();
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
    <title>Pedir um Heelp! | Heelp!</title>

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Include stylesheet -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>

<body>
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

    <label for="">Fazer pegunta</label>

    <br>
    <br>
    <form action="./controller/register-question.controller.php" method="post" enctype="multipart/form-data">
        <label for="">Curso</label>
        <select name="course" id="selectCourse" class="selectCourse w-100" onchange="courseValue()">
            <optgroup label="Seu curso">
                <?php for ($i = 0; $i < count($listCourseOfStudent); $i++) {
                    $row = $listCourseOfStudent[$i] ?>
                    <option value="<?php echo $row['id'] ?>" selected> <?php echo $row['name'] ?> </option>
                <?php } ?>
            </optgroup>

            <optgroup label="Todos dos cursos">
                <?php for ($i = 0; $i < count($listAllCourses); $i++) {
                    $row = $listAllCourses[$i] ?>
                    <option value="<?php echo $row->id ?>"> <?php echo $row->name ?> </option>
                <?php } ?>
            </optgroup>
        </select>

        <br>
        <br>

        <label for="">Matéria</label>
        <select name="subject" id="selectSubject" class="selectSubject w-100">

        </select>

        <br>
        <br>

        <label for="">Categoria</label>
        <select name="category" id="" class="selectCategory w-100" required>
            <option value="" selected disabled>Selecione a categoria</option>
            <?php for ($i = 0; $i < count($listCategories); $i++) {
                $row = $listCategories[$i] ?>
                <option value="<?php echo $row->id ?>"> <?php echo $row->name ?> </option>
            <?php } ?>
        </select>

        <br>
        <br>

        <!-- Create the editor container -->
        <div id="editor"></div>
        <textarea name="textQuestion" id="textArea" class="d-none"></textarea>

        <br>
        <br>
        <hr>

        <label for="">Adicionar fotos do seu computador</label>
        <img src="" alt="" id="imageFile">
        <br>
        <input type="file" name="photo" onchange="previewImage(this)">

        <br>
        <br>

        <label for="">Adicionar documentos do seu computador</label>
        <br>
        <input type="file" name="document">

        <br>
        <br>

        <button type="submit" name="question">Perguntar</button>

        <br>
        <br>
    </form>
    <a href="../home/home.page.php">
        <button>Cancelar</button>
    </a>


    <!-- JS JQuery ⬇️ -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- JS Bootstrap ⬇️ -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <!-- JS Select Multiple ⬇️ -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Include the Quill library -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script>
        $(".selectCourse").select2({
            allowClear: true
        });

        $(".selectSubject").select2({
            allowClear: true
        });

        $(".selectCategory").select2({
            allowClear: true
        });
    </script>

    <!-- Initialize Quill editor -->
    <script>
        var options = [
            [{
                'header': '1'
            }, {
                'header': '2'
            }],
            ['bold', 'italic', 'strike', 'underline', 'blockquote'],
            [{
                'list': 'ordered'
            }, {
                'list': 'bullet'
            }, {
                'align': []
            }, {
                'direction': 'rtl'
            }],
            ['code', 'code-block', {
                'script': 'super'
            }, {
                'script': 'sub'
            }],
            ['link', 'video']
        ]

        var editor = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Compose an epic...',
            modules: {
                toolbar: options
            }
        });

        editor.on('text-change', function() {
            const valueTextArea = editor.root.innerHTML;
            const text = document.getElementById('textArea');

            text.innerText = valueTextArea;
        });
    </script>

    <!-- JS Select da Matéria ⬇️ -->
    <script>
        async function courseValue() {
            const selectCourse = document.getElementById("selectCourse");
            const selectSubject = document.getElementById("selectSubject");

            const dados = await fetch('./controller/json-register-subject.controller.php?course=' + selectCourse.value);

            const json_subject = await dados.json();
            const convert_into_string = JSON.stringify(json_subject);
            const object_subject = JSON.parse(convert_into_string);

            console.log(object_subject);

            array_subjects = object_subject['subject'];

            for (i = 0; i < array_subjects.length; i++) {
                const optionElement = document.createElement("option");

                optionElement.value = array_subjects[i]['id'];
                optionElement.textContent = array_subjects[i]['name'];

                selectSubject.appendChild(optionElement);
            }

            return;
        }

        (async function() {
            await courseValue();
        }());
    </script>

    <script>
        function previewImage(self){
            const imageFile = document.getElementById("imageFile");
            const file = self && self.files[0];

            if(!file){
                imageFile.style.display = "none";
                return;
            }

            if(file){
                imageFile.style.display = "block";
                imageFile.src = URL.createObjectURL(file);
                return;
            }
        }
    </script>
</body>

</html>