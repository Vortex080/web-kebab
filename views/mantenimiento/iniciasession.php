<div class="content">
    <div class="caja">
        <h2 class="hiniciosession">INICIO DE SESIÓN</h2>
        <form action="?menu=sessionr" id="form-ses" method="POST">
            <label for="email">E-mail</label>
            <input type="text" id="email" name="email" placeholder="Introduce tu correo">
            <div class="warning">
                <p id="ewarning"></p>
            </div>
            <label for="password">Contraseña</label>
            <a href="#" class="enlace-contrasena">¿Olvidaste tu contraseña?</a>
            <input type="password" id="password" name="password" placeholder="Introduce tu contraseña">
            <div class="warning">
                <p id="pwarning"></p>
            </div>
            <button id="btn" type="submit">Iniciar Sesión</button>

            <div class="registro">
                <p>¿No tienes cuenta? <a href="?menu=register">Regístrate</a></p>
            </div>
        </form>
    </div>
</div>
<script type="module" src="../../assets/js/session.js"></script>
