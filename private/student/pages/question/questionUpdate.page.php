<?php
include_once('/xampp/htdocs' . '/project/private/validation/validation-student.controller.php');
require_once('/xampp/htdocs' . '/project/classes/schools/Course.class.php');
require_once('/xampp/htdocs' . '/project/classes/categories/Category.class.php');
require_once('/xampp/htdocs' . '/project/classes/questions/Question.class.php');

try {
    $question = new Question();

    if (isset($_GET['updateQuestion'])) {
        $id = $_GET['updateQuestion'];
        $updateQuestion = $question->searchQuestionForUpdate($id);
    }

    $course = new Course();
    $listCourseOfStudent = $course->courseOfStudent();

    $listAllCourses = $course->listCoursesOfSearchBar();

    $category = new Category();
    $categoryLatest = $category->getNameCategoryByID($updateQuestion['category_id']);
    $listCategories = $category->getListCategoryWithWhere($updateQuestion['category_id']);
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
    <title>Atualizar um Heelp! | Heelp!</title>

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Include stylesheet -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>

<body>
    <label for="">Atualizar pegunta</label>

    <br>
    <br>

    <form action="" method="post">
        <label for="">Curso</label>
        <select name="course" id="selectCourse" class="selectCourse w-100" onchange="courseValue()">
            <optgroup label="Seu curso">
                <?php for ($i = 0; $i < count($listCourseOfStudent); $i++) {
                    $row = $listCourseOfStudent[$i] ?>
                    <option value="<?php echo $row['id'] ?>" selected> <?php echo $row['name'] ?> </option>
                <?php } ?>
            </optgroup>

            <optgroup label="Todos os outros cursos">
                <?php for ($i = 0; $i < count($listAllCourses); $i++) {
                    $row = $listAllCourses[$i] ?>
                    <option value="<?php echo $row->id; ?>"> <?php echo $row->name; ?> </option>
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
            <optgroup label="Categoria atual">
                <option value="<?php echo $updateQuestion['category_id'] ?>" selected> <?php echo $categoryLatest[0]['name'] ?> </option>
            </optgroup>

            <optgroup label="Outras categorias">
                <?php for ($i = 0; $i < count($listCategories); $i++) {
                    $row = $listCategories[$i] ?>
                    <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
                <?php } ?>
            </optgroup>
        </select>

        <br>
        <br>

        <!-- Create the editor container -->
        <div id="editor">
            <?php echo $updateQuestion['question']; ?>
        </div>
        <textarea name="textQuestion" id="textArea" class="d-none"><?php echo $updateQuestion['question']; ?></textarea>

        <br>
        <br>
        <hr>

        <label for="">Adicionar fotos do seu computador</label>
        <img width="50" src="<?php echo $updateQuestion['photo'] ?>" alt="">

        <img src="" alt="" id="imageFile">
        <br>
        <input type="file" name="photo" onchange="previewImage(this)">
        <input type="text" name="oldPhoto" id="oldPhoto" value="<?php echo $updateQuestion['photo'] ?>">

        <br>
        <br>

        <label for="">Adicionar documentos do seu computador</label>
        <?php echo $updateQuestion['document_name'] ?>
        <br>
        <input type="file" name="document">
        <input type="text" name="oldDocument" id="oldDocument" value="<?php echo $updateQuestion['document'] ?>">

        <br>
        <br>

        <button type="submit" name="update">Atualizar</button>

        <br>
        <br>
    </form>

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
</body>

</html>