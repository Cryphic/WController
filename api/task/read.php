<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once '../../config/database.php';
include_once '../models/task.php';

// Init session
session_start();

// Validate login
if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
    header('location: ../../login.php');
    exit;
}

$databaseConnect = new DatabaseConnect();
$pdo = $databaseConnect->getPdo();


$task = new Task($pdo);

//task query
$result = $task->read($_SESSION['id']);

//get row count
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
            'user_id' => $user_id
        );
        array_push($post_arr['data'], $post_item);

    }
    echo json_encode($post_arr);
}else{
    //No post
    echo json_encode(array(
        'message' => 'No tasks found'
    ));
}

?>