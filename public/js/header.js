const navButton = document.getElementById("nav-button");
const navLink = document.getElementById("nav-container");


console.log(navButton);
navButton.addEventListener("click",()=>{
    navLink.classList.toggle("show-link");
    navButton.classList.toggle("rotate-menu");
});