// Regisro nombre
// Variables html
import * as register from "./register.js";
const form = document.getElementById('form-name');
const nextBtn = document.getElementById('nextBtn');
const namer = document.getElementById('name');
const lastname = document.getElementById('lastname');
const direction = document.getElementById('direction');
const localidad = document.getElementById('localidad');
const postal = document.getElementById('postal');
const nwarnings = document.getElementById('nwarning');
const lwarnings = document.getElementById('lwarning');
const dwarnings = document.getElementById('dwarning');
const pwarnings = document.getElementById('pwarning');

// Variables temporales
let temp = 0;

nextBtn.addEventListener('click', function (e) {
    e.preventDefault();
    temp = 0;

    warning = "";
    if (direction.value.length < 1) {
        warning += `La dirección no puede estar vacia<br>`;
        dwarnings.innerHTML = warning;
    } else {
        temp++;
        dwarnings.innerHTML = '';
    }
    if (postal.value.length < 1) {
        warning += `El código postal no puede estar vacio<br>`;
        pwarnings.innerHTML = warning;
    } else {
        temp++;
        pwarnings.innerHTML = '';
    }
    console.log(temp);
    if (temp === 3) {
        form.submit();
    }

});