// User
let baseUrlUser = '/App/Api/UserApi.php';
// Función para hacer la solicitud a la API en PHP
export async function createUser(nombre, pass, monedero, foto, direcction, alergenos, email, rol) {

    try {
        // Asegurarnos de que los parámetros no sean undefined o null
        if (!nombre || !pass || !direcction || !monedero || !foto || !email || !rol) {
            throw new Error('Los valores de nombre y precio son requeridos');
        }

        // Hacemos la solicitud GET usando fetch
        const request = await fetch(baseUrlUser, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ nombre: nombre, pass: pass, monedero: monedero, foto: foto, direcction: direcction, alergenos: alergenos, email: email, rol: rol })
        });
        // Verificamos si la respuesta fue exitosa
        if (!request.ok) {
            const errorMessage = await request.json(); // Obtener texto de la respuesta si hay error
            throw new Error(`Error ${request.status}: ${errorMessage}`);
        }
        const data = await request.json();
        console.log(data);
    } catch (error) {
        console.log('Error al crear el user ', error);
    }
}


export async function getAll() {
    let response = await fetch(baseUrlUser+'?id=All');
    return response.json();
}

// Función para hacer la solicitud a la API en PHP
export async function getUser(id) {

    let response = await fetch(baseUrlUser + '?id=' + id);
    return response.json();
}
// Función para hacer la solicitud a la API en PHP
export async function updateUser(id, nombre, pass, monedero, foto, direcction, alergenos, email, rol) {
    try {
        // Hacemos la solicitud PUT usando fetch
        const response = await fetch(`${baseUrlUser}?id=${id}`, {
            method: 'PUT', // Usamos PUT para actualizar el recursoç
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ nombre: nombre, pass: pass, monedero: monedero, foto: foto, direcction: direcction, alergenos: alergenos, email: email, rol: rol })
        });

        // Verificamos si la respuesta es exitosa
        if (!response.ok) {
            throw new Error(`Error en la respuesta: ${response.statusText}`);
        }

        // Procesamos la respuesta del servidor
        const data = await response.json();
        console.log('User actualizado:', data);
    } catch (error) {
        console.log('Error al actualizar el user:', error);
    }
}

// Función para hacer la solicitud a la API en PHP
export async function deleteUser(id) {
    try {
        // Hacemos la solicitud DELETE usando fetch
        const response = await fetch(`${baseUrlUser}?id=${id}`, {
            method: 'DELETE' // Usamos DELETE para eliminar el recurso
        });

        // Verificamos si la respuesta es exitosa
        if (!response.ok) {
            throw new Error(`Error en la respuesta: ${response.statusText}`);
        }

        // Procesamos la respuesta del servidor
        const data = await response.json();
        console.log('User eliminado:', data);
    } catch (error) {
        console.log('Error al eliminar el user:', error);
    }
}