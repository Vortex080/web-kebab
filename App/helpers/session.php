<?php

$dr = $_SERVER['DOCUMENT_ROOT'];
include_once $dr . "/routes/__autoload.php";
$users = UserRep::getAll();
LogIn::iniciaSession();
$correo = $_POST['email'];
$pass = $_POST['password'];
$val = false;
foreach ($users as $user) {
    if ($user->email == $correo && $user->pass == $pass) {
        $usuario = $user;
        LogIn::creaLogIn($usuario);
        $dr = $_SERVER['DOCUMENT_ROOT'];
        $val = true;
        break;
    } else {
        $val = false;
    }
}

if ($val == false) {
    echo '<script>window.location="?menu=session"</script>';
} else {
    echo '<script>window.location="?menu=inicio"</script>';
}
