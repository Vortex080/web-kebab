<?php

$dr = $_SERVER['DOCUMENT_ROOT'];
include_once $dr . "/routes/__autoload.php";

$requesmethod = $_SERVER['REQUEST_METHOD'];

switch ($requesmethod) {
    case 'GET':
        $id = $_GET['id'];
        if ($id != 'All') {
            $ingrediente = IngredientesRep::getbyId($id);
            echo json_encode($ingrediente);
        } else {
            $ingrediente = IngredientesRep::getAll();
            echo json_encode($ingrediente);
        }

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
        $data = json_decode(file_get_contents('php://input'));
        $ingrediente = new Ingredientes($data->nombre, $data->precio, $data->foto, $id, $data->alergenos);
        $result = IngredientesRep::update($ingrediente);
        echo json_encode(["success" => $result, "data" => $ingrediente]);
        break;
    default:
        echo json_encode(['error' => 'Error']);
        break;
}
