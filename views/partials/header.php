
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
            <button class="user-btn">
                <div class="user-photo" id="userphoto">
                    <img src="../../assets/img/users/' . $user->id . '.jpg" alt="user" loading="lazy">
                </div>
            </button>
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
<nav class="nav2">
    <p>Telefono de contacto: 667 884 922 🌯</p>
</nav>