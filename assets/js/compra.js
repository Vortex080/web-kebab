import * as User from './Api/UserApi.js';

const userid = document.getElementById('user').value;
let user = await User.getUser(userid);
let direccion = user.direcction;
let carrito = JSON.parse(user.carrito);
const direccionHTML = document.getElementById('direccion');
const estadoDir = document.getElementById('estado-dir');
const rightSection = document.getElementById('right-section');
const cartContainer = document.getElementById('cart-container');
const precioHtml = document.getElementById('total');
const monedero = document.getElementById('monedero');
const flujemodero = document.getElementById('flujo-cuenta');
const checkoutbtn = document.getElementById('checkout-btn');
const modalOverlay = document.getElementById('modalOverlay');
monedero.innerHTML = user.monedero + ' €';
let precioTotal = 0;
// Botón direción
//const changeAddress = document.getElementById('change-address');
console.log(user);


if (Array.isArray(direccion)) {
    direcction.forEach(element => {
        if (element.status == 1) {
            direccionHTML.innerHTML = element.direction;
            estadoDir.innerHTML = 'Activa';
        }
    });
} else {
    direccionHTML.innerHTML = direccion.direction;
    estadoDir.innerHTML = 'Activa';
}

// Botón para cambiar dirección
// changeAddress.addEventListener('click', function () {});

carrito.forEach(element => {
    const cartitem = document.createElement('div');
    cartitem.className = 'cart-item';

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
    img.src = element.foto;

    cartitem.appendChild(canvas);

    let div = document.createElement('div');
    div.className = 'produic-info';
    let nombre = document.createElement('p');
    nombre.textContent = element.nombre;
    div.appendChild(nombre);
    let ingredientes = document.createElement('p');
    element.ingredientes.forEach(ingrediente => {
        ingredientes.textContent += ingrediente.nombre + ', ';
    });
    div.appendChild(ingredientes);
    let cantidad = document.createElement('p');
    cantidad.textContent = 'Cantidad: ' + element.cantidad;
    div.appendChild(cantidad);
    let precio = document.createElement('p');
    precio.textContent = 'Precio: ' + element.precio;
    div.appendChild(precio);

    cartitem.appendChild(div);

    cartContainer.appendChild(cartitem);

    precioTotal = precioTotal + (parseInt(element.precio) * parseInt(element.cantidad));
    precioHtml.innerHTML = precioTotal;
    flujemodero.innerHTML = (user.monedero - parseInt(precioTotal)) + ' €';
    if (parseInt(flujemodero.innerHTML) >= 0) {
        flujemodero.style.fontWeight = 'bolder'
        flujemodero.style.color = 'green';
        checkoutbtn.classList.add('active');
        checkoutbtn.style.display = 'flex';
    } else {
        flujemodero.style.color = 'red';
        checkoutbtn.classList.remove('active')
        const adddinero = document.createElement('button');
        adddinero.classList.add('address-button');
        const divdinero = document.getElementById('dinero');

        divdinero.appendChild(adddinero);
        adddinero.innerHTML = 'Añadir dinero';
        checkoutbtn.style.display = 'none';
        adddinero.addEventListener('click', function () {
            window.location.href = '?menu=perfil';
        });
    }
});

checkoutbtn.addEventListener('click', function () {
    window.location.href = '?menu=pedido';
});