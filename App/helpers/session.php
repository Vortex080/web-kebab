<?php

$dr = $_SERVER['DOCUMENT_ROOT'];
include_once $dr . "/routes/__autoload.php";

$correo = $_POST['email'];
$pass = $_POST['password'];
$usuarios = UserRep::getAll();


echo 'Session iniciada';
echo '<br>';
foreach ($usuarios as $usuario) {
    if ($usuario->email == $correo) {
        LogIn::creaLogIn($usuario);
        $dr = $_SERVER['DOCUMENT_ROOT'];
        echo '<script>window.location="?menu=inicio"</script>';
    }
}
