// Obtener el botón de limpiar
const btnClear = document.querySelector('.btn-clear');
const ingredientes = document.getElementById('ingredientes');
const ingredientesIncluidosList = document.getElementById('ingredientes-incluidos-list');
const Allingredientes = JSON.parse(document.getElementById('allingredientes').value);
const ingredientesList = document.getElementById('todos-ingredientes-list');
const todosIngredientesList = document.getElementById('todos-ingredientes-list');

// Función para limpiar los campos del formulario
btnClear.addEventListener('click', function () {
    // Limpiar todos los campos de texto (input) y áreas de texto (textarea)
    const inputs = document.querySelectorAll('input[type="text"], input[type="file"], textarea');

    inputs.forEach(input => {
        if (input.type === "file") {
            // Si es un input de tipo file, reiniciamos el valor
            input.value = '';
        } else {
            // Limpiar los campos de texto y textarea
            input.value = '';
        }
    });

    // Limpiar la lista de ingredientes incluidos (si se requiere)

    ingredientesIncluidosList.innerHTML = ''; // Borra los ingredientes incluidos
    ingredientesList.innerHTML = ''; // Borra Todos los ingredientes

    Allingredientes.forEach(ingrediente => {
        const ingredienteDiv = document.createElement('div');
        ingredienteDiv.className = "ingrediente";
        ingredienteDiv.innerHTML = `${ingrediente.nombre} -> ${ingrediente.precio} €`;
        ingredienteDiv.draggable = true;
        ingredienteDiv.dataset.name = ingrediente.nombre; // Identificador único
        ingredientesList.appendChild(ingredienteDiv);
    });

    const precio = document.getElementById('precio');
    precio.innerHTML = ''; // Borra el precio

    const name = document.getElementById('name');
    name.innerHTML = '';

    // NOTA: La sección de "Todos los Ingredientes" se mantendrá intacta
});


Allingredientes.forEach(ingrediente => {
    const ingredienteDiv = document.createElement('div');
    ingredienteDiv.className = "ingrediente";
    ingredienteDiv.innerHTML = `${ingrediente.nombre} -> ${ingrediente.precio} €`;
    ingredienteDiv.draggable = true;
    ingredienteDiv.dataset.name = ingrediente.nombre; // Identificador único
    ingredientesList.appendChild(ingredienteDiv);
});


// Funciones de arrastrar y soltar
document.querySelectorAll('.ingrediente').forEach(item => {
    item.addEventListener('dragstart', function (e) {
        e.dataTransfer.setData('text/plain', e.target.dataset.name);
    });
});

let uniqueIdCounter = 1;

// Permitir soltar en los contenedores
[ingredientesIncluidosList, ingredientesList].forEach(container => {
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

