<?php

$dr = $_SERVER['DOCUMENT_ROOT'];
include_once $dr . "/routes/__autoload.php";

$requesmethod = $_SERVER['REQUEST_METHOD'];

switch ($requesmethod) {
    case 'GET':
        $id = $_GET['id'];
        $user = UserRep::getbyId($id);
        echo json_encode($user);
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'));
        $user = new User(null, $data->nombre, $data->pass, $data->direcction, $data->monedero, $data->foto);
        $result = UserRep::create($user);
        echo json_encode(["success" => true, "data" => $data]);
        break;
    case 'DELETE':
        $id = $_GET['id'];
        $result = UserRep::delete($id);
        echo json_encode(["success" => $result, "data" => $id]);
        break;
    case 'PUT':
        $id = $_GET['id'];
        $nombre = $_GET['nombre'];
        $pass = $_GET['pass'];
        $direcction = $_GET['direcction'];
        $monedero = $_GET['monedero'];
        $foto = $_GET['foto'];
        $json = json_decode(file_get_contents('php://input'));
        $user = new User($id, $nombre, $pass, $direcction, $monedero, $foto);
        $result = UserRep::update($user);
        echo json_encode(["success" => $result, "data" => $user]);
        break;
    default:
        echo json_encode(['error' => 'Error']);
        break;
}
