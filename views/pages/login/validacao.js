function validarEmail(){
  const email = document.getElementById("eemail").value;
  
  // email.includes('@etec.sp.gov.br');
  // console.log(email.includes('@etec.sp.gov.br'));

  // email.includes('@help.com.br');
  // console.log(email.includes('@help.com.br'))

    if((email.includes('@e')) || (email.includes('@et')) || (email.includes('@ete')) || (email.includes('@etec')) === true){
    etec();

  } else if((email.includes('@h')) || (email.includes('@he')) || (email.includes('@hel')) || (email.includes('@help')) === true){
    help();
  }else if ((email.includes('etec@')) || email.includes('help@') === true){
    arroba();
  }
}

function etec(){
  const email = document.getElementById("eemail").value;

  if((email.includes('@etec.sp.gov.br')) === true){
    true
    document.getElementById('message-aluno').style.display = "none";
  }else{
    document.getElementById('message-aluno').style.display = "block";
  }
}

function help(){
  const email = document.getElementById("eemail").value;

  if((email.includes('@help.com.br')) === true){
    true
    document.getElementById('message-adm').style.display = "none";
  }else{
    document.getElementById('message-adm').style.display = "block";
  }
}

function arroba(){
  if((email.includes('etec@')) || email.includes('help@') === true){
    document.getElementById('message-antes').style.display = "block";
  }else{
    document.getElementById('message-antes').style.display = "none";
  }
  
}

function buttonDisable(){
  validarEmail();
  if(email.length === arroba(0) || email.length === help(0) || email.length === email(0) ){
    return false;
} else {
    true
}
}
  








//   if((email.includes('@etec.sp.gov.br')) === true){
//     alert('deu certo, etec')


//   } else if(email.includes('@help.com.br') === true){
//     alert('deu certo, help')
//   } else{
//     alert ('empresa parceira')
//   }
  
// }

