import * as User from './Api/UserApi.js';

const ingredientes = document.getElementById('ingredientes');
const ingredientesLista = JSON.parse(document.getElementById('productophp').value);
const precio = document.getElementById('product-price');
const btnaddcart = document.getElementById('carrito-btn');
const kebab = JSON.parse(document.getElementById('productosql').value);
const iduser = document.getElementById('user').value;


const user = await User.getUser(iduser);

ingredientesLista.forEach(ingrediente => {
    const ingredienteDiv = document.createElement('div');
    ingredienteDiv.className = "ingrediente";
    ingredienteDiv.innerHTML = `${ingrediente.nombre} -> ${ingrediente.precio} €`;
    ingredienteDiv.draggable = true;
    ingredienteDiv.dataset.name = [ingrediente.id, ingrediente.nombre, ingrediente.precio]; // Identificador único
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

    if (val == false) {
        allingredientes.forEach(all => {
            if (ingredientesLista.find(element => element.nombre === all.nombre)) {
                console.log('');
            } else {
                val = true;
                const divIngrediente = document.createElement("div");
                divIngrediente.className = "ingrediente";
                divIngrediente.innerHTML = `${all.nombre} -> ${all.precio} €`;
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

    const foto = document.getElementById('foto').src;
    const producto = JSON.stringify({ nombre: name, precio: parseInt(final), ingredientes: ingredientesjson, foto: foto, cantidad: parseInt(quantity) });
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
