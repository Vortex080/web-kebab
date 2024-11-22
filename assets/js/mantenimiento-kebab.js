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
const btnguardar = document.getElementById('btn-save');
const id = document.getElementById('id');
const btnEliminar = document.getElementById('btn-delete');
const closeModal = document.getElementById('closeModalBtnPhoto');
let imagenEn64 = '';

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

    previewContainer.innerHTML = '';
    photoInput.value = ''; // Reinicia el valor del input de archivo
    photoInput.style.display = 'block'; // Muestra el input de archivo
    removePhotoButton.style.display = 'none'; // Oculta el botón de eliminar
    errorMessage.textContent = ''; // Limpia cualquier mensaje de error

    // Limpiar la lista de ingredientes incluidos (si se requiere)

    ingredientesIncluidosList.innerHTML = ''; // Borra los ingredientes incluidos
    ingredientesList.innerHTML = ''; // Borra Todos los ingredientes

    Allingredientes.forEach(ingrediente => {
        const ingredienteDiv = document.createElement('div');
        ingredienteDiv.className = "ingrediente";
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
        img.src = kebab.foto;
        // Añadir la imagen al div
        ingredienteDiv.appendChild(canvas);

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
    // Crear un elemento canvas
    const canvas = document.createElement('canvas');
    const ctx = canvas.getContext('2d');
    // Crear un objeto de imagen
    const foto = new Image();

    // Establecer la URL de la imagen usando la propiedad 'Ingrediente.foto'
    foto.onload = function () {
        // Dibujar la imagen en el canvas cuando la carga esté completa
        ctx.drawImage(foto, 0, 0, canvas.width, canvas.height);
    };

    // Establecer el src de la imagen (ruta de la foto)
    foto.src = ingrediente.foto;
    // Crear la imagen
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
    ingredienteDiv.dataset.precio = ingrediente.precio;

    // Añadir el div con todos los contenidos a la lista de ingredientes
    ingredientesList.appendChild(ingredienteDiv);
});


// Funciones de arrastrar y soltar
document.querySelectorAll('.ingrediente').forEach(item => {
    item.addEventListener('dragstart', function (e) {
        calcularPrecio(precioestimado);
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
            calcularPrecio(precioestimado);
            container.appendChild(draggedElement);
        }
    });
});

const photoInput = document.getElementById('foto');
const removePhotoButton = document.getElementById('remove-photo');
const previewContainer = document.getElementById('preview');
const errorMessage = document.getElementById('error-message');
const MAX_SIZE = 2 * 1024 * 1024; // 2 MB en bytesç
// Nodo donde estará el editor
const editor = document.querySelector('#editor');
// El canvas donde se mostrará la previa
const miCanvas = document.querySelector('#preview-final');
// Contexto del canvas
const contexto = miCanvas.getContext('2d');
// Ruta de la imagen seleccionada
let urlImage = null;
const RecortarModal = document.getElementById('imageModal');

photoInput.addEventListener('change', abrirEditor, false);

removePhotoButton.addEventListener('click', () => {
    // Limpia la vista previa, muestra el input de archivo y oculta el botón de eliminar
    previewContainer.innerHTML = '';
    photoInput.value = ''; // Reinicia el valor del input de archivo
    photoInput.style.display = 'block'; // Muestra el input de archivo
    removePhotoButton.style.display = 'none'; // Oculta el botón de eliminar
    errorMessage.textContent = ''; // Limpia cualquier mensaje de error
});

function calcularPrecio(precio) {
    let precioTotal = 0;
    const ingredientesIncluidosList = document.getElementById('ingredientes-incluidos-list');
    const selectedIngredients = [];
    ingredientesIncluidosList.querySelectorAll('.ingrediente').forEach(ingrediente => {
        selectedIngredients.push({
            name: ingrediente.dataset.name,
            precio: ingrediente.dataset.precio,
        });
    });
    console.log(selectedIngredients);
    selectedIngredients.forEach(ingrediente => {
        let precio = ingrediente.precio;
        precioTotal += parseInt(precio);
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
let photoid = '';
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
        id.value = kebab.id;
        // Limpia el mensaje de error
        errorMessage.textContent = '';

        photoid = kebab.foto;
        // Crear un elemento canvas
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');

        // Establecer las dimensiones del canvas
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

        // Agregar el canvas al contenedor
        previewContainer.appendChild(canvas);

        ingredientesList.querySelectorAll('.ingrediente').forEach(ingrediente => {
            kebab.ingredientes.forEach(element => {
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

btnguardar.addEventListener('click', function () {
    if (id.value.length > 0) {
        AllKebabs.forEach(kebab => {
            if (kebab.id == id.value) {
                let ingredientes = [];
                kebab.nombre = name.value;
                kebab.precio = precio.value;
                kebab.foto = imagenEn64;
                ingredientesIncluidosList.querySelectorAll('.ingrediente').forEach(ingrediente => {
                    Allingredientes.forEach(element => {
                        if (ingrediente.dataset.name[0] == element.id) {
                            ingredientes.push(element);
                        }
                    });
                });
                const photoInput = document.getElementById('foto');
                const responseDiv = document.getElementById('error-message');

                if (photoInput.files.length > 0) {
                    const file = photoInput.files[0];
                    const allowedExtensions = ['image/jpeg', 'image/png'];

                    // Validar tipo de archivo
                    if (!allowedExtensions.includes(file.type)) {
                        responseDiv.innerHTML = `<p style="color: red;">Solo se permiten archivos JPG o PNG.</p>`;
                        return;
                    }

                    // const formfoto = document.getElementById('form-foto');
                    // formfoto.action = '../../App/Helpers/upload.php?name=' + name.value;
                    // formfoto.submit();
                } else {
                    responseDiv.innerHTML = `<p>No has seleccionado ninguna foto.</p>`;
                }

                kebab.ingredientes = ingredientes;
                Kebab.updateKebab(kebab);
            }
        });
    } else {
        let ingredientes = [];
        ingredientesIncluidosList.querySelectorAll('.ingrediente').forEach(ingrediente => {
            Allingredientes.forEach(element => {
                if (ingrediente.dataset.name[0] == element.id) {
                    ingredientes.push(element);
                }
            });
        });
        Kebab.createKebab(name.value, imagenEn64, ingredientes, precio.value);
    }
});

btnEliminar.addEventListener('click', function () {
    if (id.value.length > 0) {
        Kebab.deleteKebab(id.value);

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

        previewContainer.innerHTML = '';
        photoInput.value = ''; // Reinicia el valor del input de archivo
        photoInput.style.display = 'block'; // Muestra el input de archivo
        removePhotoButton.style.display = 'none'; // Oculta el botón de eliminar
        errorMessage.textContent = ''; // Limpia cualquier mensaje de error

        // Limpiar la lista de ingredientes incluidos (si se requiere)

        ingredientesIncluidosList.innerHTML = ''; // Borra los ingredientes incluidos
        ingredientesList.innerHTML = ''; // Borra Todos los ingredientes

        Allingredientes.forEach(ingrediente => {
            const ingredienteDiv = document.createElement('div');
            ingredienteDiv.className = "ingrediente";

            // Establecer el src de la imagen (ruta de la foto)
            foto.src = ingrediente.foto;
            // Crear la imagen
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
    }
});

/**
   * Método que abre el editor con la imagen seleccionada
   */
function abrirEditor(e) {
    RecortarModal.style.display = 'flex ';
    // Obtiene la imagen
    urlImage = URL.createObjectURL(e.target.files[0]);

    // Borra editor en caso que existiera una imagen previa
    editor.innerHTML = '';
    let cropprImg = document.createElement('img');
    cropprImg.setAttribute('id', 'croppr');
    editor.appendChild(cropprImg);

    // Limpia la previa en caso que existiera algún elemento previo
    contexto.clearRect(0, 0, miCanvas.width, miCanvas.height);

    // Envia la imagen al editor para su recorte
    document.querySelector('#croppr').setAttribute('src', urlImage);

    // Crea el editor
    new Croppr('#croppr', {
        aspectRatio: 1,
        maxSize: [600, 600],
        minSize: [300, 300],
        startSize: [300, 300, 'px'], // Tamaño inicial del recorte
        onCropStart: () => false, // Evita que el usuario cambie el tamaño
        onCropEnd: recortarImagen
    })
}

/**
* Método que recorta la imagen con las coordenadas proporcionadas con croppr.js
*/
function recortarImagen(data) {
    // Variables
    const inicioX = data.x;
    const inicioY = data.y;
    const nuevoAncho = data.width;
    const nuevaAltura = data.height;
    const zoom = 1;

    // La imprimo
    miCanvas.width = nuevoAncho;
    miCanvas.height = nuevaAltura;
    // La declaro
    let miNuevaImagenTemp = new Image();
    // Cuando la imagen se carge se procederá al recorte
    miNuevaImagenTemp.onload = function () {
        // Se recorta
        contexto.drawImage(miNuevaImagenTemp, inicioX, inicioY, nuevoAncho * zoom, nuevaAltura * zoom, 0, 0, nuevoAncho, nuevaAltura);
        // Se transforma a base64
        imagenEn64 = miCanvas.toDataURL("image/jpeg");


        // Mostramos el código generado
        //document.querySelector('#base64').textContent = imagenEn64;
        //document.querySelector('#base64HTML').textContent = '<img src="' + imagenEn64.slice(0, 40) + '...">';

    }
    // Proporciona la imagen cruda, sin editarla por ahora
    miNuevaImagenTemp.src = urlImage;
}


closeModal.addEventListener('click', () => {
    RecortarModal.style.display = 'none';


});