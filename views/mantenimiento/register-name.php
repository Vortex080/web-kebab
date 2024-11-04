<div class="content">
    <div class="caja">
        <h2 class="hiniciosession">Registro</h2>
        <form action="auth.php" method="POST">
            <?php
                $email = $_POST['email'];
                $pass = $_POST['password'];
            ?>
            <label for="email">Nombre</label>
            <input type="text" id="name" placeholder="Introduce tu nombre">
            
            <label for="password">Apellidos</label>
            <input type="text" id="lastname" placeholder="Introduce tus apellidos">

            <label for="password">Dirección</label>
            <input type="text" id="direction" placeholder="Introduce tu dirección">

            <label for="password">Localidad</label>
            <input type="text" id="direction" placeholder="Introduce tu localidad">

            <label for="password">Codigo Posal</label>
            <input type="text" id="direction" placeholder="Introduce tu codigo postal">
            
            <button type="submit">Registro</button>
            
            <div class="registro">
                <p>¿Tienes cuenta? <a href="?menu=session">Iniciar Sesión</a></p>
            </div>
        </form>
    </div>
</div>
