import * as User from './Api/UserApi.js';

const contenedor = document.querySelector(".product-list");
const iduser = document.getElementById('user').value;
const closeCart = document.getElementById('close-cart');

const user = await User.getUser(iduser);

console.log(JSON.parse(user.carrito));

let carrito = JSON.parse(user.carrito);

carrito.forEach(producto => {

    // Crear el contenedor del producto
    const productItem = document.createElement("div");
    productItem.classList.add("product-item");

    // Crear la imagen del producto
    const imagen = document.createElement("img");
    imagen.src = '../../assets/img/' + producto.foto;
    imagen.alt = producto.nombre;

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
    inputCantidad.value = 1;
    inputCantidad.min = 1;
    inputCantidad.classList.add("product-quantity");

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
        // TODO
        console.log(producto.id);
        console.log(user.carrito);
        let eliminado = user.carrito.find(producto => producto.id === producto.id);
    });

    // Agregar los elementos al contenedor del producto
    productItem.appendChild(imagen);
    productItem.appendChild(productInfo);
    productItem.appendChild(botonEliminar);

    // Agregar el producto al contenedor principal
    contenedor.appendChild(productItem);
});

closeCart.addEventListener('click', function () {
    // Manda al menu
    closeCart.href = '?menu=menu';
});