import * as Kebab from "./Api/KebabApi.js";
let kebabs = [];
let products = [];

kebabs = await Kebab.getAll();

const productContainer = document.getElementById('productContainer');

kebabs.forEach(product => {
  const productDiv = document.createElement('div');
  productDiv.classList.add('product');
  let array = [];
  product.ingredientes.forEach(ingrediente => {
    array.push(ingrediente.nombre);
  });
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
  img.src = product.foto;

  productDiv.appendChild(canvas);
  const br = document.createElement('br');
  productDiv.appendChild(br);
  const textMenu = document.createElement('div');
  textMenu.classList.add('text-menu');
  textMenu.innerHTML = `
      <a class="producto" href="?menu=producto&id=${product.id}&v=menu">${product.nombre}</a>
    `;
  productDiv.appendChild(textMenu);
  const ingredientes = document.createElement('p');
  ingredientes.innerHTML = `Ingredientes: ${array.join(', ')}`;
  productDiv.appendChild(ingredientes);
  const price = document.createElement('div');
  price.classList.add('price');
  price.innerHTML = `${product.precio} €`;
  productDiv.appendChild(price);
  productContainer.appendChild(productDiv);
});