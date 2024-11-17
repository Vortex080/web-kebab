<link rel="stylesheet" href="../../assets/css/perfil.css">

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
                    <div class="form-group" id="profile-picture-container">
                        <label for="profile-picture">Foto de Perfil:</label>
                        <input type="file" id="profile-picture" name="profile-picture" disabled />
                    </div>
                    <div class="preview-container">
                        <img id="preview" src="https://via.placeholder.com/150" alt="Vista previa de la foto de perfil" />
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