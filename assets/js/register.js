// Registro
// Variables html
const form = document.getElementById('form-reg');
const nextBtn = document.getElementById('nextBtn');
const emailr = document.getElementById('email');
const password = document.getElementById('password');
const ewarning = document.getElementById('ewarning');
const password2 = document.getElementById('password2');
import * as User from "./Api/UserApi.js";


// Variables temporales
let temp = 0;

nextBtn.addEventListener('click', function(e) {
    e.preventDefault();
    temp = 0;
    let warning = "";
    let regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

    // Verificar si el email es valido
    if (!regex.test(emailr.value)) {
        warning += "El email ingresado no es valido";
        ewarning.innerHTML = warning;
        const usuarios = User.getAll();
        for (const element of usuarios) {
            if (element.email === emailr.value) {
                warning += "El email ya esta en uso";
                ewarning.innerHTML = warning;
                break;
            }
        }
    } else {
        ewarning.innerHTML = "";
        temp++;
        console.log('Email valida');
    }
    warning = "";
    // Verificar si la contraseña es valida

    if (password.value.length < 8) {
        warning += "La contraseña debe tener al menos 8 caracteres";
        pwarning.innerHTML = warning;
    } else {
        pwarning.innerHTML = "";
        temp++;
        console.log('pass1 valida');
    }
    warning = "";
    // Verificar si las contraseñas son iguales
    if (password.value !== password2.value) {
        warning += "Las contraseñas no coinciden";
        ppwarning.innerHTML = warning;
    } else {
        ppwarning.innerHTML = "";
        temp++;
        console.log('pass2 valida');
    }
    warning = "";
    if (namer.value.length < 6) {
        warning += `El nombre no puede ser menor a 6 caracteres <br>`;
        nwarnings.innerHTML = warning;
    } else {
        temp++;
        nwarnings.innerHTML = '';
    }
    console.log(temp);
    if (temp === 5) {
        form.submit();
    }

});