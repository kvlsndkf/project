const textarea1 = document.getElementById('about4');
const div1 = document.getElementById('contentTextArea4');
const counter1 = document.getElementById('counterTextArea4');

function colorDiv1() {
    div1.classList.add("border-div");
};

function count(e) {
    const inputLength = textarea1.value.length;
    const maxChars = 240;

    counte1r.innerText = maxChars - inputLength;

    if (inputLength >= maxChars) {
        e.preventDefault();
        div1.classList.add("border-div-error");
        counter1.classList.add("font-color-red");

        textarea1.setAttribute('readonly', 'true');

        if (e.key === 'Backspace') {
            textarea1.removeAttribute('readonly');
            textarea1.value = textarea1.value.substring(0, inputLength - 1);
        }
    } else {
        div1.classList.remove("border-div-error");
        counter1.classList.remove("font-color-red");
    }

};

textarea1.addEventListener("keyup", function (e) {
    count(e);
});

(function (e) {
    count(e);
}());