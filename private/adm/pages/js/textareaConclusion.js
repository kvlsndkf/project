function colorDiv() {
    const textarea = document.getElementById('conclusion');

    const div = document.getElementById('contentTextArea');

    div.classList.add("border-div");
    teste(textarea);
};

function countText(e,textarea) {
    const counter = document.getElementById('counterTextArea');

    const div = document.getElementById('contentTextArea');
    
    const inputLength = textarea.value.length;
    const maxChars = 200;

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

function teste(textarea){
    if(textarea){
        textarea.addEventListener('keyup', (e)=>{
            countText(e,textarea);
        });
    }
    
    textarea?.addEventListener('keyup', (e)=>{
        countText(e,textarea);
    });
}