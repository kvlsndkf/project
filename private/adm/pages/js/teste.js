const listSolicitation = document.getElementById('solicitation-analitic-list');

            const paginationSolicitaton = document.getElementById('pagination-solicitation');

            const listSolicitation = async (page) => {
                const dados = await fetch('./controller/list-solicitation.controller.php?page=' + page);
                // console.log("to funfando");
                const asweres = await dados.text();
                listSolicitation.innerHTML = asweres;

                const dados2 = await fetch('./controller/pagination-solicitation.controller.php?page=' + page);
                // console.log("to funconando")
                const asweres2 = await dados2.text();
                paginationSolicitaton.innerHTML = asweres2;
            }

            listSolicitation(1);