function visibilityDistrict() {
    var checkDistrict = document.getElementById("checkDistrict");
    var textDistrict = document.getElementById("textDistrict");
    var district = document.getElementById("district");
    var city = document.getElementById("city");
    

    if (checkDistrict.checked == true) {
        textDistrict.style.display = "block";
        checkCity.disabled = true;
        city.disabled = true;
        district.disabled = false;
    } else {
        textDistrict.style.display = "none";
        checkCity.disabled = false;
        city.disabled = true;
        district.disabled = true;
    }
}

function visibilityCity() {
    var checkCity = document.getElementById("checkCity");
    var textCity = document.getElementById("textCity");

    if (checkCity.checked == true) {
        textCity.style.display = "block";
        checkDistrict.disabled = true;
        district.disabled = true;
        city.disabled = false;
    } else {
        textCity.style.display = "none";
        checkDistrict.disabled = false;
        city.disabled = true;
        district.disabled = true;
    }
}
