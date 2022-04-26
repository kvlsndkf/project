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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

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

                    <!-- Logo -->
                    <a href="#" class="a-class logo-heelp">
                        <img src="./img/Logo-t.svg" class="logo-img" alt="Logo Heelp!">
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
                    </ul>
                    <ul class="nav-list2">
                        <li>
                            <a href="#" class="a-class nav-options normal-14-bold-p white">Entrar</a>
                        </li>
                        <li>
                            <a href="#" class="a-class nav-options normal-14-bold-p gray1">
                                <div class="cadastrar-btn">
                                    Cadastre-se
                                </div>
                            </a>
                        </li>
                    </ul>

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
                            
                            <img src="./img/landing-img1.svg" class="img1">

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
                        <img src="./img/landing-img2.svg" class="img2">
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

                    <div class="row">

                        <div class="col coln1">
                            <img src="./img/landing-img3.svg" class="img3">
                        </div>

                        <div class="col-5 coln2">
                            <h5 class="heelp-xp-title gray1 normal-22-black-title-1">Respondendo você também aprende!</h5>
                            <p class="heelp-xp-text gray1">&nbsp&nbsp&nbsp&nbsp&nbspAlém de aprender respondendo, tornamos o aprendizado mais divertido! Complete os desafios e aumente os seus XP's, fique em primeiro lugar no ranking!</p>
                        </div>

                        <div class="col coln3">
                            <img src="./img/landing-img4.svg" class="img4">
                        </div>

                    </div>



                </div>

            </div>

                <!-- Parte 5 -->
                <div id="tela5">

                    <div class="container">

                        <div class="row">

                            <div class="col">

                                <h4 class="heelp-emp gray1 normal32-black-landingpagetitle-2">Empresas Parceiras</h4>
        
                                <h5 class="heelp-emp-title gray1 normal-22-black-title-1">E além de tudo temos um bônus!</h5>
                                <p class="heelp-emp-text gray1">O Heelp! tem parcerias com empresas diversas, que estão a procura de jovens talentos! Você pode se destacar através do ranking, com a pontuação adquirida.</p>
                            
                            
                                <h3 class="heelp-emp-destaque gray1">É pedindo e dando Heelp! que você se destaca!</h3>

                            </div>

                            <div class="col">
                                <img src="./img/landing-img5.svg" class="img5">
                            </div>

                            <div class="col">
                                <img src="./img/landing-img6.svg" class="img6">
                            </div>

                        </div>

                    </div>

                </div>

                <!-- Parte 6 -->
                <div id="tela6">

                    <h5 class="heelp-peca-title white normal32-black-landingpagetitle-2">Ei! Não perca tempo...</h5>
                    <h6 class="heelp-peca-text white nord-40-black-display">Peça um heelp!</h6>

                    <a href="#" class="a-class heelp-peca-btn normal-14-bold-p gray1">
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
                        <a href="#" class="a-class white footer-options normal-14-bold-p white">Fale Conosco</a>
                        <a href="#" class="a-class white footer-options normal-14-bold-p white">Sobre a Empresa</a>

                        
                    </div>
                    <div class="div-da-seta">
                        <a href="#tela1" class="seta-anchor">
                            <img src="./img/botão âncora.svg" class="seta-img">
                        </a>
                    </div>

                    <hr class="footer-linha">

                    <p class="copyright-text whitney-16-medium-text">Copyright © Cold Wolf - 2022. Todos os direitos reservados.</p>

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
    </body>
</html>