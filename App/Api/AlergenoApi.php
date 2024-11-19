<?php

$dr = $_SERVER['DOCUMENT_ROOT'];
include_once $dr . "/routes/__autoload.php";

$requesmethod = $_SERVER['REQUEST_METHOD'];

switch ($requesmethod) {
    case 'GET':
        if ($_GET['id'] == 'All') {
            $alergenos = AlergenosRep::getAll();
            echo json_encode($alergenos);
        } else {
            $id = $_GET['id'];
            $alergeno = AlergenosRep::getbyId($id);
            echo json_encode($alergeno);
        }
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'));
        $alergeno = new Alergenos($data->nombre, $data->foto, null);
        $result = AlergenosRep::create($alergeno);
        echo json_encode(["success" => $result, "data" => $data]);
        break;
    case 'DELETE':
        $id = $_GET['id'];
        $result = AlergenosRep::delete($id);
        echo json_encode(["success" => $result, "data" => $id]);
        break;
    case 'PUT':
        $id = $_GET['id'];
        $json = json_decode(file_get_contents('php://input'));
        $alergeno = new Alergenos($json->nombre, $json->foto, $id);
        $result = AlergenosRep::update($alergeno);
        echo json_encode(["success" => $result, "data" => $json]);
        break;
    default:
        echo json_encode(['error' => 'Error']);
        break;
}
