
<div class="content">
    <div class="caja">
        <h2 class="hiniciosession">Registro</h2>
        <form action="index.php?menu=register-name" method="POST" id="form-reg">
            <label for="email">E-mail</label>
            <input type="text" id="email" name="email" placeholder="Introduce tu correo">
            <div class="warning"><p id="ewarning"></p></div>
            <label for="password" >Contraseña</label>
            <input type="password" id="password" name = "password" placeholder="Introduce tu contraseña">
            <div class="warning"><p id="pwarning"></p></div>
            <label for="password">Repite la contraseña</label>
            <input type="password" id="password2" placeholder="Repite la contraseña">
            <div class="warning"><p id="ppwarning"></p></div>
            <button id='nextBtn'>Siguiente</button>
            
            <div class="registro">
                <p>¿Tienes cuenta? <a href="?menu=session">Iniciar Sesión</a></p>
            </div>
        </form>
    </div>
</div>
