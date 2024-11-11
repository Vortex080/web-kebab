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
// Testing Api

import * as Ingrediente from "./Api/IngredienteApi.js";
import * as Alergeno from "./Api/AlergenosApi.js";
import * as Direction from "./Api/DirectionApi.js";
import * as Kebab from "./Api/KebabApi.js";
import * as User from "./Api/UserApi.js";
import * as Pedido from "./Api/PedidoApi.js";

// Test alergenos

// Create
//Alergeno.createAlergeno('Arroz', 'foto.jpg');

// Get
let aleg1 = await Alergeno.getAlergeno(1);
let aleg2 = await Alergeno.getAlergeno(2);
console.log(aleg1);
console.log(aleg2);

// Update
//Alergeno.updateAlergeno(1, 'Pisto', 'foto.jpg');

// Delete
//Alergeno.deleteAlergeno(37);

// Ingredientes

// Create
//Ingrediente.createIngrediente('lechuga', 10, [aleg1, aleg2]);

// Get
//let ing1 = await Ingrediente.getIngrediente(120);
//console.log(ing1);

// Update

//Ingrediente.updateIngrediente(120, 'panpita', 400);

// Delete

//Ingrediente.deleteIngrediente(120);

// Direction

// Create
// Direction.createDirection('Este es una direccion', 1);

// Get
let dir1 = await Direction.getDirection(4);
console.log(dir1);

// Update
//Direction.updateDirection(6, 'asdasdasd', 1);

// Delete
//Direction.deleteDirection(6);


// Kebab

// Create
//let ing1 = await Ingrediente.getIngrediente(3);
//let ing2 = await Ingrediente.getIngrediente(27);
//console.log(ing1);
//console.log(ing2);
//Kebab.createKebab('clasico', 'foto.jpg', [ing1, ing2], 10);

// Get
let keb1 = await Kebab.getKebab(16);
console.log(keb1);


// Update
//Kebab.updateKebab(15, 'solocarne', 'foto.jpg', [ing1, ing2], 10);

// Delete
//Kebab.deleteKebab(15);

// User

// Create

//let user = await User.createUser('anton', '12345', 5000, 'foto.png', dir1, [aleg1, aleg2], null);

// Get
let user1 = await User.getUser(30);   
console.log(user1);

// Update
//User.updateUser(28, 'Miguel', '12345', 5000, 'foto.png', dir1, [aleg1, aleg2], null);

// Delete
//User.deleteUser(28);


// Pedido

// Create

//let linea1 = Pedido.createLineaPedido(1, keb1, 20, null, null);
//console.log('linea')
//console.log(linea1);

//let pedido = await Pedido.createPedido('2020-10-10', 'En preparacion', 10, dir1, user1, lineas);
//let json = JSON.stringify({ fecha: '2020-10-10', estado: 'En preparación', precio: 10, direccion: dir1, user: user1, lineas: lineas });
//console.log(json);

// Get
let pedido1 = await Pedido.getPedido(16);
let linea1 = pedido1.lineas[0];
console.log(linea1);
let lineas = [linea1];

// Update
//Pedido.updatePedido('10', 'finalizado', 10, dir1, user1, lineas, 16);

// Delete
Pedido.deletePedido(16);

