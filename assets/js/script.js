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

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

// Ingredientes
let baseUrlIngr = '/App/Api/IngredienteApi.php';
// Función para hacer la solicitud a la API en PHP
async function createIngrediente(nombre, precio) {

    try {
        // Asegurarnos de que los parámetros no sean undefined o null
        if (!nombre || !precio) {
            throw new Error('Los valores de nombre y precio son requeridos');
        }

        // Hacemos la solicitud GET usando fetch
        const response = await fetch(baseUrlIngr, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ nombre: nombre, precio: precio })
        });

        // Verificamos si la respuesta fue exitosa
        if (!response.ok) {
            const errorMessage = await response.text(); // Obtener texto de la respuesta si hay error
            throw new Error(`Error ${response.status}: ${errorMessage}`);
        }

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
async function updateIngrediente(id, nombre, precio) {
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


//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


// Dirección
let baseUrlDir = '/App/Api/DirectionApi.php';
// Función para hacer la solicitud a la API en PHP
async function createDirection(direction, status) {

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

        const data = await response.json();
        console.log(data);
    } catch (error) {
        console.log('Error al crear la direction ', error);
    }
}

// Función para hacer la solicitud a la API en PHP
async function getDirection(id) {

    try {
        // Hacemos la solicitud GET usando fetch
        const response = await fetch(baseUrlDir + '?id=' + id, {
            method: 'GET',
        });
        const data = await response.json();
        console.log(data);
    } catch (error) {
        console.log('Error al buscar la direction ', error);
    }
}
// Función para hacer la solicitud a la API en PHP
async function updateDirection(id, direcction, status) {
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
async function deleteDirection(id) {
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


//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------



// User
let baseUrlUser = '/App/Api/UserApi.php';
// Función para hacer la solicitud a la API en PHP
async function createUser(nombre, pass, direcction, monedero, foto) {

    try {
        // Asegurarnos de que los parámetros no sean undefined o null
        if (!nombre || !pass || !direcction || !monedero || !foto) {
            throw new Error('Los valores de nombre y precio son requeridos');
        }

        // Hacemos la solicitud GET usando fetch
        const response = await fetch(baseUrlUser, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ nombre: nombre, pass: pass, direcction: direcction, monedero: monedero, foto: foto })
        }); 
        // Verificamos si la respuesta fue exitosa
        if (!response.ok) {
            const errorMessage = await response.text(); // Obtener texto de la respuesta si hay error
            throw new Error(`Error ${response.status}: ${errorMessage}`);
        }

        const data = await response.json();
        console.log(data);
    } catch (error) {
        console.log('Error al crear el user ', error);
    }
}

//deleteUser(17);
// Función para hacer la solicitud a la API en PHP
async function getUser(id) {

    try {
        // Hacemos la solicitud GET usando fetch
        const response = await fetch(baseUrlUser + '?id=' + id, {
            method: 'GET',
        });
        const data = await response.json();
        console.log(data);
    } catch (error) {
        console.log('Error al buscar el user ', error);
    }
}
// Función para hacer la solicitud a la API en PHP
async function updateUser(id, nombre, pass, direcction, monedero, foto) {
    try {
        // Hacemos la solicitud PUT usando fetch
        const response = await fetch(`${baseUrlUser}?id=${id}&nombre=${nombre}&pass=${pass}&direcction=${direcction}&monedero=${monedero}&foto=${foto}`, {
            method: 'PUT', // Usamos PUT para actualizar el recurso
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
async function deleteUser(id) {
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

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

// Pedidos
let baseUrlPedido = '/App/Api/PedidosApi.php';
// Función para hacer la solicitud a la API en PHP
async function createPedido(fecha, estado, precio, direcction, user, lineas) {

    try {
        // Asegurarnos de que los parámetros no sean undefined o null
        if (!fecha || !estado || !precio || !direcction || !user || !lineas) {
            throw new Error('Los valores de fecha, estado, precio, direccion, user y lineas son requeridos');
        }

        // Hacemos la solicitud GET usando fetch
        const response = await fetch(baseUrlPedido, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ fecha: fecha, estado: estado, precio: precio, direcction: direcction, user: user, lineas: lineas })
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
//TODO
//createPedido('2021-01-01', 'pendiente', 10, 4, 1, [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
// Función para hacer la solicitud a la API en PHP
async function getPedido(id) {

    try {
        // Hacemos la solicitud GET usando fetch
        const response = await fetch(baseUrlPedido + '?id=' + id, {
            method: 'GET',
        });
        const data = await response.json();
        console.log(data);
    } catch (error) {
        console.log('Error al buscar el pedido ', error);
    }
}
// Función para hacer la solicitud a la API en PHP
async function updatePedido(id, fecha, estado, precio, direcction, user, lineas) {
    try {
        // Hacemos la solicitud PUT usando fetch
        const response = await fetch(`${baseUrlPedido}?id=${id}&fecha=${fecha}&estado=${estado}&precio=${precio}&direcction=${direcction}&user=${user}&lineas=${lineas}`, {
            method: 'PUT', // Usamos PUT para actualizar el recurso
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
async function deletePedido(id) {
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


//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


// Kebab
let baseUrlKebab = '/App/Api/KebabApi.php';
// Función para hacer la solicitud a la API en PHP
async function createKebab(nombre, foto, ingredientes, precio) {

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

createKebab('kebab', 'foto.jpg', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10], 10);
// Función para hacer la solicitud a la API en PHP
async function getKebab(id) {

    try {
        // Hacemos la solicitud GET usando fetch
        const response = await fetch(baseUrlKebab + '?id=' + id, {
            method: 'GET',
        });
        const data = await response.json();
        console.log(data);
    } catch (error) {
        console.log('Error al buscar el kebab ', error);
    }
}
// Función para hacer la solicitud a la API en PHP
async function updateKebab(id, nombre, foto, ingredientes, precio) {
    try {
        // Hacemos la solicitud PUT usando fetch
        const response = await fetch(`${baseUrlKebab}?id=${id}&nombre=${nombre}&foto=${foto}&ingredientes=${ingredientes}&precio=${precio}`, {
            method: 'PUT', // Usamos PUT para actualizar el recurso
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
async function deleteKebab(id) {
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
        const data = await response.json();
        console.log('Kebab eliminado:', data);
    } catch (error) {
        console.log('Error al eliminar el kebab:', error);
    }
}

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------