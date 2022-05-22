function filterAll(event) {
    console.log(event);

    event.preventDefault();

    var all = document.getElementById("all");
    var buttonAccount = document.getElementById("have-account");
    var buttonNotAccount = document.getElementById("not-have-account");

    if(all.click){
        all.classList.remove('btn-outline-primary');
        all.classList.add('btn-primary');
        
        buttonAccount.classList.remove('btn-primary');
        buttonAccount.classList.add('btn-outline-primary');

        buttonNotAccount.classList.remove('btn-primary');
        buttonNotAccount.classList.add('btn-outline-primary');
    }
}

function filterAccount(event) {
    console.log(event);

    event.preventDefault();

    var all = document.getElementById("all");
    var buttonAccount = document.getElementById("have-account");
    var buttonNotAccount = document.getElementById("not-have-account");

    if(buttonAccount.click){
        buttonAccount.classList.remove('btn-outline-primary');
        buttonAccount.classList.add('btn-primary');
        
        all.classList.remove('btn-primary');
        all.classList.add('btn-outline-primary');

        buttonNotAccount.classList.remove('btn-primary');
        buttonNotAccount.classList.add('btn-outline-primary');
    }

}

function filterNotAccount(event) {
    console.log(event);

    event.preventDefault();
    
    var all = document.getElementById("all");
    var buttonAccount = document.getElementById("have-account");
    var buttonNotAccount = document.getElementById("not-have-account");

    if(buttonNotAccount.click){
        buttonNotAccount.classList.remove('btn-outline-primary');
        buttonNotAccount.classList.add('btn-primary');
        
        all.classList.remove('btn-primary');
        all.classList.add('btn-outline-primary');

        buttonAccount.classList.remove('btn-primary');
        buttonAccount.classList.add('btn-outline-primary');
    }

}