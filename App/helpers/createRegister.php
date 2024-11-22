<?php

$email = $_POST['email'];
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$pass = $_POST['password'];
$pass2 = $_POST['password2'];

$direccion = new Direction('Sin dirección', 1, null);
$user = new User($name, $pass, 0.1, '', $email, 'usuario', $direccion, null, '', null);
UserRep::create($user);

echo '<script>window.location="?menu=session"</script>';
