<?php
require_once('/xampp/htdocs' . '/project/classes/cookies/Cookie.class.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados da conta | Heelp!</title>

    <!-- STYLES -->
    <link rel="stylesheet" href="../../../styles/style.global.css">
    <link rel="stylesheet" href="../../../styles/colors.style.css">
    <link rel="stylesheet" href="../../../styles/font-format.style.css">
    <link rel="stylesheet" href="../../../styles/fonts.style.css">
    <link rel="stylesheet" href="../../../styles/input.style.css">
    <link rel="stylesheet" href="../../../styles/button.style.css">
    <link rel="stylesheet" href="./register-student.style.css">

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="page-container d-flex align-items-center justify-content-center">
        <div class="bg-modal-gray align-self-center my-auto form-base-plump">
            <div class="d-flex justify-content-between">

                <a href="../register-profile/register-profile.pages.php"><img src="../../../../private/adm/images/components/arrow.svg" alt="Seta para voltar" class="mb-2"></a>

                <label class="normal-14-bold-p">Etapa 1/4</label>
            </div>
            <div class="text-center form-student-titles">
            <span class="normal-22-black-title-1 gray-title">Bora lá...</span>
            <br/>
            <span class="normal32-black-landingpagetitle-2">Criar uma conta</span>
            </div>
            <form action="./controller/step1-cookie.controller.php" method="post">
                <p class="normal-18-bold-title-2 subtitle-data">Dados de acesso</p>
                <div>
                    <label class="normal-14-bold-p gray-title forms-label-student">Email institucional</label>
                    <br>
                    <?php $emailCookie =  !is_null(Cookie::reader('email')) ? Cookie::reader('email') : ''; ?>
                    <input type="email" name="email" id="email" class="normal-12-regular-tinyinput input-text" placeholder="Digite seu Email institucional" required value="<?php echo $emailCookie; ?>" autocomplete="off" autofocus>
                </div>
                <br>
                <br>
                <div>
                    <label class="normal-14-bold-p gray-title forms-label-student">Senha</label>
                    <br>

                    <?php $passwordCookie =  !is_null(Cookie::reader('password')) ? Cookie::reader('password') : ''; ?>
                    <div class="container-input-and-icon">
                    <input type="password" name="password" id="password" class="normal-12-regular-tinyinput input-text pass-input" placeholder="Digite sua senha" required value="<?php echo $passwordCookie; ?>">
                    <img src="../image/components/show-pass.svg" class="eye-icon" alt="" id="eyeOpened" onclick="openEye()">
                    </div>
                </div>
                <br>
                <br>
                <div>
                    <label class="normal-14-bold-p gray-title forms-label-student">Confirme a senha</label>
                    <br>
                    <?php $confirmPasswordCookie =  !is_null(Cookie::reader('confirm-password')) ? Cookie::reader('confirm-password') : ''; ?>
                    <input type="password" name="confirm-password" class="normal-12-regular-tinyinput input-text" id="confirm-password" placeholder="Confirme a senha" required value="<?php echo $confirmPasswordCookie; ?>">
                </div>
                <br>
                <br>
                <input type="submit" class=" button-wide submit-button-primary normal-14-bold-p" value="Continuar" name="step1">
            </form>
        </div>

    </div>

    <!-- JS mostrar senha -->
    <script src="../../../js/password-visibility.js"></script>
</body>

</html>