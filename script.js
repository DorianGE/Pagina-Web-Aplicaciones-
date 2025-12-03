const btn = document.getElementById("btn");
const container = document.querySelector(".container");

if(btn && container){
    btn.addEventListener("click", () => {
        container.classList.toggle("toggle");
    });
} else {
    console.log("No encuentro el botón o el container");
}