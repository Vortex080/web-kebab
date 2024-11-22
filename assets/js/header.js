import * as User from './Api/UserApi.js';

// Crear un elemento canvas
const canvas = document.createElement('canvas');
const ctx = canvas.getContext('2d');
const userphoto = document.getElementById('userphoto');
const userid = document.getElementById('user').value;
const user = await User.getUser(userid);

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

userphoto.appendChild(canvas);


const carrito = document.getElementById('carrito');

carrito.addEventListener('click', () => {
    window.location.href = '?menu=carrito';
});