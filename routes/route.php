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
}
