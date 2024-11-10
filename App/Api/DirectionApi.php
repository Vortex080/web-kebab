<?php

$dr = $_SERVER['DOCUMENT_ROOT'];
include_once $dr . "/routes/__autoload.php";

$requesmethod = $_SERVER['REQUEST_METHOD'];

switch ($requesmethod) {
    case 'GET':
        $id = $_GET['id'];
        $direction = DirectionRep::getbyId($id);
        echo json_encode($direction);
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'));
        $direction = new Direction($data->direction, $data->status, null);
        $result = DirectionRep::create($direction);
        echo json_encode(["success" => true, "data" => $data]);
        break;
    case 'DELETE':
        $id = $_GET['id'];
        $result = DirectionRep::delete($id);
        echo json_encode(["success" => $result, "data" => $id]);
        break;
    case 'PUT':
        $id = $_GET['id'];
        $direction = $_GET['direction'];
        $status = $_GET['status'];
        $direction = new Direction($direction, $status, $id);
        $result = DirectionRep::update($direction);
        echo json_encode(["success" => true, "data" => $direction]);
        break;
    default:
        echo json_encode(['error' => 'Error']);
        break;
}
