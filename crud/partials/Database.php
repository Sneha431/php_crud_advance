<?php
class Database {
    private $dbserver = "localhost";
    private $dbuser = "root";
    private $dbpassword = "root";
    private $dbname = "userdata";
    private $port="3307";
    protected $conn;

    // Constructor
    public function __construct()
    {
        try {
            // Setting DSN (Data Source Name) for the connection
            $dsn = "mysql:host={$this->dbserver}; port={$this->port};dbname={$this->dbname}; charset=utf8";
            $options = array(
                PDO::ATTR_PERSISTENT => true, // Correct option to make connection persistent
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // Add error mode for better error handling
            );
            $this->conn = new PDO($dsn, $this->dbuser, $this->dbpassword, $options);
           // echo "Connected";
        } catch (PDOException $e) {
            // Catch exception and display error message
            echo "Connection error: " . $e->getMessage();
        }
    }
}
?>