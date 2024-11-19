import * as User from './Api/UserApi.js';

const iduser = document.getElementById('user').value;
const editButton = document.getElementById('editButton');
const saveButton = document.getElementById('saveButton');
const cancelButton = document.getElementById('cancelButton');
const profileForm = document.getElementById('profileForm');
const inputs = profileForm.querySelectorAll('input');
const profilePictureContainer = document.getElementById('profile-picture-container');
const inpuitfoto = document.getElementById('profile-picture');

const user = await User.getUser(iduser);

const username = document.getElementById('username');
const email = document.getElementById('email');
const password = document.getElementById('password');
const foto = document.getElementById('preview');
const monedero = document.getElementById('monedero');
const añadirMonedero = document.getElementById('añadirMonedero');

const dineroinp = document.getElementById('dineroinp');
const cerrarbtn = document.getElementById('cerrarbtn');
const previewContainer = document.getElementById('preview-container');
let imagenEn64 = '';
const RecortarModal = document.getElementById('imageModal');
const closeModal = document.getElementById('closeModalBtnPhoto');
// Nodo donde estará el editor
const editor = document.querySelector('#editor');
// El canvas donde se mostrará la previa
const miCanvas = document.createElement('canvas');
miCanvas.className = 'foto';

// Contexto del canvas
const contexto = miCanvas.getContext('2d');
// Ruta de la imagen seleccionada
let urlImage = undefined;

monedero.value = user.monedero;
username.value = user.nombre;
email.value = user.email;
// Crear un elemento canvas
const canvas = document.createElement('canvas');
const ctx = canvas.getContext('2d');

// Establecer las dimensiones del canvas (ajústalas a lo que necesites)
canvas.width = 150;
canvas.height = 150;

// Crear un objeto de imagen
const img = new Image();

// Establecer la URL de la imagen usando la propiedad 'Ingrediente.foto'
img.onload = function () {
    // Dibujar la imagen en el canvas cuando la carga esté completa
    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
};
// Establecer el src de la imagen (ruta de la foto)
img.src = user.foto;

canvas.className = 'foto';

// Agregar el canvas al contenedor
previewContainer.appendChild(canvas);
password.value = user.pass;





// Función para habilitar los campos, mostrar los botones y mostrar el input de foto de perfil
function enableEditing() {
    username.disabled = false;
    email.disabled = false;
    password.disabled = false;
    foto.disabled = false;
    inpuitfoto.disabled = false;
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
    inpuitfoto.disabled = true;
    //profilePictureContainer.style.display = 'none'; // Ocultar el campo de foto de perfil
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
    console.log(imagenEn64);
    user.foto = imagenEn64;
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
saveButton.addEventListener('click', saveChanges);

inpuitfoto.addEventListener('change', abrirEditor, false);

const modalOverlay = document.getElementById('modalOverlay');

function showModal() {
    modalOverlay.classList.add('active');
}

function hideModal() {
    modalOverlay.classList.remove('active');
}

/**
   * Método que abre el editor con la imagen seleccionada
   */
function abrirEditor(e) {
    RecortarModal.style.display = 'flex ';
    // Obtiene la imagen
    urlImage = URL.createObjectURL(e.target.files[0]);

    // Borra editor en caso que existiera una imagen previa
    editor.innerHTML = '';
    let cropprImg = document.createElement('img');
    cropprImg.setAttribute('id', 'croppr');
    editor.appendChild(cropprImg);

    // Limpia la previa en caso que existiera algún elemento previo
    contexto.clearRect(0, 0, miCanvas.width, miCanvas.height);

    // Envia la imagen al editor para su recorte
    document.querySelector('#croppr').setAttribute('src', urlImage);

    // Crea el editor
    new Croppr('#croppr', {
        aspectRatio: 1,
        maxSize: [600, 600],
        minSize: [300, 300],
        startSize: [300, 300, 'px'], // Tamaño inicial del recorte
        onCropStart: () => false, // Evita que el usuario cambie el tamaño
        onCropEnd: recortarImagen
    })
}

/**
* Método que recorta la imagen con las coordenadas proporcionadas con croppr.js
*/
function recortarImagen(data) {
    // Variables
    const inicioX = data.x;
    const inicioY = data.y;
    const nuevoAncho = data.width;
    const nuevaAltura = data.height;
    const zoom = 1;

    // La imprimo
    miCanvas.width = nuevoAncho;
    miCanvas.height = nuevaAltura;
    // La declaro
    let miNuevaImagenTemp = new Image();
    // Cuando la imagen se carge se procederá al recorte
    miNuevaImagenTemp.onload = function () {
        // Se recorta
        contexto.drawImage(miNuevaImagenTemp, inicioX, inicioY, nuevoAncho * zoom, nuevaAltura * zoom, 0, 0, nuevoAncho, nuevaAltura);
        // Se transforma a base64
        imagenEn64 = miCanvas.toDataURL("image/jpeg");


        // Mostramos el código generado
        //document.querySelector('#base64').textContent = imagenEn64;
        //document.querySelector('#base64HTML').textContent = '<img src="' + imagenEn64.slice(0, 40) + '...">';

    }
    // Proporciona la imagen cruda, sin editarla por ahora
    miNuevaImagenTemp.src = urlImage;
}


closeModal.addEventListener('click', () => {
    RecortarModal.style.display = 'none';
    previewContainer.innerHTML = '';
    previewContainer.appendChild(miCanvas);

});

// Seleccionar el botón y el modal
const openModalButton = document.getElementById('abrirDirecction');
const modal = document.getElementById('modal-direcction');

// AgrabrirDirecctiongar evento al botón para mostrar el modal
openModalButton.addEventListener('click', () => {
    modal.style.display = 'flex'; // Mostrar el modal
});

// Opción abrirDirecctiondicional: cerrar el modal al hacer clic fuera de él
modal.addEventListener('click', (event) => {
    if (event.target === modal) {
        modal.style.display = 'none'; // Ocultar el modal
    }
});