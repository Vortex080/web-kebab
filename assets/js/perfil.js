import * as User from './Api/UserApi.js';

const iduser = document.getElementById('user').value;
const editButton = document.getElementById('editButton');
const saveButton = document.getElementById('saveButton');
const cancelButton = document.getElementById('cancelButton');
const profileForm = document.getElementById('profileForm');
const inputs = profileForm.querySelectorAll('input');
const profilePictureContainer = document.getElementById('profile-picture-container');

const user = await User.getUser(iduser);

const username = document.getElementById('username');
const email = document.getElementById('email');
const password = document.getElementById('password');
const foto = document.getElementById('preview');
const monedero = document.getElementById('monedero');
const añadirMonedero = document.getElementById('añadirMonedero');

const dineroinp = document.getElementById('dineroinp');
const cerrarbtn = document.getElementById('cerrarbtn');

monedero.value = user.monedero;
username.value = user.nombre;
email.value = user.email;
foto.src = '../../assets/img/users/' + user.id + '.jpg';
password.value = user.pass;





// Función para habilitar los campos, mostrar los botones y mostrar el input de foto de perfil
function enableEditing() {
    username.disabled = false;
    email.disabled = false;
    password.disabled = false;
    foto.disabled = false;
    profilePictureContainer.style.display = 'block'; // Mostrar el campo de foto de perfil
    editButton.style.display = 'none'; // Ocultar el botón "Editar"
    saveButton.style.display = 'inline-block'; // Mostrar el botón "Guardar"
    cancelButton.style.display = 'inline-block'; // Mostrar el botón "Cancelar"
}

// Función para cancelar la edición y restaurar el estado inicial
function cancelEditing() {
    username.disabled = true;
    email.disabled = true;
    password.disabled = true;
    foto.disabled = true;
    profilePictureContainer.style.display = 'none'; // Ocultar el campo de foto de perfil
    editButton.style.display = 'inline-block'; // Mostrar el botón "Editar"
    saveButton.style.display = 'none'; // Ocultar el botón "Guardar"
    cancelButton.style.display = 'none'; // Ocultar el botón "Cancelar"
}

// Función para guardar los cambios (puedes agregar lógica de envío del formulario aquí)
function saveChanges(event) {
    event.preventDefault(); // Evita el envío del formulario por ahora

    user.nombre = username.value;
    user.email = email.value;
    console.log(password.value);
    user.pass = password.value;
    user.monedero = parseInt(monedero.value);
    //user.foto = foto.src;
    console.log(user.pass)
    User.updateUser(user);

    cancelEditing(); // Después de guardar, volver al estado de edición desactivado
}


añadirMonedero.addEventListener('click', () => {
    dineroinp.disabled = false;
    dineroinp.focus();
    showModal();

});
cerrarbtn.addEventListener('click', () => {
    hideModal();
    monedero.value = parseInt(dineroinp.value) + parseInt(monedero.value);
});

// Asignar eventos a los botones
editButton.addEventListener('click', enableEditing);
cancelButton.addEventListener('click', cancelEditing);
profileForm.addEventListener('submit', saveChanges);


const modalOverlay = document.getElementById('modalOverlay');

function showModal() {
    modalOverlay.classList.add('active');
}

function hideModal() {
    modalOverlay.classList.remove('active');
}