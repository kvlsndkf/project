

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../../views/styles/style.global.css">
        <link rel="stylesheet" href="../../../views/styles/font-format.style.css">
        <link rel="stylesheet" href="../../../views/styles/fonts.style.css">
        <link rel="stylesheet" href="../../../views/styles/colors.style.css">
        <link rel="shortcut icon" href="../../../views/images/favicon/favicon-16x16.png" type="image/x-icon">
        <link rel="stylesheet" href="../../../private/style/style.css">
        <!-- CSS Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        
  <title>Fale Conosco - HEELP!</title>
</head>
<body>



<form class="row g-3 needs-validation" action="./controller/message-unit-registration.controller.php" method="POST" enctype="multipart/form-data" novalidate>
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Deixe um email para entrarmos em contato</label>
      <input name="contact" type="email" class="form-control" id="exampleFormControlInput1" required placeholder="contato@email.com" autocomplete="off">
    </div>
    <div  class="mb-3">
    
    <label for="exampleFormControlTextarea1" class="form-label">Deixe sua crítica/avaliação</label>

      <div id="contentTextArea"><textarea name="message" id="about" class="form-control" cols="30" rows="10"  placeholder="Nos conte como foi/está sendo a sua experiência" onclick="colorDiv();" required  maxlength="240" ></textarea></div>
      <div><span id="counterTextArea">240</span></div>
      
    </div>
    <div class="col-12">
    <input class="btn btn-primary" type="submit" value="Cadastrar"  name="register" onclick = "GFG_Fun()"></input>
  </div>
</form>


<!--Cod Java alert-->
<script type="text/javascript">
    // Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
    </script> 

<!--CSS only-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

<!-- JS Visibility Inputs -->
<script type="text/javascript" src="../../../private/adm/pages/js/visibility-inputs.js"></script>
<!-- JS Count Characters TextArea -->
<script type="text/javascript" src="../../../private/adm/pages/js/textarea.js"></script>
</body>
</html>



