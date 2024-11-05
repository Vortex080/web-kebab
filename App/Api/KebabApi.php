<?php

$dr = $_SERVER['DOCUMENT_ROOT'];
include_once $dr . "/routes/__autoload.php";

$requesmethod = $_SERVER['REQUEST_METHOD'];

switch ($requesmethod) {
    case 'GET':
        $id = $_GET['id'];
        $kebab = KebabRep::getbyId($id);
        echo json_encode($kebab);
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'));
        $kebab = new Kebab(null, $data->nombre, $data->foto, $data->ingredientes, $data->precio);
        $result = KebabRep::create($kebab);
        echo json_encode(["success" => $result, "data" => $data]);
        break;
    case 'DELETE':
        $id = $_GET['id'];
        $result = KebabRep::delete($id);
        echo json_encode(["success" => $result, "data" => $id]);
        break;
    case 'PUT':
        $id = $_GET['id'];
        $nombre = $_GET['nombre'];
        $foto = $_GET['foto'];
        $ingredientes = $_GET['ingredientes'];
        $precio = $_GET['precio'];
        $kebab = new Kebab($id, $nombre, $foto, $ingredientes, $precio);
        $result = KebabRep::update($kebab);
        echo json_encode(["success" => $result, "data" => $kebab]);
        break;
    default:
        echo json_encode(['error' => 'Error']);
        break;
}
