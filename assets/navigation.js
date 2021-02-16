let button = document.getElementById("nav-icon");
let liens = document.getElementsByClassName("link");

button.addEventListener("click", () => {
    document.getElementById("main").classList.toggle("open");
});

/*document.getElementById("js-navigation").addEventListener("click", () => {
    document.getElementById("main").classList.toggle("open");
});*/