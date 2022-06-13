const paginationSolicitatonNew = document.getElementById('pagination-new-solicitation');

const teste = document.getElementById("solicitation-new-list");

const pagination = async(page) =>{
    // teste.innerHTML= "";
    const dados = await fetch('./controller/pagination-solicitation-new.controller.php?page=' + page);
    console.log("to funconando")
    const asweres = await dados.text();
    paginationSolicitatonNew.innerHTML= asweres;
}

pagination(1);