const form = document.getElementById('form-ses');
const btn = document.getElementById('btn');
const email = document.getElementById('email');
const password = document.getElementById('password');
const ewarning = document.getElementById('ewarning');
const pwarning = document.getElementById('pwarning');
import * as User from "./Api/UserApi.js";

btn.addEventListener('click', async function (e) {
    e.preventDefault();
    const usuarios = await User.getAll();
    console.log(usuarios);
    let warning = "";
    // Verificar si el email es valido
    let temp = 0;
    ewarning.innerHTML = "";
    usuarios.forEach(element => {
        if (element.email == email.value) {
            ewarning.innerHTML = "";
            //console.log('Email valida');
            temp++;
        } else {
            warning += "El email no esta registrado";
            ewarning.innerHTML = warning;
        }
    });

    usuarios.forEach(element => {
        warning = "";
        if (element.pass === password.value) {
            //console.log('Pass');
            temp++;
        } else {
            warning += "La contraseña no es correcta";
            pwarning.innerHTML = warning;
        }
    });
    if (temp >= 2) {
        console.log('Sesion exitosa');
        form.submit();
    }
});