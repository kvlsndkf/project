async function enterDataTeachers(id,page) {

    const paginationTeachers = document.getElementById('pagination-teachers');

    await fetch('./controller/pagination-modal-course-teachers.php?idCourse=' + id + '&page=' + page)
                .then((resp) => resp.json())
                .then(function(data){
                    paginationTeachers.innerHTML= data;
                });

                await fetch('./controller/json-course.controller.php?idCourse=' + id +'&page=' + page)
                .then((resp) => resp.json())
                .then(function(data){
                const json_course = data;
                const convert_into_string = JSON.stringify(json_course);
                const object_course = JSON.parse(convert_into_string);
                const course = object_course['course'][0];

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
                    divElement.className = "div-teachers-list";
                    const divPhoto = document.createElement("div");
                    divPhoto.className = "div-teachers-photo";
                    const photoElement = document.createElement("img");
                    photoElement.className = "img-teachers-list";
                    const tElement = document.createElement("p");
                    tElement.className = "p-teachers-list normal-14-bold-p";
                    const divText = document.createElement("div");
                    divText.className = "div-text-teachers-list";
                    const labelElement = document.createElement("label");
                    labelElement.className = "label-teachers-list normal-14-medium-p";
                    const hrElement = document.createElement("hr");
                    hrElement.className = "hr-teachers-list";
                    
                    tElement.innerHTML = array_teachers[i]['name'];
                    photoElement.src = array_teachers[i]['photo'];
                    labelElement.innerHTML = "Professor(a)";
                    
                    // <div class=pai">
                    //     <div class="div-photo">
                    //         <img></img>
                    //     </div>
                    //     <div-textteacher>
                    //         <p>

                    //         </p>
                    //         <labelElement
                    //     </div-textteacher>
                    // </div>

                    // divElement.id = i;
                    // divText.appendChild(labelElement);
                    // divText.appendChild(tElement);
                    // divElement.appendChild(photoElement);
                    // divElement.appendChild(divText);
                    // teachersList.appendChild(hrElement);

                    divElement.id = i;
                    divText.appendChild(labelElement);
                    divText.appendChild(tElement);
                    divPhoto.appendChild(photoElement);
                    divElement.appendChild(divPhoto);
                    divElement.appendChild(divText);
                    teachersList.appendChild(hrElement);

                    document.getElementById("teachers-list").appendChild(divElement);
                }

            })
}    