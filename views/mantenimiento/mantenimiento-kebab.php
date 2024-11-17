<link rel="stylesheet" href="../../assets/css/mantenimiento-kebab.css">
<style>
    .preview img {
        max-width: 200px;
        max-height: 200px;
        width: auto;
        height: auto;
        display: block;
        margin-bottom: 10px;
        border: 2px solid #ccc;
        /* Borde de la imagen */
        border-radius: 5px;
        /* Bordes redondeados para la imagen */
        object-fit: contain;
    }

    #remove-photo {
        display: none;
        background-color: #ff4d4d;
        /* Color de fondo rojo */
        color: white;
        border: none;
        padding: 8px 12px;
        margin-top: 10px;
        /* Margen entre la imagen y el botón */
        cursor: pointer;
        border-radius: 5px;
        font-size: 14px;
        transition: background-color 0.3s;
    }

    #remove-photo:hover {
        background-color: #e60000;
        /* Color al pasar el cursor */
    }

    .error {
        color: red;
        font-size: 0.9em;
    }
</style>
<div class="centering-container">
    <!-- Modal -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Lista de Kebabs</h2>
                <button class="close-btn" id="closeModalBtn">&times;</button>
            </div>
            <div class="list-container" id="listContainer">
                <!-- Los elementos dinámicos se agregarán aquí -->
            </div>
        </div>
    </div>
    <div class="container">
        <!-- Foto y Nombre en la misma línea -->
        <input type="hidden" name="id" id="id">
        <h2 class="container-title">Mantenimiento Kebab</h2>
        <button id="openModalBtn">Editar Kebab</button>
        <div class="flex-row">
            <div class="foto-section">
                <label for="foto">Foto</label>
                <button type="button" id="remove-photo">Eliminar Foto</button>
                <form action="../../App/Helpers/upload.php" method="POST" enctype="multipart/form-data" id="form-foto">
                    <input type="file" id="foto" accept="image/*" />
                </form>
                <div id="preview" class="preview">
                    <!-- La imagen seleccionada aparecerá aquí -->
                </div>
                <div id="error-message" class="error"></div>
            </div>
            <div class="descripcion-section">
                <label for="descripcion">Nombre</label>
                <input type="text" name="name" id="name" placeholder="Escribe el nombre..." />
            </div>
        </div>

        <!-- Precio Estimado y Precio en la misma línea -->
        <div class="flex-row">
            <div class="precio-estimado-section">
                <label for="precio-estimado">Precio Estimado</label>
                <input type="text" id="precio-estimado" placeholder="0.00" disabled />
            </div>
            <div class="precio-section">
                <label for="precio">Precio</label>
                <input type="text" id="precio" placeholder="Escribe el precio..." />
            </div>
        </div>

        <!-- Ingredientes Incluidos y Todos los Ingredientes en la misma línea -->
        <div class="flex-row">
            <div class="ingredientes-incluidos">
                <label>Ingredientes Incluidos</label>
                <div class="ingredientes-list" id="ingredientes-incluidos-list">
                    <!-- Aquí se añadirán los ingredientes incluidos -->
                </div>
            </div>
            <div class="todos-ingredientes">
                <label>Todos los Ingredientes</label>
                <div class="ingredientes-list" id="todos-ingredientes-list">
                </div>
            </div>
        </div>
        <!-- Contenedor para los botones -->
        <div class="buttons-container">
            <button type="button" class="btn-save" id="btn-save">Guardar</button>
            <button type="button" class="btn-clear">Limpiar</button>
            <button type="button" class="btn-delete" id="btn-delete">Eliminar</button>
        </div>
    </div>
</div>


<script type="module" src="../../assets/js/mantenimiento-kebab.js"></script>