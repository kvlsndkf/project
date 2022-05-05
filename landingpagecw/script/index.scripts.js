window.addEventListener("scroll", function(){
    var nav = document.querySelector("nav");
    nav.classList.toggle("sticky", window.scrollY > 0);
    nav.classList.toggle("navbar-dark", window.scrollY > 0);
});