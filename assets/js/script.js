/* Conexion con el servidor
window.addEventListener('load', function () {
    let form = document.forms[0];

    form.elements['enviar'].addEventListener('click', function () {
        let datos = new FormData(form);
        datos.append('kebab', 'kebab de la casa');
        datos.append('ingredientes', '12,234,2345,14');

        let solicitud = new Request('info.php', {
            method: 'POST',
            body: datos
        })

        fetch(solicitud)
            .then(respuesta => respuesta
                .text()).then(text => { document.getElementById('contenedor').innerHTML = text });

    });
});
*/
// Alergenos
let baseUrlAleg = '/App/Api/AlergenoApi.php';
// Función para hacer la solicitud a la API en PHP
async function createAlergeno(nombre, foto) {

    try {
        // Hacemos la solicitud GET usando fetch
        const response = await fetch(baseUrlAleg, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ nombre: nombre, foto: foto })
        });
        const data = await response.json();
        console.log(data);
    } catch (error) {
        console.log('Error al crear el alergeno ', error);
    }
}
// Función para hacer la solicitud a la API en PHP
async function getAlergeno(id) {

    try {
        // Hacemos la solicitud GET usando fetch
        const response = await fetch(baseUrlAleg + '?id=' + id, {
            method: 'GET',
        });
        const data = await response.json();
        console.log(data);
    } catch (error) {
        console.log('Error al buscar el alergeno ', error);
    }
}

// Función para hacer la solicitud a la API en PHP
async function updateAlergeno(id, nombre, foto) {
    try {
        // Hacemos la solicitud PUT usando fetch
        const response = await fetch(`${baseUrlAleg}?id=${id}`, {
            method: 'PUT', // Usamos PUT para actualizar el recurso
            headers: {
                'Content-Type': 'application/json' // Indicamos que estamos enviando JSON
            },
            body: JSON.stringify({ nombre: nombre, foto: foto }) // Datos a actualizar
        });

        // Verificamos si la respuesta es exitosa
        if (!response.ok) {
            throw new Error(`Error en la respuesta: ${response.statusText}`);
        }

        // Procesamos la respuesta del servidor
        const data = await response.json();
        console.log('Alergeno actualizado:', data);
    } catch (error) {
        console.log('Error al actualizar el alergeno:', error);
    }
}

// Función para hacer la solicitud a la API en PHP
async function deleteAlergeno(id) {
    try {
        // Hacemos la solicitud DELETE usando fetch
        const response = await fetch(`${baseUrlAleg}?id=${id}`, {
            method: 'DELETE' // Usamos DELETE para eliminar el recurso
        });

        // Verificamos si la respuesta es exitosa
        if (!response.ok) {
            throw new Error(`Error en la respuesta: ${response.statusText}`);
        }

        // Procesamos la respuesta del servidor
        const data = await response.json();
        console.log('Alergeno eliminado:', data);
    } catch (error) {
        console.log('Error al eliminar el alergeno:', error);
    }
}


// Ingredientes
let baseUrlIngr = '/App/Api/IngredienteApi.php';
// Función para hacer la solicitud a la API en PHP
async function createIngrediente(nombre, alergeno, precio) {

    try {
        // Hacemos la solicitud GET usando fetch
        const response = await fetch(baseUrlIngr, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ nombre: nombre, alergeno: alergeno, precio: precio })
        });
        const data = await response.json();
        console.log(data);
    } catch (error) {
        console.log('Error al crear el ingrediente ', error);
    }
}
// Función para hacer la solicitud a la API en PHP
async function getIngrediente(id) {

    try {
        // Hacemos la solicitud GET usando fetch
        const response = await fetch(baseUrlIngr + '?id=' + id, {
            method: 'GET',
        });
        const data = await response.json();
        console.log(data);
    } catch (error) {
        console.log('Error al buscar el ingrediente ', error);
    }
}
// Función para hacer la solicitud a la API en PHP
async function updateIngrediente(id, nombre, alergeno, precio) {
    try {
        // Hacemos la solicitud PUT usando fetch
        const response = await fetch(`${baseUrlIngr}?id=${id}`, {
            method: 'PUT', // Usamos PUT para actualizar el recurso
            headers: {
                'Content-Type': 'application/json' // Indicamos que estamos enviando JSON
            },
            body: JSON.stringify({ nombre: nombre, alergenos: alergeno, precio: precio }) // Datos a actualizar
        });

        // Verificamos si la respuesta es exitosa
        if (!response.ok) {
            throw new Error(`Error en la respuesta: ${response.statusText}`);
        }

        // Procesamos la respuesta del servidor
        const data = await response.json();
        console.log('Ingrediente actualizado:', data);
    } catch (error) {
        console.log('Error al actualizar el ingrediente:', error);
    }
}

// Función para hacer la solicitud a la API en PHP
async function deleteIngrediente(id) {
    try {
        // Hacemos la solicitud DELETE usando fetch
        const response = await fetch(`${baseUrlIngr}?id=${id}`, {
            method: 'DELETE' // Usamos DELETE para eliminar el recurso
        });

        // Verificamos si la respuesta es exitosa
        if (!response.ok) {
            throw new Error(`Error en la respuesta: ${response.statusText}`);
        }

        // Procesamos la respuesta del servidor
        const data = await response.json();
        console.log('Ingrediente eliminado:', data);
    } catch (error) {
        console.log('Error al eliminar el ingrediente:', error);
    }
}


//createIngrediente('carne', 1, 130);