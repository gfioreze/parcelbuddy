<?php
require_once('config/config.php');
class Database extends PDO {
    protected static $_dbInstance = null; // Static variable to hold the single instance of the database connection
    protected $_dbHandle; // Instance variable to hold the PDO handle

    public function __construct($username, $password, $host, $database) {
        try {
            $this->_dbHandle = new PDO("mysql:host=$host;dbname=$database", $username, $password); // Creates the database handle with connection info

        } catch (PDOException $e) { // Catch any failure to connect to the database and echo the error message
            echo $e->getMessage();
        }
    }

    public static function getInstance() {
        $username = DB_USERNAME;
        $password = DB_PASSWORD;
        $host = DB_HOST;
        $database = DB_DATABASE; // Variable referenced in constructor is $database?

        if (self::$_dbInstance === null) { // Checks if the PDO instance exists
            self::$_dbInstance = new self($username, $password, $host, $database); // Creates a new instance if not, sending in connection info
        }
        return self::$_dbInstance; // Returns the single instance of the database connection
    }

    public function getdbConnection() {
        return $this->_dbHandle; // Returns the PDO handle to be used elsewhere
    }

    public function __destruct() {
        $this->_dbHandle = null; // Destroys the PDO handle when no longer needed
    }
}
