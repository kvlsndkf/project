const password = document.getElementById("password");
const eye = document.getElementById("eyeOpened");
const confirmPassword = document.getElementById("confirm-password");
const eyeConfirm = document.getElementById("eyeOpenedConfirm");

function openEye() {
    let inputTypePassword = password.type == "password";
    let inputTypePasswordConfirm = confirmPassword.type == "password";

    if (inputTypePassword || inputTypePasswordConfirm) {
        showPassword();
    } else {
        hidePassword();
    }
}

function showPassword() {
    password.setAttribute("type", "text");
    confirmPassword.setAttribute("type", "text");
    eye.setAttribute("src", "/project/views/images/components/closed-eye-password.svg");
}

function hidePassword() {
    password.setAttribute("type", "password");
    confirmPassword.setAttribute("type", "password");
    eye.setAttribute("src", "/project/views/images/components/opened-eye-password.svg");
}