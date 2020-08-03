<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Max-Age: 3600');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include_once '../../config/database.php';
include_once '../models/task.php';


//Login

session_start();
if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
    header('location: ../../login.php');
    exit;
}

$databaseConnect = new DatabaseConnect();
$pdo = $databaseConnect->getPdo();

$task = new Task($pdo);

$data = json_decode(file_get_contents("php://input"));

$task->id = $data->id;

$task->hostname = $data->hostname;
$task->action = $data->action;
$task->parameters = $data->parameters;
$task->output = $data->output;
$task->status = $data->status;
$task->user_id = $data->user_id;

if(!file_get_contents('php://input')) {
    http_response_code(503);

    echo json_encode(array("message" => "Input is empty"));
    exit;
}

if($task->update($_SESSION['id'])) {
    http_response_code(200);

    echo json_encode(array("message" => "Task updated."));

} else {
    http_response_code(503);

    echo json_encode(array("message" => "Unable to update task."));
}



