// Dirección
let baseUrlDir = '/App/Api/DirectionApi.php';
// Función para hacer la solicitud a la API en PHP
export async function createDirection(direction, status) {

    try {
        // Asegurarnos de que los parámetros no sean undefined o null
        if (!direction || !status) {
            throw new Error('Los valores de direccion y estado son requeridos');
        }

        // Hacemos la solicitud GET usando fetch
        const response = await fetch(baseUrlDir, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ direction: direction, status: status })
        });

        // Verificamos si la respuesta fue exitosa
        if (!response.ok) {
            const errorMessage = await response.text(); // Obtener texto de la respuesta si hay error
            throw new Error(`Error ${response.status}: ${errorMessage}`);
        }

        const data = await response.text();
        console.log(data);
    } catch (error) {
        console.log('Error al crear la direction ', error);
    }
}

// Función para hacer la solicitud a la API en PHP
export async function getDirection(id) {
    let response = await fetch(baseUrlDir + '?id=' + id);
    return response.json();
}
// Función para hacer la solicitud a la API en PHP
export async function updateDirection(id, direcction, status) {
    try {
        // Hacemos la solicitud PUT usando fetch
        const response = await fetch(`${baseUrlDir}?id=${id}&direction=${direcction}&status=${status}`, {
            method: 'PUT', // Usamos PUT para actualizar el recurso
        });

        // Verificamos si la respuesta es exitosa
        if (!response.ok) {
            throw new Error(`Error en la respuesta: ${response.statusText}`);
        }

        // Procesamos la respuesta del servidor
        const data = await response.json();
        console.log('Direction actualizado:', data);
    } catch (error) {
        console.log('Error al actualizar la direction:', error);
    }
}

// Función para hacer la solicitud a la API en PHP
export async function deleteDirection(id) {
    try {
        // Hacemos la solicitud DELETE usando fetch
        const response = await fetch(`${baseUrlDir}?id=${id}`, {
            method: 'DELETE' // Usamos DELETE para eliminar el recurso
        });

        // Verificamos si la respuesta es exitosa
        if (!response.ok) {
            throw new Error(`Error en la respuesta: ${response.statusText}`);
        }

        // Procesamos la respuesta del servidor
        const data = await response.json();
        console.log('Direction eliminado:', data);
    } catch (error) {
        console.log('Error al eliminar la direction:', error);
    }
}