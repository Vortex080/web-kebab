import * as User from './Api/UserApi.js';

const Iduser = await User.getsession();
const contenedor = document.querySelector(".product-list");

console.log(Iduser.id);

const user = await User.getUser(Iduser.id);

console.log(JSON.parse(user.carrito));

let carrito = [];

carrito.push(JSON.parse(user.carrito));

console.log(carrito);

carrito.forEach(producto => {

    // Crear el contenedor del producto
    const productItem = document.createElement("div");
    productItem.classList.add("product-item");

    // Crear la imagen del producto
    const imagen = document.createElement("img");
    imagen.src = producto.imagen;
    imagen.alt = producto.nombre;

    // Crear el contenedor de información del producto
    const productInfo = document.createElement("div");
    productInfo.classList.add("product-info");

    // Crear el nombre del producto
    const nombre = document.createElement("p");
    nombre.classList.add("product-name");
    nombre.textContent = producto.nombre;

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
    inputCantidad.value = 1;
    inputCantidad.min = 1;
    inputCantidad.classList.add("product-quantity");

    // Agregar el label y el input al contenedor de información
    productInfo.appendChild(nombre);
    productInfo.appendChild(precio);
    productInfo.appendChild(label);
    productInfo.appendChild(inputCantidad);

    // Crear el botón de eliminar
    const botonEliminar = document.createElement("button");
    botonEliminar.classList.add("remove-product");
    botonEliminar.textContent = "Eliminar";

    // Agregar los elementos al contenedor del producto
    productItem.appendChild(imagen);
    productItem.appendChild(productInfo);
    productItem.appendChild(botonEliminar);

    // Agregar el producto al contenedor principal
    contenedor.appendChild(productItem);
});