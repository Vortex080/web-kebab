import * as User from './Api/UserApi.js';

const ingredientes = document.getElementById('ingredientes');
const ingredientesLista = JSON.parse(document.getElementById('productophp').value);
const precio = document.getElementById('product-price');
const btnaddcart = document.getElementById('carrito-btn');
const kebab = JSON.parse(document.getElementById('productosql').value);
const iduser = document.getElementById('user').value;
const productimage = document.getElementById('product-image');



const user = await User.getUser(iduser);

ingredientesLista.forEach(ingrediente => {
    const ingredienteDiv = document.createElement('div');
    ingredienteDiv.className = "ingrediente";
    // Crear la imagen
    const foto = document.createElement('img');
    foto.src = ingrediente.foto;
    foto.alt = ingrediente.nombre;
    foto.style.width = '40px';  // Opcional: establecer tamaño de la imagen
    foto.style.height = '40px'; // Opcional: establecer tamaño de la imagen

    // Añadir la imagen al div
    ingredienteDiv.appendChild(foto);
    // Añadir el nombre y precio
    const nombrePrecio = document.createElement('p');
    nombrePrecio.textContent = ` ${ingrediente.nombre} -> ${ingrediente.precio} €`;

    // Añadir el texto al div
    ingredienteDiv.appendChild(nombrePrecio);
    ingredienteDiv.draggable = true;
    ingredienteDiv.dataset.name = [ingrediente.id, ingrediente.nombre, ingrediente.precio];
    ingredientes.appendChild(ingredienteDiv);
});


const allergen = document.getElementById('lista-alergenos');
const allergens = JSON.parse(document.getElementById('productophp').value);
allergens.forEach(Ingrediente => {
    Ingrediente.alergenos.forEach(alergeno => {
        const icon = document.createElement('img');
        icon.src = '../../assets/img/alergenos/' + alergeno.foto;
        icon.alt = alergeno.nombre;
        icon.title = alergeno.nombre;
        allergen.appendChild(icon);
    });
});

function alergenos(ingredientesLista) {
    let allergen = document.getElementById('lista-alergenos');
    allergen.innerHTML = '';
    let arrayingselec = [];
    let iding = [];
    ingredientesLista.forEach(ingrediente => {
        iding.push(ingrediente.name[0]);
    });
    allingredientes.forEach(ing => {
        iding.forEach(id => {
            if (ing.id == id) {
                arrayingselec.push(ing);
            }
        });
    });
    arrayingselec.forEach(element => {
        if (element.alergenos.length > 0) {
            element.alergenos.forEach(alerg => {
                const icon = document.createElement('img');
                console.log(alerg.foto);
                icon.src = '../../assets/img/alergenos/' + alerg.foto;
                icon.alt = alerg.nombre;
                icon.title = alerg.nombre;
                allergen.appendChild(icon);
                console.log(element);
            });
        }
    });
}

const personalizarbtn = document.getElementById('per-btn');
const allingredientes = JSON.parse(document.getElementById('allingredientes').value);
const ingredientesdiv = document.getElementById('ingredientes-div');
const ingredienteslist = document.getElementById('todos-ingredientes-list');
const productdeatils = document.getElementById('product-window');

let preciocaltulado = 0;
let val = false;
const selectedIngredients = [];

personalizarbtn.addEventListener('click', function () {
    productdeatils.style.maxWidth = "1000px";
    ingredientesdiv.style.display = 'block';
    val = false;
    if (val == false) {
        allingredientes.forEach(all => {
            if (ingredientesLista.find(element => element.nombre === all.nombre)) {
                console.log('');
            } else {
                val = true;
                const divIngrediente = document.createElement("div");
                divIngrediente.className = "ingrediente";
                // Crear la imagen
                // Crear un objeto de imagen
                const foto = new Image();

                // Establecer la URL de la imagen usando la propiedad 'Ingrediente.foto'
                foto.onload = function () {
                    // Dibujar la imagen en el canvas cuando la carga esté completa
                    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                };

                // Establecer el src de la imagen (ruta de la foto)
                foto.src = all.foto;


                foto.alt = all.nombre;
                foto.style.width = '40px';  // Opcional: establecer tamaño de la imagen
                foto.style.height = '40px'; // Opcional: establecer tamaño de la imagen

                // Añadir la imagen al div
                divIngrediente.appendChild(foto);
                // Añadir el nombre y precio
                const nombrePrecio = document.createElement('p');
                nombrePrecio.textContent = ` ${all.nombre} -> ${all.precio} €`;

                // Añadir el texto al div
                divIngrediente.appendChild(nombrePrecio);
                divIngrediente.draggable = true;
                divIngrediente.dataset.name = [all.id, all.nombre, all.precio];
                ingredienteslist.appendChild(divIngrediente);
            }
        });
    }

    personalizarbtn.textContent = "Guardar";

    personalizarbtn.addEventListener('click', function () {
        productdeatils.style.maxWidth = "600px";
        ingredientesdiv.style.display = 'none';
        val = false;
        personalizarbtn.textContent = "Personalizar";



        // Obtener los ingredientes actualmente en "product-ingredients" con sus ID únicos

        ingredientes.querySelectorAll('.ingrediente').forEach(ingrediente => {
            selectedIngredients.push({
                name: ingrediente.dataset.name,
                id: ingrediente.id
            });
        });
        preciocaltulado = calcularPrecio(precio, selectedIngredients);
        alergenos(selectedIngredients);
    });

    // Funciones de arrastrar y soltar
    document.querySelectorAll('.ingrediente').forEach(item => {
        item.addEventListener('dragstart', function (e) {
            e.dataTransfer.setData('text/plain', e.target.dataset.name);
        });
    });

    let uniqueIdCounter = 1;

    // Permitir soltar en los contenedores
    [ingredientes, ingredienteslist].forEach(container => {
        container.addEventListener('dragover', function (e) {
            e.preventDefault();
        });

        container.addEventListener('drop', function (e) {
            e.preventDefault();
            const name = e.dataTransfer.getData('text/plain');
            const draggedElement = document.querySelector(`.ingrediente[data-name="${name}"]`);

            if (draggedElement && !container.contains(draggedElement)) {
                // Si el ingrediente se arrastra a product-ingredients, le asigna un ID único
                if (container === ingredientes) {
                    draggedElement.id = `ingrediente-${uniqueIdCounter++}`;
                } else {
                    // Si el ingrediente vuelve a la lista general, elimina el ID
                    draggedElement.removeAttribute('id');
                }
                container.appendChild(draggedElement);
            }
        });
    });
});

function calcularPrecio(precio, selectedIngredients) {
    let precioTotal = 0;
    selectedIngredients.forEach(ingrediente => {
        let precio = ingrediente.name.split(',');
        precioTotal += parseInt(precio[2]);
    });
    precio.innerHTML = `${precioTotal} €`;
    return precioTotal;
}


btnaddcart.addEventListener('click', async function () {
    const name = document.getElementById('product-title').innerHTML;
    const quantity = document.getElementById('quantity').value;
    ingredientes.querySelectorAll('.ingrediente').forEach(ingrediente => {
        selectedIngredients.push({
            id: ingrediente.dataset.name[0],
        });
    });
    let ingredientesjson = selectedIngredients;
    let final = '';
    if (preciocaltulado === 0) {
        let temp = precio.innerHTML.split('€')
        final = temp[0].trim();
    } else {
        final = preciocaltulado;
    }


    kebab.precio = parseInt(final);
    let ids = [];
    allingredientes.forEach(ingrediente => {
        selectedIngredients.forEach(element => {
            if (ingrediente.id === parseInt(element.id)) {
                ids.push(ingrediente);
            }
        });
    });
    kebab.ingredientes = ids;
    //console.log('kebab modificado');
    //console.log(JSON.stringify(kebab));
    let array = [];
    if (user.carrito.length > 0) {
        array = JSON.parse(user.carrito);
        array.push(kebab);
        user.carrito = array;
    } else {
        array.push(kebab);
    }

    user.carrito = array;
    User.updateUserUser(user);
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
img.src = kebab.foto;

productimage.appendChild(canvas);