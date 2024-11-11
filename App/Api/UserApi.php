<?php

$dr = $_SERVER['DOCUMENT_ROOT'];
include_once $dr . "/routes/__autoload.php";

$requesmethod = $_SERVER['REQUEST_METHOD'];

switch ($requesmethod) {
    case 'GET':
        $id = $_GET['id'];
        if ($id != 'All') {
            $user = UserRep::getbyId($id);
            echo json_encode($user);
        } else {
            $users = UserRep::getAll();
            echo json_encode($users);
        }
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'));
        $user = new User($data->nombre, $data->pass, $data->monedero, $data->foto, $data->email, $data->rol, $data->direcction, $data->alergenos, null);
        $result = UserRep::create($user);
        echo json_encode(["success" => true, "data" => $user]);
        break;
    case 'DELETE':
        $id = $_GET['id'];
        $result = UserRep::delete($id);
        echo json_encode(["success" => $result, "data" => $id]);
        break;
    case 'PUT':
        $id = $_GET['id'];
        $data = json_decode(file_get_contents('php://input'));
        $user = new User($data->nombre, $data->pass, $data->monedero, $data->foto, $data->email, $data->rol, $data->direcction, $data->alergenos, $id);
        $result = UserRep::update($user);
        echo json_encode(["success" => $result, "data" => $user]);
        break;
    default:
        echo json_encode(['error' => 'Error']);
        break;
}
