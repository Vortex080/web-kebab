import * as Pedido from './Api/PedidoApi.js';
import * as User from './Api/UserApi.js';

const pedidos = await Pedido.getPedidoAll();
const divPedidos = document.getElementById('pedidos');
let lineajson = {};


console.log(pedidos);

pedidos.forEach(pedido => {
    const div = document.createElement('div');
    div.className = 'pedido';
    div.innerHTML = `<h3>Pedido #${pedido.id} | ${pedido.fecha}</h3>`;
    const p2 = document.createElement('p');
    p2.innerHTML = `<strong>Usuario:</strong> <span class="estado">${pedido.user}</span>`;
    const p = document.createElement('p');
    p.innerHTML = `<strong>Estado:</strong> <span class="estado" id="estado">${pedido.estado}</span>`;
    const p3 = document.createElement('p');
    p3.innerHTML = `<strong>Dirección:</strong> <span class="estado">${pedido.direcction}</span>`;
    div.appendChild(p3);
    div.appendChild(p2);
    div.appendChild(p);
    pedido.lineas.forEach(linea => {
        lineajson = JSON.parse(linea.producto);
        const li = document.createElement('li');
        li.className = 'producto';
        lineajson.ingredientes.forEach(ingrediente => {
            li.innerHTML = `${lineajson.nombre} - ${linea.cantidad}`;
        });
        div.appendChild(li);
    });

    const select = document.createElement('select');
    select.className = 'select';
    select.options.add(new Option('En preparación', 'En preparación'));
    select.options.add(new Option('Enviado', 'Enviado'));
    select.options.add(new Option('Completado', 'Completado'));
    select.options.add(new Option('Cancelado', 'Cancelado'));

    div.appendChild(select);

    divPedidos.appendChild(div);

    select.addEventListener('change', function () {
        pedido.estado = select.value;
        console.log(pedido);
        Pedido.updatePedido(pedido);
    });

});