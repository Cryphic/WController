<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once '../../config/database.php';
include_once '../models/task.php';


session_start();


if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
    header('location: ../../login.php');
    exit;
}

$databaseConnect = new DatabaseConnect();
$pdo = $databaseConnect->getPdo();


$task = new Task($pdo);


$result = $task->read($_SESSION['id']);


$num = $result->rowCount();

if($num > 0 ) {
    $post_arr = array();
    $post_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $post_item = array(
            'id' => $id,
            'hostname' => $hostname,
            'action' => $action,
            'parameters' => $parameters,
            'output' => $output,
            'status' => $status,
            'user_id' => $user_id
        );
        array_push($post_arr['data'], $post_item);

    }
    echo json_encode($post_arr);
}else{

    echo json_encode(array(
        'message' => 'No tasks found'
    ));
}

?>