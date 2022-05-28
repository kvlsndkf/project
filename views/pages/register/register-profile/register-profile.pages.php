<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../styles/style.global.css">
    <link rel="stylesheet" href="../../../styles/fonts.style.css">
    <link rel="stylesheet" href="../../../styles/colors.style.css">
    <link rel="stylesheet" href="../../../styles/font-format.style.css">
    <link rel="shortcut icon" href="../../../images/favicon/favicon-16x16.png" type="image/x-icon">
    <link rel="stylesheet" href="register-profile.pages.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Cadastro | HEELP!</title>
</head>

<body>
    <div class="body-container background-color">
        <div class="container">
            <!-- Mensagem de erro ⬇️ -->
            <?php if (isset($_SESSION['statusNegative']) && $_SESSION != '') { ?>

                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </symbol>
                </svg>

                <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div>
                        <strong>Ops...</strong>
                        <?php echo $_SESSION['statusNegative']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            <?php unset($_SESSION['statusNegative']);
            } ?>
            <a href="#"><img src="../../../images/components/arrow-back.svg" alt="Botão de voltar" class="back-button"></a>
            <div class="page-content">
                <img src="../../../images/logo/logo-and-name.svg" alt="Logo do Help" class="logo-help">
                <p class="gray-title display text-center title-o-que">O que você é?</p>
                <div class="container-fluid">
                    <div class="card-profile-container d-flex justify-content-center">
                        <div class="card-container row">
                            <div class="d-flex justify-content-lg-between justify-content-md-between justify-content-sm-center justify-content-center col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-4 mb-sm-4 mb-md-4 gx-md-5 gx-lg-5 gx-xl-5">
                                <a href="../register-student/step1-register-student.page.php">
                                    <div class="card-profile gray-card card-profile-aluno">
                                        <div class="card-content">
                                            <img src="../../../images/profiles/profile-aluno.svg" alt="Avatar do aluno" class="avt-pic">
                                            <p class="white-title title1 title-profile text-center card-text">Aluno</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="d-flex justify-content-lg-center justify-content-md-center justify-content-sm-center justify-content-center col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <a href="#" style="text-decoration: none;">
                                    <div class="card-profile gray-card">
                                        <div class="card-content">
                                            <img src="../../../images/profiles/profile-empresa-parceira.svg" alt="Avatar da empresa parceira" class="avt-pic">
                                        </div>
                                        <p class="white-title title1 title-profile card-text text-center">Empresa Parceira</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- JS Bootstrap ⬇️ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>