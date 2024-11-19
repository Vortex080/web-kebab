<link rel="stylesheet" href="../../assets/css/perfil.css">
<script src="https://cdn.jsdelivr.net/gh/jamesssooi/Croppr.js@2.3.0/dist/croppr.min.js"></script>
<link href="https://cdn.jsdelivr.net/gh/jamesssooi/Croppr.js@2.3.0/dist/croppr.min.css" rel="stylesheet" />
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
                    <div class="preview-container">
                        <canvas class="foto" id="preview-final"></canvas>
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