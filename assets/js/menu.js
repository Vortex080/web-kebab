import * as Kebab from "./Api/KebabApi.js";
let kebabs = [];
let products = [];

kebabs = await Kebab.getAll();
kebabs.forEach(kebab => {
  products.push({ id: kebab.id, name: kebab.nombre, image: '../../assets/img/' + kebab.foto, price: kebab.precio + ' €' });
});


const productContainer = document.getElementById('productContainer');

products.forEach(product => {
  const productDiv = document.createElement('div');
  productDiv.classList.add('product');

  productDiv.innerHTML = `
      <img src="${product.image}" alt="${product.name}" load="lazy">
      <br>
      <div class="text-menu">
        <a class="producto" href="?menu=producto&id=${product.id}&v=menu">${product.name}</a>
      </div>
        <div class="price">${product.price}</div>
        <button class="btn-menu">Añadir al carrito</button>
    `;

  productContainer.appendChild(productDiv);
});