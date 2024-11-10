let baseUrlAleg = '/App/Api/AlergenoApi.php';
// Función para hacer la solicitud a la API en PHP
export async function createAlergeno(nombre, foto) {

    try {
        // Hacemos la solicitud GET usando fetch
        const response = await fetch(baseUrlAleg, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ nombre: nombre, foto: foto })
        });
        const data = await response.text();
        console.log(data);
    } catch (error) {
        console.log('Error al crear el alergeno ', error);
    }
}
// Función para hacer la solicitud a la API en PHP
export async function getAlergeno(id) {

let response = await fetch(baseUrlAleg + '?id=' + id);
return response.json();
}


// Función para hacer la solicitud a la API en PHP
export async function updateAlergeno(id, nombre, foto) {
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
        const data = await response.text();
        console.log('Alergeno actualizado:', data);
    } catch (error) {
        console.log('Error al actualizar el alergeno:', error);
    }
}

// Función para hacer la solicitud a la API en PHP
export async function deleteAlergeno(id) {
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