const username = document.getElementById("username")
const useremail = document.getElementById("useremail");
const password = document.getElementById("password");

// const showPass = document.querySelectorAll(".show-password");




const showPassid = document.getElementById("show-password");

// SET HEIGHT OF SLIDER

const signup = document.getElementById("form-container");
const hoverOnload = document.getElementById("hover-onload");

hoverOnload.style.height = `${signup.getBoundingClientRect().height}px`;
window.addEventListener("load", ()=>{
    hoverOnload.style.height = `${signup.getBoundingClientRect().height}px`;
    hoverOnload.style.display = "flex";
})
// CODE FOR SHOWING PASSWORD
// showPass.forEach((items)=>{
//     items.addEventListener("click",(e)=>{
//         const btn = e.currentTarget.classList;
//         console.log(btn);
//         if (btn.contains("enter")) {
//             if(password.type === "password"){
//                 password.setAttribute("type","text");
//                 btn.innerHTML = `<i class="fa-solid fa-eye-slash"></i>`;
//             }else{
//                 password.setAttribute("type","password");
//                 btn.innerHTML = `<i class="fa-regular fa-eye"></i>`;
//             }
//         }else{
//             if(confirmPass.type === "password"){
//                 confirmPass.setAttribute("type","text");
//                 btn.innerHTML = `<i class="fa-solid fa-eye-slash"></i>`;
//             }else{
//                 confirmPass.setAttribute("type","password");
//                 btn.innerHTML = `<i class="fa-regular fa-eye"></i>`;
//             }
//         }
//     })
// })

const showReenterPass = document.getElementById("show-reenter-password")
const confirmPass = document.getElementById("confirm-password");

showPassid.addEventListener("click",()=>{
    if (password.type === "password") {
        password.setAttribute("type","text");
        showPassid.innerHTML = `<i class="fa-solid fa-eye-slash"></i>`;
    }else{
        password.setAttribute("type","password");
        showPassid.innerHTML = `<i class="fa-regular fa-eye"></i>`;
    }
})
showReenterPass.addEventListener("click",()=>{
    if (confirmPass.type === "password") {
        confirmPass.setAttribute("type","text");
        showReenterPass.innerHTML = `<i class="fa-solid fa-eye-slash"></i>`;
    }else{
        confirmPass.setAttribute("type","password");
        showReenterPass.innerHTML = `<i class="fa-regular fa-eye"></i>`;
    }
})

// CODE FOR SUBMIT FORM 

const passMismatch = document.getElementById("password-mismatch");

signup.addEventListener("submit",(form)=>{
    if(password.value == "" || useremail.value == "" || passMismatch.value == "" || username.value == ""){
        window.alert("Inputs cannot be blank!");
        form.preventDefault();
        return false;
    }else if(password.value !== confirmPass.value){
        form.preventDefault();
        password.style.border = "solid 1px red";
        confirmPass.style.border = "solid 1px red";
        passMismatch.style.visibility = "visible";
        hoverOnload.style.height = `${signup.getBoundingClientRect().height}px`;
        return false;
    }
})