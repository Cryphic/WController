<?php
//Database information
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'pass');
define('DB_NAME', 'Paneeli');

class DatabaseConnect {
    private $pdo;

    public function getPdo(){
        return $this->pdo;
    }

    public function __construct(){
        try {
            $this->pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
        } catch(PDOException $e) {
            die("ERROR: Could not connect. " . $e->getMessage());
        }
    }

}

