// Verificar se senhas coincidem

let senha = document.getElementById('password');
let senhaC = document.getElementById('confirm-password');

function validarSenha() {
  if (senha.value != senhaC.value) {
    senhaC.setCustomValidity("As senhas não coincidem!");
    senhaC.reportValidity();
    return false;
  } else {
    senhaC.setCustomValidity("");
    return true;
  }
}

senhaC.addEventListener('input', validarSenha);

// Verificar email institucional

function validarEmail(e){
    const email = document.getElementById("email").value;
  
      if((email.includes('@e')) || (email.includes('@et')) || (email.includes('@ete')) || (email.includes('@etec')) === true){
      etec(e);
  
    } else {
        e.preventDefault();
        document.getElementById('warning-email').style.color = "#ED4245";
        document.getElementById('warning-email').innerText = "Utilize o email institucional";
    }
  }

  function etec(e){
    const email = document.getElementById("email").value;
  
    if((email.includes('@etec.sp.gov.br')) === true){
      true
    }else{
      false
      e.preventDefault();
      document.getElementById('warning-email').style.color = "#ED4245";
      document.getElementById('warning-email').innerText = "Digite um email institucional válido";
    }
  }