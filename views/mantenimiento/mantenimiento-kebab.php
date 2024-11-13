<style>
    .container {
        display: grid;
        grid-template-columns: repeat(2, 0.5fr) repeat(4, 1fr);
        grid-template-rows: repeat(5, 1fr);
        gap: 10px;
        padding: 10px;
        background-color: white;
        margin: 50px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    .foto-section {
        grid-area: 1 / 1 / 3 / 3;
    }

    .descripcion-section {
        grid-area: 3 / 1 / 6 / 3;
    }

    .precio-estimado-section {
        grid-area: 1 / 3 / 3 / 5;
    }

    .precio-section {
        grid-area: 1 / 5 / 3 / 7;
    }

    .ingredientes-incluidos {
        grid-area: 3 / 3 / 6 / 5;
    }

    .todos-ingredientes {
        grid-area: 3 / 5 / 6 / 7;
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
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        height: 200px;
        overflow-y: auto;
        background-color: #f9f9f9;
    }

    .ingredientes-list .ingrediente {
        padding: 10px;
        background-color: #e0f7fa;
        border: 1px solid #00acc1;
        border-radius: 5px;
        min-width: 80px;
        text-align: center;
        cursor: pointer;
    }
</style>


<div class="container">
    <div class="foto-section">
        <label for="foto">Foto</label>
        <input type="file" id="foto" />
    </div>
    <div class="descripcion-section">
        <label for="descripcion">Nombre</label>
        <input type="text" name="name" id="descripcion" placeholder="Escribe el nombre..." />
    </div>
    <div class="precio-estimado-section">
        <label for="precio-estimado">Precio Estimado</label>
        <input type="text" id="precio-estimado" placeholder="0.00" disabled />
    </div>
    <div class="precio-section">
        <label for="precio">Precio</label>
        <input type="text" id="precio" placeholder="Escribe el precio..." />
    </div>
    <div class="ingredientes-incluidos">
        <label>Ingredientes Incluidos</label>
        <div class="ingredientes-list" id="ingredientes-incluidos-list">
            <!-- Aquí se añadirán los ingredientes incluidos -->
        </div>
    </div>
    <div class="todos-ingredientes">
        <label>Todos los Ingredientes</label>
        <div class="ingredientes-list" id="todos-ingredientes-list">
            <div class="ingrediente">Ingrediente A</div>
        </div>
    </div>
</div>