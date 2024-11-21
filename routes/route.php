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
    if ($_GET['menu'] == "sessionr") {
        require_once './App/helpers/session.php';
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
    if ($_GET['menu'] == "producto") {
        require_once './views/mantenimiento/producto.php';
    }
    if ($_GET['menu'] == "cierrarsession") {
        require_once './App/helpers/cierrarsession.php';
    }
    if ($_GET['menu'] == "carrito") {
        require_once './views/mantenimiento/carrito.php';
    }
    if ($_GET['menu'] == "perfil") {
        require_once './views/mantenimiento/perfil.php';
    }
    if ($_GET['menu'] == "compra") {
        require_once './views/mantenimiento/compra.php';
    }
    if ($_GET['menu'] == "registerr") {
        require_once './App/helpers/createRegister.php';
    }
    if ($_GET['menu'] == "pedido") {
        require_once './App/helpers/pedido.php';
    }
    if ($_GET['menu'] == "mispedidos") {
        require_once './views/mantenimiento/mispedidos.php';
    }
}

if (isset($_GET['admin'])) {
    switch ($_GET['admin']) {
        case "ingredientes":
            require_once './views/mantenimiento/ingredientes.php';
            break;
        case "kebab":
            require_once './views/mantenimiento/mantenimiento-kebab.php';
            break;
        case "usuarios":
            require_once './views/mantenimiento/usuarios.php';
            break;
        case "alergenos":
            require_once './views/mantenimiento/alergenos.php';
            break;
        case "pedidos":
            require_once './views/pedidos.php';
            break;
        default:
            require_once './views/index.php';
            break;
    }
}
