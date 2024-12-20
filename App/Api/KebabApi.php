<?php

$dr = $_SERVER['DOCUMENT_ROOT'];
include_once $dr . "/routes/__autoload.php";

$requesmethod = $_SERVER['REQUEST_METHOD'];

switch ($requesmethod) {
    case 'GET':
        $id = $_GET['id'];
        if ($id == 'All') {
            $kebabs = KebabRep::getAll();
            echo json_encode($kebabs);
        } else {
            $id = $_GET['id'];
            $kebab = KebabRep::getbyId($id);
            echo json_encode($kebab);
        }
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'));
        $kebab = new Kebab($data->nombre, $data->foto, $data->ingredientes, $data->precio, null);
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
        $data = json_decode(file_get_contents('php://input'));
        $kebab = new Kebab($data->nombre, $data->foto, $data->ingredientes, $data->precio, $id);
        $result = KebabRep::update($kebab);
        echo json_encode(["success" => $result, "data" => $kebab]);
        break;
    default:
        echo json_encode(['error' => 'Error']);
        break;
}
