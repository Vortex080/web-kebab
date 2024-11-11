<?php

$dr = $_SERVER['DOCUMENT_ROOT'];
include_once $dr . "/routes/__autoload.php";

$requesmethod = $_SERVER['REQUEST_METHOD'];

switch ($requesmethod) {
    case 'GET':
        $id = $_GET['id'];
        $pedido = PedidosRep::getbyId($id);
        echo json_encode($pedido);
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'));
        $pedido = new Pedido($data->fecha, $data->estado, $data->precio, $data->direccion, $data->user, $data->lineas, null);
        //LineaPedidoRep::
        $result = PedidosRep::create($pedido);
        echo json_encode(["success" => $result, "data" => $data]);
        break;
    case 'DELETE':
        $id = $_GET['id'];
        $result = PedidosRep::delete($id);
        echo json_encode(["success" => $result, "data" => $id]);
        break;
    case 'PUT':
        $id = $_GET['id'];
        $json = json_decode(file_get_contents('php://input'));
        $pedido = new Pedido($json->fecha, $json->estado, $json->precio, $json->direccion, $json->user, $json->lineas, $id);
        $result = PedidosRep::update($pedido);
        echo json_encode(["success" => $result, "data" => $json]);
        break;
    default:
        echo json_encode(['error' => 'Error']);
        break;
}
