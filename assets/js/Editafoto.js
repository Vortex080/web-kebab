/**
   * Método que abre el editor con la imagen seleccionada
   */
export function abrirEditor(e, editor) {
    // Obtiene la imagen
    urlImage = URL.createObjectURL(e.target.files[0]);

    // Borra editor en caso que existiera una imagen previa
    editor.innerHTML = '';
    let cropprImg = document.createElement('img');
    cropprImg.setAttribute('id', 'croppr');
    editor.appendChild(cropprImg);

    // Limpia la previa en caso que existiera algún elemento previo
    contexto.clearRect(0, 0, miCanvas.width, miCanvas.height);

    // Envia la imagen al editor para su recorte
    document.querySelector('#croppr').setAttribute('src', urlImage);

    // Crea el editor
    new Croppr('#croppr', {
        aspectRatio: 1,
        startSize: [70, 70],
        onCropEnd: recortarImagen
    })
}

/**
* Método que recorta la imagen con las coordenadas proporcionadas con croppr.js
*/
export function recortarImagen(data) {
    // Variables
    const inicioX = data.x;
    const inicioY = data.y;
    const nuevoAncho = data.width;
    const nuevaAltura = data.height;
    const zoom = 1;
    let imagenEn64 = '';
    // La imprimo
    miCanvas.width = nuevoAncho;
    miCanvas.height = nuevaAltura;
    // La declaro
    let miNuevaImagenTemp = new Image();
    // Cuando la imagen se carge se procederá al recorte
    miNuevaImagenTemp.onload = function () {
        // Se recorta
        contexto.drawImage(miNuevaImagenTemp, inicioX, inicioY, nuevoAncho * zoom, nuevaAltura * zoom, 0, 0, nuevoAncho, nuevaAltura);
        // Se transforma a base64
        imagenEn64 = miCanvas.toDataURL("image/jpeg");
        // Mostramos el código generado
        document.querySelector('#base64').textContent = imagenEn64;
        document.querySelector('#base64HTML').textContent = '<img src="' + imagenEn64.slice(0, 40) + '...">';

    }
    // Proporciona la imagen cruda, sin editarla por ahora
    miNuevaImagenTemp.src = urlImage;
}