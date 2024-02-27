<?php

class Database 
{

    private $dbHost = DB_HOST;
    private $dbUser = DB_USER;
    private $dbPass = DB_PASS;
    private $dbName = DB_NAME;

    private $connection;
    private $error;
    private $stmt;
    private $dbConnected = false;

    public function __construct() {

        // SETUP PDO connection
        $dsn = "mysql:host=". $this->dbHost. ";dbname=". $this->dbName;
        $option = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try {
            $this->connection = new PDO($dsn, $this->dbUser, $this->dbPass, $option);
            $this->dbConnected = true;
            // echo "Connected to database successfully" . PHP_EOL;
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            $this->dbConnected = false;
        }   
    }

    public function getError() {
        return $this->error;
    }

    public function isConnected() : bool {
        return $this->dbConnected;
    }

    // Prepare statement with query
    public function query($query) {
        $this->stmt = $this->connection->prepare($query);
    }

    // Execute prepare statement
    public function execute() {
        return $this->stmt->execute();
    }

    // Get the results as Array of Objects
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get record row count
    public function rowCount() {
        return $this->stmt->rowCount();
    }

    //get single record as object
    public function singleResult() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function bind($param, $value, $type=null) {
        if (is_null($type)) {
            switch(true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }
}
