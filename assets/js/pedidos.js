import * as Pedido from './Api/PedidoApi.js';

const userid = document.getElementById('user').value;

const pedidos = await Pedido.getPedidobyUser(userid);
const divPedidos = document.getElementById('pedidos');
let lineajson = {};



pedidos.forEach(pedido => {
    const div = document.createElement('div');
    div.className = 'pedido';
    div.innerHTML = `<h3>Pedido #${pedido.id} | ${pedido.fecha}</h3>`;
    const p = document.createElement('p');
    p.innerHTML = `<strong>Estado:</strong> <span class="estado" id="estado">${pedido.estado}</span>`;
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

    const cancelarbtn = document.createElement('button');
    cancelarbtn.className = 'btn-cancelar';
    cancelarbtn.innerHTML = 'Cancelar';
    if (pedido.estado == 'En preparación') {
        cancelarbtn.style.display = 'inline-block';
        div.appendChild(cancelarbtn);
    }


    divPedidos.appendChild(div);

    cancelarbtn.addEventListener('click', function () {
        pedido.estado = 'Cancelado';
        Pedido.updatePedido(pedido);
        let estado = document.getElementById('estado');
        estado.innerHTML = 'Cancelado';
    });

});


