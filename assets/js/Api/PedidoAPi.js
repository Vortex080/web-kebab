// Pedidos
let baseUrlPedido = '/App/Api/PedidosApi.php';
// Función para hacer la solicitud a la API en PHP
export async function createPedido(fecha, estado, precio, direcction, user, lineas) {

    try {
        // Asegurarnos de que los parámetros no sean undefined o null
        if (!fecha || !estado || !precio || !direcction || !user) {
            throw new Error('Los valores de fecha, estado, precio, direccion, user son requeridos');
        }

        // Hacemos la solicitud GET usando fetch
        const response = await fetch(baseUrlPedido, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ fecha: fecha, estado: estado, precio: precio, direccion: direcction, user: user, lineas: lineas })
        });

        // Verificamos si la respuesta fue exitosa
        if (!response.ok) {
            const errorMessage = await response.text(); // Obtener texto de la respuesta si hay error
            throw new Error(`Error ${response.status}: ${errorMessage}`);
        }

        const data = await response.json();
        console.log(data);
    } catch (error) {
        console.log('Error al crear el pedido ', error);
    }
}

// Función para hacer la solicitud a la API en PHP
export async function getPedido(id) {

    let response = await fetch(baseUrlPedido + '?id=' + id);
    return response.json();
}

export async function getPedidobyUser(id) {

    let response = await fetch(baseUrlPedido + '?iduser=' + id);
    return response.json();
}
// Función para hacer la solicitud a la API en PHP
export async function updatePedido(pedido) {
    try {
        // Hacemos la solicitud PUT usando fetch
        const response = await fetch(`${baseUrlPedido}?id=${pedido.id}`, {
            method: 'PUT', // Usamos PUT para actualizar el recurso
            headers: {
                'Content-Type': 'application/json' // Indicamos que estamos enviando JSON
            },
            body: JSON.stringify({ fecha: pedido.fecha, estado: pedido.estado, precio: pedido.precio, direccion: pedido.direcction, user: pedido.user, lineas: pedido.lineas })
        });
        // Verificamos si la respuesta es exitosa
        if (!response.ok) {
            throw new Error(`Error en la respuesta: ${response.statusText}`);
        }

        // Procesamos la respuesta del servidor
        const data = await response.json();
        console.log('Pedido actualizado:', data);
    } catch (error) {
        console.log('Error al actualizar el pedido:', error);
    }
}

// Función para hacer la solicitud a la API en PHP
export async function deletePedido(id) {
    try {
        // Hacemos la solicitud DELETE usando fetch
        const response = await fetch(`${baseUrlPedido}?id=${id}`, {
            method: 'DELETE' // Usamos DELETE para eliminar el recurso
        });

        // Verificamos si la respuesta es exitosa
        if (!response.ok) {
            throw new Error(`Error en la respuesta: ${response.statusText}`);
        }

        // Procesamos la respuesta del servidor
        const data = await response.json();
        console.log('Pedido eliminado:', data);
    } catch (error) {
        console.log('Error al eliminar el pedido:', error);
    }
}


export function createLineaPedido(cantidad, producto, precio, pedidoid) {
    return { cantidad: cantidad, producto: producto, precio: precio, pedidoid: pedidoid };

}