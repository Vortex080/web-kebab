<style>
    /* Contenedor que envolverá el contenedor principal para centrarlo */
    .centering-container {
        position: relative;
        width: 100%;
        height: 90vh; /* Asegura que la altura ocupe toda la ventana */
        display: flex;
        justify-content: center; /* Centrado horizontal */
        align-items: center; /* Centrado vertical */
    }

    .container {
        display: flex;
        flex-direction: column;
        gap: 20px;
        padding: 20px;
        background-color: white;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        max-width: 800px;
        overflow-y: auto; /* Permite el scroll hacia abajo si el contenido se desborda */
        width: 100%;
    }

    .flex-row {
        display: flex;
        gap: 20px;
        width: 100%;
    }

    .foto-section,
    .descripcion-section {
        flex: 1;
    }

    .precio-estimado-section,
    .precio-section {
        flex: 1;
    }

    .ingredientes-incluidos,
    .todos-ingredientes {
        flex: 1;
    }

    label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    input[type="file"],
    textarea,
    input[type="text"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: inset 0px 2px 4px rgba(0, 0, 0, 0.1);
    }

    textarea {
        resize: none;
        height: 100px;
    }

    .ingredientes-list {
        width: 370px;       /* Ancho del contenedor */
        height: 400px;      /* Alto del contenedor */
        overflow-y: auto;   /* Activa el scroll vertical */
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
    }

    .ingrediente {
        margin: 10px 0;
        padding: 10px;
        background-color: #f0f0f0;
        border-radius: 5px;
        transition: 0.5s;
    }

    .ingrediente:hover {
        background-color: #ff9100;
    }


    /* Estilos para el título */
    .container-title {
        font-size: 24px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
        color: #333; /* Puedes ajustar el color si lo prefieres */
    }

    /* Contenedor de los botones */
    .buttons-container {
        display: flex;
        gap: 20px;
        justify-content: center; /* Centra los botones horizontalmente */
        margin-top: 20px;
    }

    /* Estilo base para los botones */
    button {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    /* Estilo para el botón "Guardar" */
    .btn-save {
        background-color: #4CAF50;
        color: white;
    }

    .btn-save:hover {
        background-color: #45a049;
    }

    /* Estilo para el botón "Limpiar" */
    .btn-clear {
        background-color: #f0ad4e;
        color: white;
    }

    .btn-clear:hover {
        background-color: #ec971f;
    }

    /* Estilo para el botón "Borrar" */
    .btn-delete {
        background-color: #d9534f;
        color: white;
    }

    .btn-delete:hover {
        background-color: #c9302c;
    }

</style>
<input type="hidden" id="allingredientes" value='<?php echo json_encode(IngredientesRep::getAll()); ?>'>
<div class="centering-container">
    <div class="container">
        <!-- Foto y Nombre en la misma línea -->
         <h2 class="container-title">Mantenimiento Kebab</h2>
        <div class="flex-row">
            <div class="foto-section">
                <label for="foto">Foto</label>
                <input type="file" id="foto" accept="image/*" />
                <div id="foto-preview" class="foto-preview">
                    <!-- La imagen seleccionada aparecerá aquí -->
                </div>

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
            <button type="button" class="btn-save">Guardar</button>
            <button type="button" class="btn-clear">Limpiar</button>
            <button type="button" class="btn-delete">Cancelar</button>
        </div>
    </div>
</div>


<script src="../../assets/js/mantenimiento-kebab.js"></script>