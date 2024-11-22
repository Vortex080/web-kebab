import * as User from './Api/UserApi.js';

const contenedor = document.querySelector(".product-list");
const iduser = document.getElementById('user').value;
const closeCart = document.getElementById('close-cart');
const checkoutBtn = document.getElementById('checkout-btn');
const precioTotal = document.getElementById('precio-total');
let total = 0;

const user = await User.getUser(iduser);
console.log(user);
let carrito = JSON.parse(user.carrito);
let i = 0
let y = 0;
carrito.forEach(producto => {

    // Crear el contenedor del producto
    const productItem = document.createElement("div");
    productItem.classList.add("product-item");


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
    img.src = producto.foto;

    // Crear el contenedor de información del producto
    const productInfo = document.createElement("div");
    productInfo.classList.add("product-info");

    // Crear el nombre del producto
    const nombre = document.createElement("a");
    nombre.classList.add("product-name");
    nombre.href = "?menu=producto&id=" + producto.id + "&v=carrito";
    nombre.textContent = producto.nombre;

    // Ingredientes
    const ingredientes = document.createElement("p");
    ingredientes.classList.add("product-ingredients");
    producto.ingredientes.forEach(ingrediente => {
        ingredientes.textContent += ingrediente.nombre + ", ";
    });

    // Crear el precio del producto
    const precio = document.createElement("p");
    precio.classList.add("product-price");
    precio.textContent = `Precio: ${producto.precio}€`;

    // Crear el label y el input de cantidad
    const label = document.createElement("label");
    label.setAttribute("for", "quantity");
    label.textContent = "Cantidad:";

    const inputCantidad = document.createElement("input");
    inputCantidad.type = "number";
    inputCantidad.value = producto.cantidad;
    inputCantidad.min = 1;
    inputCantidad.classList.add("product-quantity");

    inputCantidad.addEventListener('change', function () {
        let carritoarray = JSON.parse(user.carrito);
        for (let z = 0; z < carritoarray.length; z++) {
            if (carritoarray[z].id == producto.id) {
                console.log(carritoarray[z]);
                carritoarray[z].cantidad = inputCantidad.value;
            }
        }
        user.carrito = carritoarray;
        User.updateUser(user);
    });


    // Agregar el label y el input al contenedor de información
    productInfo.appendChild(nombre);
    productInfo.appendChild(ingredientes);
    productInfo.appendChild(precio);
    productInfo.appendChild(label);
    productInfo.appendChild(inputCantidad);

    // Crear el botón de eliminar
    const botonEliminar = document.createElement("button");
    botonEliminar.classList.add("remove-product");
    botonEliminar.textContent = "Eliminar";

    botonEliminar.addEventListener('click', function () {
        contenedor.removeChild(productItem);
        carrito.splice(i - 1, 1);
        user.carrito = carrito;
        User.updateUserUser(user);
    });

    // Agregar los elementos al contenedor del producto
    productItem.appendChild(img);
    productItem.appendChild(productInfo);
    productItem.appendChild(botonEliminar);

    // Agregar el producto al contenedor principal
    contenedor.appendChild(productItem);


    total = total + (parseInt(producto.precio) * parseInt(producto.cantidad));

    precioTotal.innerHTML = `${total} €`;
    i++;
    y++;
});

closeCart.addEventListener('click', function () {
    // Manda al menu
    closeCart.href = '?menu=menu';
});

checkoutBtn.addEventListener('click', function () {
    // Manda al menu
    checkoutBtn.href = '?menu=compra';
});