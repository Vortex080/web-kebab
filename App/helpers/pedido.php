<?php


$session = $_SESSION['user'];
$id = $user->id;

$user = UserRep::getbyId($id);
$direccion = $user->direcction;
$carritoarray = json_decode($user->carrito);
$total = 0;
$arraylineas = [];
echo $carritoarray;
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

// Incluir la librería PHPMailer
$dr = $_SERVER['DOCUMENT_ROOT'];
require $dr . '/vendor/autoload.php'; // Ajusta la ruta según sea necesario

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// Configuración de PHPMailer
$mail = new PHPMailer(true); // Usamos PHPMailer con excepciones

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = "mailhog";
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = false;
    $mail->Port = 1025;

    // Remitente y destinatario
    $mail->setFrom('no-reply@kebabamigo.com', 'Kebab Amigo');
    $mail->addAddress('to@example.com', 'Destinatario'); // Dirección del destinatario (puedes dejar cualquier correo ficticio)

    // Configuración del contenido del correo
    $mail->isHTML(true); // Establecer el contenido del correo en formato HTML
    $mail->Subject = 'Factura de pedido';
    $mail->Body    = '<h1>Gracias por tu pedido</h1>
                        <p>¡Esperamos que disfrutes de tu compra!</p>
                        <p> Total : ' . $total . ' € </p> // Cuerpo en formato HTML
                        <p>Dirección : ' . $direccion->direction . '</p>';
    $mail->AltBody = 'factura'; // Cuerpo en texto plano (por si el cliente no soporta HTML)

    // Enviar el correo
    $mail->send();
    http_response_code(200); // Respuesta exitosa
    echo json_encode(['message' => 'Correo enviado exitosamente']);
} catch (Exception $e) {
    // En caso de error al enviar el correo
    http_response_code(500); // Error interno del servidor
    echo json_encode(['error' => 'Error al enviar el correo', 'details' => $mail->ErrorInfo]);
}



echo '<script>window.location="?menu=inicio"</script>';
