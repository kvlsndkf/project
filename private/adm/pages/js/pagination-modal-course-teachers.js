async function enterDataTeachers(id,page) {

    const paginationTeachers = document.getElementById('pagination-teachers');

    await fetch('./controller/pagination-modal-course-teachers.php?idCourse=' + id + '&page=' + page)
                .then((resp) => resp.json())
                .then(function(data){
                    console.log(data);
                    paginationTeachers.innerHTML= data;
                });

                await fetch('./controller/json-course.controller.php?idCourse=' + id +'&page=' + page)
                .then((resp) => resp.json())
                .then(function(data){
                const json_course = data;
                const convert_into_string = JSON.stringify(json_course);
                const object_course = JSON.parse(convert_into_string);
                const course = object_course['course'][0];

                console.log(object_course);

                document.getElementById('course-edit').href = "./form-update-course.page.php?updateCourse=" + course['id'];
                document.getElementById('course-delete').href = "./controller/delete-course.controller.php?id=" + course['id'];

                assingValueInElementById('photo-course', 'src', course['photo']);
                assingValueInElementById('name-course', 'innerHTML', course['name']);
                assingValueInElementById('about-course', 'innerHTML', course['about']);


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

            })
}    