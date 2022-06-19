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
<html lang="pt-br">

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

    <!-- CSS Styles globais -->
    <link rel="stylesheet" href="../../../../views/styles/button.style.css">
    <link rel="stylesheet" href="../../../../views/styles/fonts.style.css">
    <link rel="stylesheet" href="../../../../views/styles/colors.style.css">
    <link rel="stylesheet" href="../../../../views/styles/font-format.style.css">

    <!-- CSS Style página -->
    <link rel="stylesheet" href="../../../../views/pages/register/register-student/register-student.style.css">

    <!-- FAVICON -->
    <link rel="shortcut icon" href="../../../../views/images/favicon/favicon-16x16.png" type="image/x-icon">
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
    <div class="h-100 w-100 d-flex align-items-center justify-content-center">
        <div class="bg-modal-gray align-self-center my-auto form-base-question">
            <div class="container">
                <div class="form-header">
                    <a href="../home/home.page.php">
                        <img src="../../../../views/images/components/arrow-back.svg" class="arrow" alt="">
                    </a>
                    <label class="normal-20-bold-modaltitle title-header">Pedir um heelp!</label>
                </div>
                <br/> <br/>
                <form action="./controller/register-question.controller.php" method="post" enctype="multipart/form-data">
                    <label class="normal-14-medium-p">Curso</label>
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
                                <option value="<?php echo $row->id ?>"> <?php echo $row->name ?> </option>
                            <?php } ?>
                        </optgroup>
                    </select>

                    <br>
                    <br>

                    <label class="normal-14-medium-p">Matéria</label>
                    <select name="subject" id="selectSubject" class="selectSubject w-100">

                    </select>

                    <br>
                    <br>

                    <label class="normal-14-medium-p">Categoria<span style="color: var(--red);">*</span></label>
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
                    <br><br>


                    <label class="normal-18-bold-title-2">Foto</label>
                    <div id="imgContainer" class="">
                        <img src="" alt="" class="current-img" id="imageFile" style="margin-top: 10px; margin-bottom: 10px;">
                    </div>
                    <label for="photo" class="add-arch normal-14-bold-p">Adicionar foto a partir dos meus arquivos</label>
                    <span id="step3" class="slc-arch normal-12-medium-tiny gray-text-6">Nenhum arquivo selecionado</span>
                    
                    <br>
                    <input type="file" name="photo" id="photo" class="photo" onchange="previewImage(this)">

                    <br>
                    <hr/>
                    

                    <label class="normal-18-bold-title-2">Documento</label>
                    <br/><br/>
                    <label for="file" class="add-arch normal-14-bold-p">Adicionar documento a partir dos meus arquivos</label>
                    <br>
                    <input type="file" id="file" class="photo" name="document">
                    <span id="step4" class="slc-arch normal-12-medium-tiny gray-text-6">Nenhum arquivo selecionado</span>
                    <br>
                    <br>
                    <br/>

                    <button type="submit" name="question" class="button-wide bg-pink normal-14-bold-p white-title" style="margin-bottom: 10px;">Pedir um heelp!</button>
                </form>
                <a href="../home/home.page.php">
                    <button class="button-wide normal-14-bold-p primary-title">Cancelar</button>
                </a>
            </div>
        </div>
    </div>

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
            placeholder: 'Em que podemos te ajudar?',
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

            selectSubject.innerHTML = "";

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
        function previewImage(self) {
            const imgContainer = document.getElementById("imgContainer");
            const imageFile = document.getElementById("imageFile");
            const file = self && self.files[0];
            

            if (!file) {
                imageFile.style.display = "none";
                imgContainer.style.display = "none";
                return;
            }

            if (file) {
                imageFile.style.display = "block";
                imgContainer.style.display = "block";
                imageFile.classList.add("current-photo");
                imageFile.src = URL.createObjectURL(file);
                return;
            }
        }
    </script>

    <!-- JS arquvio selecionado -->
    <script type="text/javascript">
        let inputFile = document.getElementById('photo');
        let fileNameField = document.getElementById('step3');
        inputFile.addEventListener('change', function(event) {
            let uploadedFileName = event.target.files[0].name;
            fileNameField.textContent = uploadedFileName;
            
        });

        var down = document.getElementById('step3');
        var file = document.getElementById("photo");
        var uploadedFileName = event.target.files[0].name;

        
    </script>
        <script type="text/javascript">
        let inputDocFile = document.getElementById('file');
        let docNameField = document.getElementById('step4');
        inputDocFile.addEventListener('change', function(event) {
            let uploadedFileName = event.target.files[0].name;
            docNameField.textContent = uploadedFileName;
            
        });
        var uploadedFileName = event.target.files[0].name;
    </script>

    
</body>

</html>