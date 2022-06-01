async function enterData(id,page) {

    const pagination = document.getElementById('pagination');

    await fetch('./controller/pagination-teacher-modal.php?idSchool=' + id + '&page=' + page)
                .then((resp) => resp.json())
                .then(function(data){
                    console.log(data);
                    pagination.innerHTML= data;
                });

                await fetch('./controller/json-school.controller.php?idSchool=' + id + '&page=' + page)
                .then((resp) => resp.json())
                .then(function(data){
                const json_school = data;
                const convert_into_string = JSON.stringify(json_school);
                const object_school = JSON.parse(convert_into_string);
                const school = object_school['school'][0];

                const haveAccount = school['haveAccount'];

                var photo = document.getElementById('photo-school');
                var bodyModal = document.getElementById('body-modal-have-account');

                document.getElementById('school-edit').href = "./form-update-school.page.php?updateSchool=" + school['id'];
                document.getElementById('school-delete').href = "./controller/delete-school.controller.php?id=" + school['id'];

                if (haveAccount == "Sem conta") {
                    document.getElementById('name-school').innerHTML = school['name'];
                    document.getElementById('address-school').innerHTML = school['address'] + ", São Paulo";

                    photo.style.display = "none";
                    bodyModal.style.display = "none";

                } else {
                    photo.style.display = "";
                    bodyModal.style.display = "";

                    const linkedin = school['linkedin'];

                    const github = school['github'];
                    const facebook = school['facebook'];
                    const instagram = school['instagram'];

                    assingOptionalValueInElementById('linkedin-school', 'href', linkedin);
                    assingOptionalValueInElementById('github-school', 'href', github);
                    assingOptionalValueInElementById('facebook-school', 'href', facebook);
                    assingOptionalValueInElementById('instagram-school', 'href', instagram);

                    assingValueInElementById('photo-school', "src", school['photo']);
                    assingValueInElementById('name-school', 'innerHTML', school['name']);
                    assingValueInElementById('address-school', 'innerHTML', school['address'] + ", São Paulo");
                    assingValueInElementById('about-school', 'innerHTML', school['about']);
                }

                const teachersList = document.getElementById("teachers-list");
                teachersList.innerHTML = "";

                array_teachers = object_school['teachers'];

                for (i = 0; i < array_teachers.length; i++) {
                    const divElement = document.createElement("div");
                    divElement.className = "";
                    const tElement = document.createElement("p");
                    tElement.className = "";
                    const photoElement = document.createElement("img");
                    photoElement.className = "";

                    tElement.innerHTML = array_teachers[i]['name'];
                    photoElement.src = array_teachers[i]['photo'];

                    divElement.id = i;
                    divElement.appendChild(tElement);
                    divElement.appendChild(photoElement);

                    document.getElementById("teachers-list").appendChild(divElement);
                }
            })
};