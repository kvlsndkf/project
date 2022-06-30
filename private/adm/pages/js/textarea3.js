const textarea2 = document.getElementById('about');
const div2 = document.getElementById('contentTextArea');
const counter2 = document.getElementById('counterTextArea');

function colorDiv() {
    div2.classList.add("border-div");
};

function count(e) {
    const inputLength = textarea2.value.length;
    const maxChars = 240;

    counter2.innerText = maxChars - inputLength;

    if (inputLength >= maxChars) {
        e.preventDefault();
        div2.classList.add("border-div-error");
        counter2.classList.add("font-color-red");

        textarea2.setAttribute('readonly', 'true');

        if (e.key === 'Backspace') {
            textarea2.removeAttribute('readonly');
            textarea2.value = textarea2.value.substring(0, inputLength - 1);
        }
    } else {
        div2.classList.remove("border-div-error");
        counter2.classList.remove("font-color-red");
    }

};

textarea2.addEventListener("keyup", function (e) {
    count(e);
});

(function (e) {
    count(e);
}());