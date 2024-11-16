// Ingredientes
let baseUrlIngr = '/App/Api/IngredienteApi.php';
// Función para hacer la solicitud a la API en PHP
export async function createIngrediente(nombre, precio, alergenos) {

    try {
        // Asegurarnos de que los parámetros no sean undefined o null
        if (!nombre || !precio) {
            throw new Error('Los valores de nombre y precio son requeridos');
        }

        // Hacemos la solicitud GET usando fetch
        const request = await fetch(baseUrlIngr, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ nombre: nombre, precio: precio, alergenos: alergenos })
        });
        // Verificamos si la respuesta fue exitosa
        if (!request.ok) {
            const errorMessage = await request.json(); // Obtener texto de la respuesta si hay error
            throw new Error(`Error ${request.status}: ${errorMessage}`);
        }

        const data = await request.text();
        console.log(data);
    } catch (error) {
        console.log('Error al crear el ingrediente ', error);
    }
}

// Función para hacer la solicitud a la API en PHP
export async function getIngrediente(id) {

    let response = await fetch(baseUrlIngr + '?id=' + id);
    return response.json();
}

export async function getAll() {

    let response = await fetch(baseUrlIngr + '?id=All');
    return response.json();
}


// Función para hacer la solicitud a la API en PHP
export async function updateIngrediente(id, nombre, precio) {
    try {
        // Hacemos la solicitud PUT usando fetch
        const response = await fetch(`${baseUrlIngr}?id=${id}&nombre=${nombre}&precio=${precio}`, {
            method: 'PUT', // Usamos PUT para actualizar el recurso
        });

        // Verificamos si la respuesta es exitosa
        if (!response.ok) {
            throw new Error(`Error en la respuesta: ${response.statusText}`);
        }

        // Procesamos la respuesta del servidor
        const data = await response.text();
        console.log('Ingrediente actualizado:', data);
    } catch (error) {
        console.log('Error al actualizar el ingrediente:', error);
    }
}

// Función para hacer la solicitud a la API en PHP
export async function deleteIngrediente(id) {
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
