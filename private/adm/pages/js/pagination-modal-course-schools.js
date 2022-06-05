async function enterDataSchools(id,page) {

    const paginationSchools = document.getElementById('pagination-schools');

    await fetch('./controller/pagination-modal-course-schools.php?idCourse=' + id + '&page=' + page)
                .then((resp) => resp.json())
                .then(function(data){
                    console.log(data);
                    paginationSchools.innerHTML= data;
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

                //lista de etec's
                const schoolsList = document.getElementById("schools-list");
                schoolsList.innerHTML = "";

                array_schools = object_course['schools'];

                for (i = 0; i < array_schools.length; i++) {
                    const divElementSchool = document.createElement("div");
                    divElementSchool.className = "div-school-list";
                    const tElementSchool = document.createElement("p");
                    tElementSchool.className = "schools p-teachers-list normal-14-bold-p";
                    const photoElementSchool = document.createElement("img");
                    photoElementSchool.className = "photoSchools img-curso";
                    

                    tElementSchool.innerHTML = array_schools[i]['name'];
                    photoElementSchool.src = array_schools[i]['photo'];

                    divElementSchool.id = i;
                    divElementSchool.appendChild(tElementSchool);
                    divElementSchool.appendChild(photoElementSchool);

                    document.getElementById("schools-list").appendChild(divElementSchool);
                }

            })
}                