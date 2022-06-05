async function enterDataSubjects(id,page) {

    const paginationSubjects = document.getElementById('pagination-subjects');

    await fetch('./controller/pagination-modal-course-subjects.php?idCourse=' + id + '&page=' + page)
                .then((resp) => resp.json())
                .then(function(data){
                    console.log(data);
                    paginationSubjects.innerHTML= data;
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

                //lista de matérias
                const subjectsList = document.getElementById("subjects-list");
                subjectsList.innerHTML = "";

                array_subjects = object_course['subjects'];

                for (i = 0; i < array_subjects.length; i++) {
                    const divElementSubject = document.createElement("div");
                    divElementSubject.className = "div-list-subjects-course";
                    const labelElement = document.createElement("label");
                    labelElement.className = "normal-14-medium-p about-school-label";
                    const tElementSubject = document.createElement("p");
                    tElementSubject.className = "subs p-teachers-list normal-14-bold-p";
                    const hrElement = document.createElement("hr");
                    hrElement.className = "hr-teachers-list";
                

                    labelElement.innerHTML = "Matéria";
                    tElementSubject.innerHTML = array_subjects[i]['name'];

                    divElementSubject.id = i;
                    divElementSubject.appendChild(labelElement);
                    divElementSubject.appendChild(tElementSubject);
                    divElementSubject.appendChild(hrElement);

                    document.getElementById("subjects-list").appendChild(divElementSubject);
                }
            })    
}    