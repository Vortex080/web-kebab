<?php

if (isset($_GET['menu'])) {
    if ($_GET['menu'] == "inicio") {
        require_once './views/mantenimiento/inicio.php';
    }
    if ($_GET['menu'] == "menu") {
        require_once './views/mantenimiento/menu.php';
    }
    if ($_GET['menu'] == "ofertas") {
        require_once './views/mantenimiento/ofertas.php';
    }
    if ($_GET['menu'] == "contacto") {
        require_once './views/mantenimiento/contacto.php';
    }
    if ($_GET['menu'] == "session") {
        require_once './views/mantenimiento/iniciasession.php';
    }
    if ($_GET['menu'] == "register") {
        require_once './views/mantenimiento/register.php';
    }
    if ($_GET['menu'] == "register-name") {
        require_once './views/mantenimiento/register-name.php';
    }
    if ($_GET['menu'] == "mantenimiento-kebab") {
        require_once './views/mantenimiento/mantenimiento-kebab.php';
    }
}
