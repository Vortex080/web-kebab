<link rel="stylesheet" href="../../assets/css/mantenimiento-kebab.css">
<script src="https://cdn.jsdelivr.net/gh/jamesssooi/Croppr.js@2.3.0/dist/croppr.min.js"></script>
<link href="https://cdn.jsdelivr.net/gh/jamesssooi/Croppr.js@2.3.0/dist/croppr.min.css" rel="stylesheet" />
<style>

</style>
<div class="centering-container">
    <!-- Modal -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Lista de Ingredientes</h2>
                <button class="close-btn" id="closeModalBtn"></button>
            </div>
            <div class="list-container" id="listContainer">
                <!-- Los elementos dinámicos se agregarán aquí -->
            </div>
        </div>
    </div>
    <!-- Modal para el editor de imágenes -->
    <div class="imagemodal" tabindex="-1" id="imageModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">2 Recorta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="editor" id="editor"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="closeModalBtnPhoto" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">

        <!-- Foto y Nombre en la misma línea -->
        <input type="hidden" name="id" id="id">
        <h2 class="container-title">Mantenimiento Ingredientes</h2>
        <button id="openModalBtn">Editar Ingrediente</button>
        <div class="flex-row">
            <div class="foto-section">
                <label for="foto">Foto</label>
                <button type="button" id="remove-photo">Eliminar Foto</button>
                <form action="../../App/Helpers/upload.php" method="POST" enctype="multipart/form-data" id="form-foto">
                    <input type="file" id="foto" accept="image/*" />
                </form>
                <div id="preview" class="preview">
                    <canvas class="foto" id="preview-final"></canvas>
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
            <div class="precio-section">
                <label for="precio">Precio</label>
                <input type="text" id="precio" placeholder="Escribe el precio..." />
            </div>
        </div>

        <!-- Ingredientes Incluidos y Todos los Ingredientes en la misma línea -->
        <div class="flex-row">
            <div class="ingredientes-incluidos">
                <label>Alergenos incluidos</label>
                <div class="ingredientes-list" id="alergenos-incluidos-list">
                    <!-- Aquí se añadirán los ingredientes incluidos -->
                </div>
            </div>
            <div class="todos-ingredientes">
                <label>Todos los Alergenos</label>
                <div class="ingredientes-list" id="todos-alergenos-list">
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


<script type="module" src="../../assets/js/mantenimiento-ingredientes.js"></script>