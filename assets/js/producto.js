const ingredientes = document.getElementById('ingredientes');
const ingredientesLista = JSON.parse(document.getElementById('productophp').value);
ingredientesLista.forEach(ingrediente => {
    const ingredienteDiv = document.createElement('div');
    ingredienteDiv.className = "ingrediente";
    ingredienteDiv.innerHTML = `${ingrediente.nombre} -> ${ingrediente.precio} €`;
    ingredienteDiv.draggable = true;
    ingredienteDiv.dataset.name = ingrediente.nombre; // Identificador único
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
let val = false;

personalizarbtn.addEventListener('click', function () {
    productdeatils.style.maxWidth = "1000px";
    ingredientesdiv.style.display = 'block';

    if (val == false) {
        allingredientes.forEach(all => {
            if (ingredientesLista.find(element => element.nombre === all.nombre)) {
            } else {
                val = true;
                const divIngrediente = document.createElement("div");
                divIngrediente.className = "ingrediente";
                divIngrediente.innerHTML = `${all.nombre} -> ${all.precio} €`;
                divIngrediente.draggable = true;
                divIngrediente.dataset.name = all.nombre;
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
        const selectedIngredients = [];
        ingredientes.querySelectorAll('.ingrediente').forEach(ingrediente => {
            selectedIngredients.push({
                name: ingrediente.dataset.name,
                id: ingrediente.id
            });
            console.log(selectedIngredients);
        });
    });

    // TODO Preguntar como guardar kebab personalizado y mandarlo al carrito

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