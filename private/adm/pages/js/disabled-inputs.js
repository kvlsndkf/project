function createdAccount() {
    var checkBox = document.getElementById("createAccount");
  
    if (checkBox.checked) {
        document.getElementById("idTeachers").disabled = false;
        document.getElementById("linkedin").disabled = false;
        document.getElementById("github").disabled = false;
        document.getElementById("facebook").disabled = false;
        document.getElementById("instagram").disabled = false;
        document.getElementById("photo").disabled = false;
    } else {
        document.getElementById("idTeachers").disabled = true;
        document.getElementById("linkedin").disabled = true;
        document.getElementById("github").disabled = true;
        document.getElementById("facebook").disabled = true;
        document.getElementById("instagram").disabled = true;
        document.getElementById("photo").disabled = true;
    }
}