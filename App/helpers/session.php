<?php

$dr = $_SERVER['DOCUMENT_ROOT'];
include_once $dr . "/routes/__autoload.php";
LogIn::iniciaSession();
$correo = $_POST['email'];
$pass = $_POST['password'];


echo 'Session iniciada';
echo '<br>';
$usuario = UserRep::getbyCorreo($correo);
LogIn::creaLogIn($usuario);
$dr = $_SERVER['DOCUMENT_ROOT'];
echo '<script>window.location="?menu=inicio"</script>';
