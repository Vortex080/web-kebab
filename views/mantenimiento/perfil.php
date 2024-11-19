<link rel="stylesheet" href="../../assets/css/perfil.css">
<script src="https://cdn.jsdelivr.net/gh/jamesssooi/Croppr.js@2.3.0/dist/croppr.min.js"></script>
<link href="https://cdn.jsdelivr.net/gh/jamesssooi/Croppr.js@2.3.0/dist/croppr.min.css" rel="stylesheet" />
<style>
    /* Estilo para la superposición del modal */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Fondo diferenciador */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* Estilo del modal */
    .modal {
        display: none;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        width: 300px;
    }

    /* Estilo de cada fila del modal */
    .modal-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }
</style>
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
<!-- Modal -->
<div class="modal-overlay-direcction">
    <div class="modal" id="modal-direcction">
        <div class="modal-item">
            <select>
                <option>Opción 1</option>
                <option>Opción 2</option>
                <option>Opción 3</option>
            </select>
            <button>Acción</button>
        </div>
        <div class="modal-item">
            <select>
                <option>Opción A</option>
                <option>Opción B</option>
                <option>Opción C</option>
            </select>
            <button>Acción</button>
        </div>
        <div class="modal-item">
            <select>
                <option>Uno</option>
                <option>Dos</option>
                <option>Tres</option>
            </select>
            <button>Acción</button>
        </div>
    </div>
</div>
<div class="centering-container">
    <div class="container">
        <div class="main">
            <div class="secction">
                <h3>Editar Perfil</h3>
                <form class="profile-edit-form" id="profileForm">
                    <div class="form-group">
                        <label for="username">Nombre de Usuario:</label>
                        <input type="text" id="username" name="username" disabled />
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" id="email" name="email" disabled />
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" id="password" name="password" placeholder="" disabled />
                    </div>
                    <div class="form-group">
                        <label for="password">Monedero:</label>
                        <input type="text" id="monedero" name="monedero" disabled />
                        <button id="añadirMonedero">Añadir</button>
                    </div>
                    <div class="form-group">
                        <label for="password">Direcciones:</label>
                        <button id="abrirDirecction">Abrir</button>
                    </div>
                    <div class="modal-overlay" id="modalOverlay">
                        <div class="modal">
                            <input type="text" id="dineroinp" placeholder="Dinero a añadir ...">
                            <button id="cerrarbtn">Cerrar</button>
                        </div>
                    </div>
                    <div class="form-group" id="preview">
                        <label for="profile-picture">Foto de Perfil:</label>
                        <input type="file" id="profile-picture" name="profile-picture" disabled />
                    </div>
                    <div class="preview-container" id="preview-container">

                    </div>
                    <div class="form-actions">
                        <button type="button" id="editButton" class="btn edit-btn">Editar</button>
                        <button type="submit" class="btn save-btn" id="saveButton" style="display:none;">Guardar Cambios</button>
                        <button type="button" class="btn cancel-btn" id="cancelButton" style="display:none;">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script type="module" src="../../assets/js/perfil.js"></script>