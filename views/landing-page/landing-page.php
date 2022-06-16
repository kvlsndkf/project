<!DOCTYPE html>
<html lang="pt-br">
    <head>

        <!-- HTML Base -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Estilos -->
        <link rel="stylesheet" href="../styles/style.global.css">
        <link rel="stylesheet" href="../styles/fonts.style.css">
        <link rel="stylesheet" href="./landing-page-styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="../../private/style/style.css">

        <link rel="stylesheet" href="../styles/button.style.css">
        <link rel="stylesheet" href="../styles/input.style.css">

        <!-- Link do css do Fale Conosco -->
        <link rel="stylesheet" href="./fale-conosco.css">

        <!-- Títilo e Ícone -->
        <title>Heelp!</title>
        <link rel="icon" href="./img/Logo-Blue.svg" type="image/icon type">

        <!-- Scripts -->
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
        <!-- <script>
           const navbar = document.querySelector('.nav');
            window.onscroll = () => {
                if (window.scrollY > 30) {
                    navbar.classList.add('nav-active');
                } else {
                    navbar.classList.remove('nav-active');
                }
            };
        </script> -->

    </head>
    <body class="bode">
        
        <div class="bg">

            <!-- NavBar -->
            <header>
                <nav class="nav" id="nav">
                    <div class="container">
                        <div class="content-navbar">


                    <!-- Logo -->
                    <a href="#" class="a-class logo-heelp">
                        <img src="./img/Logo-Transparente.svg" class="logo-img" alt="Logo Heelp!">
                        <p class="logo-text normal-22-black-title-1 white">heelp!</p>
                    </a>

                    <!-- Nav Itens -->
                    <ul class="nav-list">
                        <li>
                            <a href="#com" class="a-class nav-options normal-14-bold-p white">Comunidade</a>
                        </li>
                        <li>
                            <a href="#net" class="a-class nav-options normal-14-bold-p white">Networking</a>
                        </li>
                        <li>
                            <a href="#xp" class="a-class nav-options normal-14-bold-p white">Desafios</a>
                        </li>
                        <li>
                            <a href="#emp" class="a-class nav-options normal-14-bold-p white">Parceria</a>
                        </li>
                        <li>
                            <a href="#vid" class="a-class nav-options normal-14-bold-p white">Video</a>
                        </li>
                    </ul>
                    <ul class="nav-list2">
                        <li>
                            <a href="../pages/login/login-page.php" class="a-class nav-options normal-14-bold-p white">Entrar</a>
                        </li>
                        <li>
                            <a href="../pages/register/register-profile/register-profile.pages.php" class="a-class nav-options normal-14-bold-p gray1">
                                <div class="cadastrar-btn">
                                    Cadastre-se
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                </div>
                </nav>
            </header>

            <!-- Parte 1 -->
            <div class="container">

                <div class="row align-items-center">

                    <div id="tela1">

                        <h3 class="heelp-slogan white nord-40-black-display">Vá do questionamento ao <br> entendimento</h3>
                        <p class="heelp-text white" id="com">Um lugar onde você não estará só, conte com o apoio de dezenas de alunos <br> de outras ETEC`s.</p>

                    </div>

                </div>

            <!-- Parte 2 -->

                <div id="tela2">

                    <h4 class="heelp-com normal32-black-landingpagetitle-2 gray1">Conheça sua nova comunidade etequiana!</h4>

                    <div class="row">
                        <div class="col-md">
                            
                            <img src="./img/foto1-ajuda.svg" class="img1">

                        </div>

                        <div class="col-md">

                            <h5 class="heelp-com-title gray1 normal-22-black-title-1">O que fazer quando tiver uma dúvida?</h5>
                            <p class="heelp-com-text gray1">Peça um heelp! Você não está sozinho nessa, conte com alunos do mesmo curso ou da sua rede de amigos para te ajudar nas suas dúvidas.</p>
                        
                            <h5 class="heelp-com-title2 gray1 normal-22-black-title-1">Receba ajuda!</h5>
                            <p class="heelp-com-text gray1 normal-20-normal-landingpagetitle-1" id="net">Nossa comunidade é formada por alunos e gênios que estão aguardando para resolver as questões mais difícieis.</p>

                        </div>
                    </div>
                </div>

            </div>

                <!-- Parte 3 -->

            <div id="tela3">
                <div class="linha">
                        <img src="./img/foto2-networking.svg" class="img2">
                    <div class="col">
                        <h4 class="heelp-net white nord-40-black-display">Networking</h4>
                        <h5 class="heelp-net-text white normal32-black-landingpagetitle-2" id="xp">Se conectando que você consegue os melhores resultados.</h5>
                    </div>
                </div>
            </div>


            <!-- Parte 4 -->
            <div class="container">

                <div id="tela4">
                    
                    <h4 class="heelp-xp normal32-black-landingpagetitle-2 gray1">Complete os desafios e conquiste XP</h4>

                    <div class="row g-0 row-tela4">

                        <div class="col coln1">
                            <img src="./img/foto3-desafios.svg" class="img3">
                        </div>

                        <div class="col-5 coln2">
                            <h5 class="heelp-xp-title gray1 normal-22-black-title-1">Respondendo você também aprende!</h5>
                            <p class="heelp-xp-text gray1">&nbsp&nbsp&nbsp&nbsp&nbspAlém de aprender respondendo, tornamos o aprendizado mais divertido! Complete os desafios e aumente os seus XP's, fique em primeiro lugar no ranking!</p>
                        </div>

                        <div class="col coln3">
                            <img src="./img/perfil.svg" class="img4">
                        </div>

                    </div>



                </div>

            </div>

                <!-- Parte 5 -->
                <div id="tela5">

                    <div class="container">

                        <div class="row">

                            <div class="col">

                                <h4 class="heelp-emp gray1 normal32-black-landingpagetitle-2" id="emp">Empresas Parceiras</h4>
        
                                <h5 class="heelp-emp-title gray1 normal-22-black-title-1">E além de tudo temos um bônus!</h5>
                                <p class="heelp-emp-text gray1">O Heelp! tem parcerias com empresas diversas, que estão a procura de jovens talentos! Você pode se destacar através do ranking, com a pontuação adquirida.</p>
                            
                            
                                <h3 class="heelp-emp-destaque gray1" >É pedindo e dando Heelp! que você se destaca!</h3>

                            </div>

                            <div class="col">
                                <img src="./img/foto5-seta-circulo.svg" class="img5">
                            </div>

                            <div class="col">
                                <img src="./img/foto6-ranking.svg" class="img6">
                            </div>

                        </div>

                    </div>

                </div>

                <!-- Parte que irá conter o video Pitch -->

                <div class="container" id="vid">
                    <div class="tela8" >
                        <div class="row-0" >
                            <h6 class="title1 nord-40-black-display" >Imagine um lugar... </h6>
                            <h6 class="subtitle2 normal32-black-landingpagetitle-2">Onde você pode tirar suas dúvidas ao mesmo tempo 
                                que faz uma rede de amigos.</h6>
                                <h6 class="Nhelp subtitlePnord-40-black-display ">Esse lugar existe. Seu nome? Heelp!</h6>

                                <div class="videoP">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/pLp3B8M251s" 
                                    title="YouTube video player" frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                        </div>
            
                    </div>
                </div>

                <!-- Parte 6 -->
                <div id="tela6">

                    <h5 class="heelp-peca-title white normal32-black-landingpagetitle-2">Ei! Não perca tempo...</h5>
                    <h6 class="heelp-peca-text white nord-40-black-display">Peça um heelp!</h6>

                    <a href="../pages/register/register-profile/register-profile.pages.php" class="heelp-peca-btn normal-14-bold-p gray1">
                        <div class="cadastrar-btn">
                            Cadastre-se
                        </div>
                    </a>
                    
                </div>

                <!-- Parte 7 - Footer -->
                <div id="tela7">
    
                    <div class="footer">

                        <a href="#com" class="a-class white footer-options normal-14-bold-p white">Comunidade</a>
                        <a href="#net" class="a-class white footer-options normal-14-bold-p white">Networking</a>
                        <a href="#xp" class="a-class white footer-options normal-14-bold-p white">Desafios</a>
                        <a href="#emp" class="a-class white footer-options normal-14-bold-p white">Parcerias</a>
                        <a href="#vid" class="a-class white footer-options normal-14-bold-p white">Video</a>
                        
                        
                        <a href="./form-register-message/form-register-message.pages.php" class="a-class white footer-options normal-14-bold-p white" data-bs-toggle="modal" data-bs-target="#exampleModal" >Fale Conosco</a>
                        

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content corM">
        <div class="container containerM">
        <div class="modal-header border-bottom-0">
            
            <h2 class="modal-titleM normal-20-bold-modaltitle" id="exampleModalLabel"> Fale Conosco</h2>
            <button id="botao" class="setaM"><img type="button" data-bs-dismiss="modal" aria-label="Close" src="../images/components/x-button.svg" class="close fechar"></button>
        </div>

    <div class="modal-body">
        <form class="row g-3 needs-validation" action="./form-register-message/controller/message-unit-registration.controller.php" method="POST" enctype="multipart/form-data" novalidate>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="subtituloM normal-14-bold-p sub-titulo-plusM">Deixe um email para entrarmos em contato</label>
          <input name="contact" type="email" class=" input normal-12-regular-tinyinput input-text" id="exampleFormControlInput1" required placeholder="contato@email.com" autocomplete="off">
        </div>
        <div  class="mb-3">
        

        <label for="exampleFormControlTextarea1" class="subtituloM normal-14-bold-p sub-titulo-plusM">Deixe sua crítica/avaliação</label>
        <div id="contentTextArea">
          <textarea  name="message" rows="7" id="about" class="text-area normal-14-medium-p" placeholder="Nos conte como foi/está sendo a sua experiência" required  onclick="colorDiv()" minlength="15"  maxlength="240" ></textarea>
          <div id="counter-container" class="counter-container">
            <span id="counterTextArea" class="counterTextArea whitney-8-medium-littletiny">240</span>
            </div>
          </div>
          <button type="submit" class="botaoM button-wide buttonCadastrarM normal-14-bold-p" value="Enviar"  name="register" onclick = "GFG_Fun()">Enviar</button>
                            
        </div>
        </form>
    </div>
    </div>
    </div>
  </div>
</div>

<a href="#" class="a-class white footer-options normal-14-bold-p white">Sobre a Empresa</a>

</div>
    <div class="div-da-seta">
        <a href="#tela1" class="seta-anchor">
            <img src="./img/botão âncora.svg" class="seta-img">
        </a>
    </div>

    <hr class="footer-linha">

    <a href="#" class="a-copyright">
        <p class="copyright-text whitney-16-medium-text">Copyright © Cold Wolf - 2022. Todos os direitos reservados.</p>
    </a>

</div>
</div>
           

                        
  
                    

            

        </div>

        <!-- Scripts -->
        <script>
            var nav = document.getElementById('nav');
            window.addEventListener("scroll", function(event) {
                if(window.pageYOffset>0){

                    nav.style.background = "#8080FF";

                }
                else{
                    nav.style.background = "transparent";
                }
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


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

<script type="text/javascript" src="../../private/adm/pages/js/textarea.js"></script>
    <!-- JS Visibility Inputs -->
<script type="text/javascript" src="../../private/adm/pages/js/visibility-inputs.js"></script>
<!-- JS Count Characters TextArea -->
<script type="text/javascript" src="../../private/adm/pages/js/textarea.js"></script>
    </body>
</html>