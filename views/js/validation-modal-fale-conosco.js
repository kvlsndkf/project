function ValidationEmail(e) {

    const eemail = document.getElementById ('exampleFormControlInput1').value;
    const teste = /\S+@\S+\.\S+/;


    console.log(eemail)
    if (teste.test(eemail)) {
        true
        document.getElementById('messegeG').style.display = "none";
        
    }
    else {
        false;
        final(e);
    }
    return true;
}

function final(e) {

    const eemail = document.getElementById("exampleFormControlInput1").value;

    if ((eemail.includes('@@')) || (eemail.includes(';')) || (eemail.includes('')) || (eemail.includes('$')) || (eemail.includes('!')) || 
    (eemail.includes('#')) || (eemail.includes('*')) || (eemail.includes('%')) ) {
        
        true;
        e.preventDefault();
        document.getElementById('messegeG').style.display = "block";
        
    }
    else {
        false;
        document.getElementById('messegeG').style.display = "none";
       
    }
}

