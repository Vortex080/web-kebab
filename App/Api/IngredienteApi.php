<?php

$dr = $_SERVER['DOCUMENT_ROOT'];
include_once $dr . "/routes/__autoload.php";

$requesmethod = $_SERVER['REQUEST_METHOD'];

switch ($requesmethod) {
    case 'GET':
        $id = $_GET['id'];
        $ingrediente = IngredientesRep::getbyId($id);
        echo json_encode($ingrediente);
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'));
        $ingrediente = new Ingredientes($data->nombre, $data->precio, $data->foto, null, $data->alergenos);
        $result = IngredientesRep::create($ingrediente);
        echo json_encode(["success" => $result, "data" => $data]);
        break;
    case 'DELETE':
        $id = $_GET['id'];
        $result = IngredientesRep::delete($id);
        echo json_encode(["success" => $result, "data" => $id]);
        break;
    case 'PUT':
        $id = $_GET['id'];
        $nombre = $_GET['nombre'];
        $precio = $_GET['precio'];
        $alergenos = AlergenosRep::getAllbyingrediente($id);
        $ingrediente = new Ingredientes($nombre, $precio, $foto, $id, $alergenos);
        $result = IngredientesRep::update($ingrediente);
        echo json_encode(["success" => $result, "data" => $ingrediente]);
        break;
    default:
        echo json_encode(['error' => 'Error']);
        break;
}
