import * as Ingredientes from './Api/IngredienteApi.js';

// Obtener el botón de limpiar
const btnClear = document.querySelector('.btn-clear');
const ingredientes = document.getElementById('ingredientes');
const ingredientesIncluidosList = document.getElementById('ingredientes-incluidos-list');
const Allingredientes = await Ingredientes.getAll();
const ingredientesList = document.getElementById('todos-ingredientes-list');
const todosIngredientesList = document.getElementById('todos-ingredientes-list');
const precioestimado = document.getElementById('precio-estimado');
const name = document.getElementById('name');
const precio = document.getElementById('precio');

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

        // Crear la imagen
        const foto = document.createElement('img');
        foto.src = '../../assets/img/ingrediente/' + ingrediente.foto;
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
        ingredienteDiv.dataset.name = ingrediente.id; // Identificador único

        ingredientesList.appendChild(ingredienteDiv);
    });

    precio.innerHTML = ''; // Borra el precio
    name.innerHTML = '';

    // NOTA: La sección de "Todos los Ingredientes" se mantendrá intacta
});

Allingredientes.forEach(ingrediente => {
    const ingredienteDiv = document.createElement('div');
    ingredienteDiv.className = "ingrediente";

    // Crear la imagen
    const foto = document.createElement('img');
    foto.src = '../../assets/img/ingrediente/' + ingrediente.foto;
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
    ingredienteDiv.dataset.name = ingrediente.id; // Identificador único

    // Añadir el div con todo el contenido a la lista de ingredientes
    ingredientesList.appendChild(ingredienteDiv);
});


// Funciones de arrastrar y soltar
document.querySelectorAll('.ingrediente').forEach(item => {
    item.addEventListener('dragstart', function (e) {
        e.dataTransfer.setData('text/plain', e.target.dataset.name);
        calcularPrecio(precioestimado);
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
            calcularPrecio(precioestimado);
            container.appendChild(draggedElement);
        }
    });
});

const photoInput = document.getElementById('foto');
const removePhotoButton = document.getElementById('remove-photo');
const previewContainer = document.getElementById('preview');
const errorMessage = document.getElementById('error-message');
const MAX_SIZE = 2 * 1024 * 1024; // 2 MB en bytes

photoInput.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
        if (file.size > MAX_SIZE) {
            // Muestra un mensaje de error si el archivo supera el tamaño máximo
            errorMessage.textContent = 'El archivo es demasiado grande. Elija una imagen de menos de 2 MB.';
            photoInput.value = ''; // Reinicia el input de archivo
        } else {
            // Limpia el mensaje de error
            errorMessage.textContent = '';

            const reader = new FileReader();
            reader.onload = function (e) {
                previewContainer.innerHTML = `<img src="${e.target.result}" alt="Vista previa de la foto">`;
            }
            reader.readAsDataURL(file);

            // Oculta el input de archivo y muestra el botón de eliminar
            photoInput.style.display = 'none';
            removePhotoButton.style.display = 'block';
        }
    }
});

removePhotoButton.addEventListener('click', () => {
    // Limpia la vista previa, muestra el input de archivo y oculta el botón de eliminar
    previewContainer.innerHTML = '';
    photoInput.value = ''; // Reinicia el valor del input de archivo
    photoInput.style.display = 'block'; // Muestra el input de archivo
    removePhotoButton.style.display = 'none'; // Oculta el botón de eliminar
    errorMessage.textContent = ''; // Limpia cualquier mensaje de error
});

function calcularPrecio(precio) {
    const ingredientesIncluidosList = document.getElementById('ingredientes-incluidos-list');
    const selectedIngredients = [];
    ingredientesIncluidosList.querySelectorAll('.ingrediente').forEach(ingrediente => {
        selectedIngredients.push({
            name: ingrediente.dataset.name,
            id: ingrediente.id
        });
    });
    let precioTotal = 0;
    selectedIngredients.forEach(ingrediente => {
        let precio = ingrediente.name.split(',');
        precioTotal += parseInt(precio[2]);
    });
    precio.value = precioTotal;
}

// MODAL
// Referencias a elementos
import * as Kebab from './Api/KebabApi.js';
const modal = document.getElementById('modal');
const openModalBtn = document.getElementById('openModalBtn');
const closeModalBtn = document.getElementById('closeModalBtn');
const listContainer = document.getElementById('listContainer');
const AllKebabs = await Kebab.getAll();

// Mostrar el modal
openModalBtn.addEventListener('click', () => {
    modal.style.display = 'flex';
});

// Ocultar el modal
closeModalBtn.addEventListener('click', () => {
    modal.style.display = 'none';
});

// Agregar elementos dinámicos a la list

AllKebabs.forEach(kebab => {
    const listItem = document.createElement('div');
    listItem.className = 'list-item';

    const itemName = document.createElement('span');
    itemName.textContent = kebab.nombre;

    const chooseButton = document.createElement('button');
    chooseButton.textContent = 'Elegir';
    chooseButton.addEventListener('click', () => {
        name.value = kebab.nombre;
        precio.value = kebab.precio;

        // Limpia el mensaje de error
        errorMessage.textContent = '';
        previewContainer.innerHTML = `<img src="../../assets/img/${kebab.foto}" alt="Vista previa de la foto">`;

        ingredientesList.querySelectorAll('.ingrediente').forEach(ingrediente => {
            console.log(ingrediente.dataset.name[0]);
            kebab.ingredientes.forEach(element => {
                console.log(element.id);
                if (ingrediente.dataset.name[0] == element.id) {
                    ingredientesList.removeChild(ingrediente);
                    ingredientesIncluidosList.appendChild(ingrediente);
                }
            });
        });

        // Oculta el input de archivo y muestra el botón de eliminar
        photoInput.style.display = 'none';
        removePhotoButton.style.display = 'block';
        modal.style.display = 'none';
    });

    listItem.appendChild(itemName);
    listItem.appendChild(chooseButton);
    listContainer.appendChild(listItem);
});