<?php
session_start();
$dr = $_SERVER['DOCUMENT_ROOT'];
include_once $dr . "/routes/__autoload.php";

$requesmethod = $_SERVER['REQUEST_METHOD'];


switch ($requesmethod) {
    case 'GET':
        echo json_encode($_SESSION['user']);
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'));
        echo 'Session';
        echo $_SESSION['user'];
        $user = UserRep::getbyId($_SESSION['user']->id);
        array_push($data->carrito, $_SESSION['user']->carrito);
        $user->carrito = $data->carrito;
        UserRep::update($_SESSION['user']);
        echo json_encode(["success" => true, "data" => $carrito]);
        break;
        
    default:
        echo json_encode(['error' => 'Error']);
        break;
}
