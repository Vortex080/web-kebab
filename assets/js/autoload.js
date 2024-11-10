// Función para cargar archivos JS dinámicamente
function loadScripts(scripts, callback) {
    let loadedScripts = 0;

    scripts.forEach((src) => {
        let script = document.createElement("script");
        script.src = src;
        script.async = true;

        // Contar cada archivo cargado y verificar si todos han sido cargados
        script.onload = () => {
            loadedScripts++;
            if (loadedScripts === scripts.length && typeof callback === "function") {
                callback(); // Ejecutar callback si todos los scripts han cargado
            }
        };

        // Manejar errores de carga
        script.onerror = () => {
            console.error(`Error al cargar el script: ${src}`);
        };

        // Agregar el script al documento
        document.head.appendChild(script);
    });
}

// Uso de la función para cargar archivos
const scriptsToLoad = [
    "assets/js/Api/AlergenosApi.js",
    "assets/js/Api/DirectionApi.js",
    "assets/js/Api/IngredienteApi.js",
    "assets/js/Api/KebabApi.js",
    "assets/js/Api/PedidoApi.js",
    "assets/js/Api/UserApi.js"
];

window.addEventListener('load', () => loadScripts(scriptsToLoad, () => {
    console.log("Todos los scripts han sido cargados.");
}));