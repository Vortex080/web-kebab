// Kebab
let baseUrlKebab = '/App/Api/KebabApi.php';
// Función para hacer la solicitud a la API en PHP
export async function createKebab(nombre, foto, ingredientes, precio) {

    try {
        // Asegurarnos de que los parámetros no sean undefined o null
        if (!nombre || !foto || !ingredientes || !precio) {
            throw new Error('Los valores de nombre, foto, ingredientes y precio son requeridos');
        }

        // Hacemos la solicitud GET usando fetch
        const response = await fetch(baseUrlKebab, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ nombre: nombre, foto: foto, ingredientes: ingredientes, precio: precio })
        });

        // Verificamos si la respuesta fue exitosa
        if (!response.ok) {
            const errorMessage = await response.text(); // Obtener texto de la respuesta si hay error
            throw new Error(`Error ${response.status}: ${errorMessage}`);
        }

        const data = await response.json();
        console.log(data);
    } catch (error) {
        console.log('Error al crear el kebab ', error);
    }
}

export async function getAll() {

    let response = await fetch(baseUrlKebab + '?id=All');
    return response.json();
}
// Función para hacer la solicitud a la API en PHP
export async function getKebab(id) {

    let response = await fetch(baseUrlKebab + '?id=' + id);
    return response.json();
}
// Función para hacer la solicitud a la API en PHP
export async function updateKebab(kebab) {
    try {
        // Hacemos la solicitud PUT usando fetch
        const response = await fetch(`${baseUrlKebab}?id=${kebab.id}`, {
            method: 'PUT', // Usamos PUT para actualizar el recursoç
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ nombre: kebab.nombre, foto: kebab.foto, ingredientes: kebab.ingredientes, precio: kebab.precio })
        });

        // Verificamos si la respuesta es exitosa
        if (!response.ok) {
            throw new Error(`Error en la respuesta: ${response.statusText}`);
        }

        // Procesamos la respuesta del servidor
        const data = await response.json();
        console.log('Kebab actualizado:', data);
    } catch (error) {
        console.log('Error al actualizar el kebab:', error);
    }
}

// Función para hacer la solicitud a la API en PHP
export async function deleteKebab(id) {
    try {
        // Hacemos la solicitud DELETE usando fetch
        const response = await fetch(`${baseUrlKebab}?id=${id}`, {
            method: 'DELETE' // Usamos DELETE para eliminar el recurso
        });

        // Verificamos si la respuesta es exitosa
        if (!response.ok) {
            throw new Error(`Error en la respuesta: ${response.statusText}`);
        }

        // Procesamos la respuesta del servidor
        const data = await response.text();
        console.log('Kebab eliminado:', data);
    } catch (error) {
        console.log('Error al eliminar el kebab:', error);
    }
}