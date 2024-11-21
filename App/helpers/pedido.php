<?php


$session = $_SESSION['user'];
$id = $user->id;

$user = UserRep::getbyId($id);
$direccion = $user->direcction;
$carritoarray = json_decode($user->carrito);
$total = 0;
$arraylineas = [];
foreach ($carritoarray as $carrito) {
    $linea = new LineaPedido($carrito->cantidad, json_encode($carrito), $carrito->precio, null);
    $total = $total + $carrito->precio;
    array_push($arraylineas, $linea);
}
$fechaActual = date('Y-m-d');
$pedido = new Pedido($fechaActual, 'En preparación', $total, $direccion->direction, $user->id, $arraylineas, null);

$user->monedero = $user->monedero - $total;
$user->carrito = '';
UserRep::update($user);


PedidosRep::create($pedido);

echo '<script>window.location="?menu=inicio"</script>';