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
        $ingrediente = new Ingredientes(null, $data->nombre, $data->alergenos, $data->precio);
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
        $json = json_decode(file_get_contents('php://input'));
        $ingrediente = new Ingredientes($id, $json->nombre, $json->alergenos, $json->precio);
        $result = IngredientesRep::update($ingrediente);
        echo json_encode(["success" => $result, "data" => $json]);
        break;
    default:
        echo json_encode(['error' => 'Error']);
        break;
}
