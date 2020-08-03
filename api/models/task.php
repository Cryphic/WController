<?php



class Task{

    private $conn;
    private $table = 'tasks';



    public function __construct($db){
        $this->conn = $db;
    }


    public $id;
    public $hostname;
    public $action;
    public $parameters;
    public $output;
    public $status;
    public $user_id;

    public function read($nmb){

        $query = "SELECT * FROM ". $this->table ." where user_id = :userid";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(':userid', $nmb, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    public function update($nmb) {
        $query = "UPDATE tasks SET output = :output, status = :status WHERE user_id = :userid AND id = :id";

        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->output = htmlspecialchars(strip_tags($this->output));
        $this->status = htmlspecialchars(strip_tags($this->status));

        $stmt->bindParam(':id', $this->id, PDO::PARAM_STR);
        $stmt->bindParam(':userid', $nmb, PDO::PARAM_STR);
        $stmt->bindParam(':output', $this->output, PDO::PARAM_STR);
        $stmt->bindParam(':status', $this->status, PDO::PARAM_STR);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>