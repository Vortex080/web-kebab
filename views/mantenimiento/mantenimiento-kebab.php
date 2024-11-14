<link rel="stylesheet" href="../../assets/css/mantenimiento-kebab.css">
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