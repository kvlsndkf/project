const textarea = document.getElementById('about2');
const div = document.getElementById('contentTextArea2');
const counter = document.getElementById('counterTextArea2');

function colorDiv() {
    div.classList.add("border-div");
};

function count(e) {
    const inputLength = textarea.value.length;
    const maxChars = 240;

    counter.innerText = maxChars - inputLength;

    if (inputLength >= maxChars) {
        e.preventDefault();
        div.classList.add("border-div-error");
        counter.classList.add("font-color-red");

        textarea.setAttribute('readonly', 'true');

        if (e.key === 'Backspace') {
            textarea.removeAttribute('readonly');
            textarea.value = textarea.value.substring(0, inputLength - 1);
        }
    } else {
        div.classList.remove("border-div-error");
        counter.classList.remove("font-color-red");
    }

};

textarea.addEventListener("keyup", function (e) {
    count(e);
});

(function (e) {
    count(e);
}());