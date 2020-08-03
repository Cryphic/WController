<?php
// Include db config


class Task{
    // database connection and table name
    private $conn;
    private $table = 'tasks';


    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // object properties
    public $id;
    public $hostname;
    public $action;
    public $parameters;
    public $user_id;

    public function read($nmb){

        $query = "SELECT * FROM ". $this->table ." where user_id = :userid";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(':userid', $nmb, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}
?>