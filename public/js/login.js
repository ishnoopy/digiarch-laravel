const useremail = document.getElementById("useremail");
const password = document.getElementById("password");
const showPass = document.getElementById("show-password");
const Login = document.getElementById("form-container");
const wrongInput = document.querySelectorAll(".wrong-input");
const loginBtn = document.getElementById("login");
const hoverOnload = document.getElementById("hover-onload")

// SET HEIGHT FOR SLIDER
hoverOnload.style.height = `${Login.getBoundingClientRect().height}px`;
window.addEventListener("load", ()=>{
    hoverOnload.style.height = `${Login.getBoundingClientRect().height}px`;
    hoverOnload.style.display = "flex"
})

// CODE FOR SHOWING PASSWORD
showPass.addEventListener("click",()=>{
    if (password.type === "password") {
        password.setAttribute("type","text");
        showPass.innerHTML = `<i class="fa-solid fa-eye-slash"></i>`;
    }else{
        password.setAttribute("type","password");
        showPass.innerHTML = `<i class="fa-regular fa-eye"></i>`;
    }
})