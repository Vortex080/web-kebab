<div class="content">
    <div class="caja">
        <h2 class="hiniciosession">Registro</h2>
        <form action="auth.php" method="POST" id="form-name">
            <?php
                $email = $_POST['email'];
                $pass = $_POST['password'];
            ?>
            <label for="email">Nombre</label>
            <input type="text" id="name" name="name" placeholder="Introduce tu nombre" value="<?php echo $email; ?>">
            <div class="warning"><p id="nwarning"></p></div>
            <label for="password">Apellidos</label>
            <input type="text" id="lastname" name="lastname" placeholder="Introduce tus apellidos">
            <div class="warning"><p id="lwarning"></p></div>
            <label for="password">Dirección</label>
            <input type="text" id="direction" name="direction" placeholder="Introduce tu dirección">
            <div class="warning"><p id="dwarning"></p></div>
            <label for="password">Localidad</label>
            <input type="text" id="direction" name="localidad" placeholder="Introduce tu localidad">
            <div class="warning"><p id="lowarning"></p></div>
            <label for="password">Codigo Posal</label>
            <input type="text" id="direction" name="postal" placeholder="Introduce tu codigo postal">
            <div class="warning"><p id="pwarning"></p></div>
            <button id="nextBtn">Registro</button>
            
            <div class="registro">
                <p>¿Tienes cuenta? <a href="?menu=session">Iniciar Sesión</a></p>
            </div>
        </form>
    </div>
</div>

<script src="../../assets/js/register-name.js"></script>
