// Regisro nombre
// Variables html
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
    let warning = "";
    if (namer.value.length < 6) {
        warning += `El nombre no puede ser menor a 6 caracteres <br>`;
        nwarnings.innerHTML = warning;
    } else {
        temp++;
        nwarnings.innerHTML = '';
    }
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