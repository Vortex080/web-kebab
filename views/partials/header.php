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
        <div class="user-menu">
            <button class="user-btn" id="user-btn">
                <div class="user-photo" id="userphoto">
                    <img src="../../assets/img/users/' . $user->id . '.jpg" alt="user" loading="lazy">
                </div>
            </button>
            <div class="submenu">
                <a href="#">Opción 1</a>
                <a href="#">Opción 2</a>
                <a href="#">Opción 3</a>
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

switch (LogIn::statusLogin()){
    case true:
        if($_SESSION['user']->rol == 'administrador'){
            echo '
            <nav class="nav2">
                <p>'.$_SESSION['user']->rol.'</p>
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
