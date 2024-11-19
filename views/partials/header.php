<nav class="navbar">
    <div class="logo">
        <img src="../../assets/img/logo-kebab.png" alt="Logo Kebab">
    </div>
    <ul class="nav-links">
        <li><a href="?menu=inicio">Inicio</a></li>
        <li><a href="?menu=menu">Menú</a></li>
        <li><a href="?menu=contacto">Contacto</a></li>

    </ul>
    <?php

    if (LogIn::statusLogin()) {
        $user = $_SESSION['user'];
        echo '
        <input type="hidden" id="user" value=' . $user->id . '>
        <div>
            <img id="carrito" class="carrito" src="../../assets/img/carrito.png" alt="user" loading="lazy" >
        </div>
        <div class="user-menu">
            <button class="user-btn" id="user-btn">
                <div class="user-photo" id="userphoto">
                </div>
            </button>
            <div class="submenu">
                <a>Monedero: ' . $user->monedero . ' €</a>
                <a href="?menu=perfil">Mi perfil</a>
                <a style="color:red" href="?menu=cierrarsession">Cerrar Sesión</a>
            </div>
        </div>
        ';
        echo '<script type="module" src="../../assets/js/header.js"></script>';
    } else {
        echo '    <div class="cta">
        <a href="?menu=session" class="btn-i">Inicia Sesión</a>
        <a href="?menu=register" class="btn-r">Registrate</a>
        </div>';
    }
    ?>
</nav>
<?php

switch (LogIn::statusLogin()) {
    case true:
        if ($_SESSION['user']->rol == 'administrador') {
            echo '
            <nav class="nav2-admin">
                <ul class="nav-links-admin">
                    <li><a href="?admin=usuarios">Usuarios</a></li>
                    <li><a href="?admin=kebab">Kebabs</a></li>
                    <li><a href="?admin=ingredientes">Ingredientes</a></li>
                    <li><a href="?admin=alergenos">Alegenos</a></li>
                    <li><a href="?admin=pedidos">Pedidos</a></li>
                </ul>
            </nav>';
        }
        break;
    case false:
        echo '
        <nav class="nav2">
            <p>Telefono de contacto: 667 884 922 🌯</p>
        </nav>';
        break;
    default:
        echo '
        <nav class="nav2">
            <p>e - Telefono de contacto: 667 884 922 🌯</p>
        </nav>';
        break;
}
?>