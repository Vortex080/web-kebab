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