<?php
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
    $mail->setFrom('jonatan@jonatan.com', 'Jonatan');
    $mail->addAddress('to@example.com', 'Destinatario'); // Dirección del destinatario (puedes dejar cualquier correo ficticio)

    // Contenido del correo
    $mail->isHTML(true);                                  // Establecer formato de correo como HTML
    $mail->Subject = 'Correo de prueba';

    $mail->addEmbeddedImage('./assets/img/laperra.jpg','imagen_cid');
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

    <h1>Ejemplo de Tabla en HTML</h1>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Ciudad</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Juan Pérez</td>
                <td>25</td>
                <td>Madrid</td>
            </tr>
            <tr>
                <td>Ana Gómez</td>
                <td>30</td>
                <td>Barcelona</td>
            </tr>
            <tr>
                <td>Carlos López</td>
                <td>22</td>
                <td>Sevilla</td>
            </tr>
        </tbody>
    </table>

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
