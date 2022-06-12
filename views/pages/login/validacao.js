function validarEmail(e){
  const email = document.getElementById("eemail").value;
  
  // email.includes('@etec.sp.gov.br');
  // console.log(email.includes('@etec.sp.gov.br'));

  // email.includes('@help.com.br');
  // console.log(email.includes('@help.com.br'))

    if((email.includes('@e')) || (email.includes('@et')) || (email.includes('@ete')) || (email.includes('@etec')) === true){
    etec(e);

  } else if( (email.includes('@h'))||(email.includes('@he')) || (email.includes('@hel')) || (email.includes('@help')) === true){
    help(e);
  }else if ((email.startsWith('etec@')) || email.startsWith('help@') === true){
    arroba(e);
    
   
  }
}

function etec(e){
  const email = document.getElementById("eemail").value;

  if((email.includes('@etec.sp.gov.br')) === true){
    true
    document.getElementById('message-aluno').style.display = "none";
  }else{
    false
    e.preventDefault()
    document.getElementById('message-adm').style.display = "none";
    document.getElementById('message-antes').style.display = "none";
    document.getElementById('message-aluno').style.display = "block";
  }
}

function help(e){
  const email = document.getElementById("eemail").value;

  if((email.includes('@help.com.br')) === true){
    true
    document.getElementById('message-adm').style.display = "none";
  }else{
    false
    e.preventDefault()
    //Limpando caixa de erro
    document.getElementById('message-aluno').style.display = "none";
    document.getElementById('message-antes').style.display = "none";
    //colocando novo erro
    document.getElementById('message-adm').style.display = "block";
    
  }
}

function arroba(e){
  const email = document.getElementById("eemail").value;
  if((email.startsWith('etec@')) || email.startsWith('help@') === true){
    false
    e.preventDefault()
    document.getElementById('message-adm').style.display = "none";
    document.getElementById('message-aluno').style.display = "none";
    document.getElementById('message-antes').style.display = "block";

  }else{
    true
    document.getElementById('message-antes').style.display = "none";
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

