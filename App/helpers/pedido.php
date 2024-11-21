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

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    // Configuración SMTP para MailHog
    $mail->isSMTP();                                     // Usar SMTP
    $mail->SMTPDebug = 0;                                 // Desactivar depuración SMTP
    $mail->Host = 'mailhog';                            // MailHog corre en localhost
    $mail->Port = 1025;                                   // Puerto de MailHog
    $mail->SMTPAuth = false;                              // No requiere autenticación
    // No establecer SMTPSecure ya que MailHog no soporta TLS ni SSL
    // $mail->SMTPSecure = 'tls';                         // NO es necesario

    // Remitente y destinatario
    $mail->setFrom('kebabamigo@factura.com', 'Hasin');
    $mail->addAddress('to@example.com', 'Destinatario'); // Dirección del destinatario (puedes dejar cualquier correo ficticio)

    // Contenido del correo
    $mail->isHTML(true);                                  // Establecer formato de correo como HTML
    $mail->Subject = 'Correo de prueba';

    $mail->addEmbeddedImage('./assets/img/laperra.jpg', 'imagen_cid');
    $mail->Body    = '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo de Tabla HTML</title>
    <style>
        
    </style>
</head>
<body>

    <h1>Factura</h1>

      


</body>
</html><img src="cid:imagen_cid" alt="Imagen"/>;
';
    //

    // Enviar el correo
    if (!$mail->send()) {
        echo 'El mensaje no pudo ser enviado.';
        echo 'Error: ' . $mail->ErrorInfo;
    } else {
        echo 'El mensaje ha sido enviado';
    }
} catch (Exception $e) {
    echo "El mensaje no pudo ser enviado. Error: {$mail->ErrorInfo}";
}


echo '<script>window.location="?menu=inicio"</script>';
