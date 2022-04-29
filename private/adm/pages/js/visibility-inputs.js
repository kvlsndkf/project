function visibilityDistrict() {
    var checkDistrict = document.getElementById("checkDistrict");
    var textDistrict = document.getElementById("textDistrict");

    if (checkDistrict.checked == true) {
        textDistrict.style.display = "block";
        checkCity.disabled = true;
    } else {
        textDistrict.style.display = "none";
        checkCity.disabled = false;
    }
}

function visibilityCity() {
    var checkCity = document.getElementById("checkCity");
    var textCity = document.getElementById("textCity");

    if (checkCity.checked == true) {
        textCity.style.display = "block";
        checkDistrict.disabled = true;
    } else {
        textCity.style.display = "none";
        checkDistrict.disabled = false;
    }
}
