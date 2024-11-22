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
        $_SESSION['user'] = UserRep::getbyId(51);
        $data = file_get_contents('php://input'); // Decodifica el JSON del input
        // Obtén el usuario desde la base de datos
        $user = UserRep::getbyId($_SESSION['user']->id);
        $kebab = $data;
        echo $data;
        echo '<br>';
        array_push($user->carrito, $kebab);


        //$_SESSION['user']->carrito[] = $data;
        // Decodifica el carrito del usuario si está en formato JSON
        //$user->carrito[] = $data;

        // Actualiza el usuario en la base de datos
        UserRep::update($user);

        // Envía la respuesta con el carrito combinado
        echo json_encode(["success" => true, "data" => $user->carrito]);
        break;

    default:
        echo json_encode(['error' => 'Error']);
        break;
}
