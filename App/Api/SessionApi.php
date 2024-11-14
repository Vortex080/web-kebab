<?php
session_start();
$dr = $_SERVER['DOCUMENT_ROOT'];
include_once $dr . "/routes/__autoload.php";
include_once $dr . "/App/Models/User.php";

$requesmethod = $_SERVER['REQUEST_METHOD'];


switch ($requesmethod) {
    case 'GET':
        echo json_encode($_SESSION['user']);
        break;
    case 'PUT':
        $id = $_GET['id'];
        $newcarrito = [];
        $data = json_decode(file_get_contents('php://input')); // Decodifica el JSON del input

        // Obtén el usuario desde la base de datos
        $user = UserRep::getbyId($id);

        // Decodifica el carrito del usuario si está en formato JSON
        $userCarrito = json_decode($user->carrito, true);
        if (!is_array($userCarrito)) {
            $userCarrito = []; // Si no es un array, inicialízalo como uno vacío
        }

        // Decodifica el nuevo carrito que viene en el JSON del input
        $newItems = json_decode($data->carrito, true);
        if (is_array($newItems)) {
            $newcarrito = array_merge($userCarrito, $newItems); // Combina ambos carritos
        }

        // Guarda el carrito combinado en formato JSON
        $user->carrito = json_encode($newcarrito);

        // Actualiza el usuario en la base de datos
        UserRep::update($user);

        // Envía la respuesta con el carrito combinado
        echo json_encode(["success" => true, "data" => $newcarrito]);
        break;
        
    default:
        echo json_encode(['error' => 'Error']);
        break;
}
