<?php
// File: dbmsql_w.php

class dbmsql {
    protected $mysqli;
    protected $showerror = FALSE;
    protected $showsql = FALSE;
    protected $sqlcounter = 0;
    protected $rowcounter = 0;
    protected $dbtime = 0;
    protected $starttime;
    static private $dbInstance;

    public static function getInstance() {
        if (empty(self::$dbInstance))
            self::$dbInstance = new self;
        return self::$dbInstance;
    }

    // Prevent cloning
    private function __clone() { }

    // Constructor
    function __construct() {
//        $basedir = dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . Config/password_w.php';
        require 'config/password.php';
        $this->mysqli = new mysqli($server, $user, $password, $db);
        $this->mysqli->set_charset("utf8");

        if (mysqli_connect_errno()) {
            $this->printerror("Sorry, no connection! (" . mysqli_connect_error() . ")");
            $this->mysqli = FALSE;
            exit();
        }
    }
    public function getLastInsertId() {
    return $this->mysqli->insert_id;  // Returns the ID of the last inserted record
}

    // Execute a SELECT query using prepared statements
    function queryObjectArray($sql, $params = []) {
        $this->sqlcounter++;
        $this->printsql($sql);

        $stmt = $this->mysqli->prepare($sql);
        if ($stmt === false) {
            $this->printerror("Prepare failed: (" . $this->mysqli->errno . ") " . $this->mysqli->error);
            return false;
        }

        // If there are parameters, bind them
        if (!empty($params)) {
            $types = str_repeat('s', count($params)); // assuming all params are strings for simplicity
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $objects = [];
        while ($row = $result->fetch_object()) {
            $objects[] = $row;
        }

        $stmt->close();
        return $objects;
    }

    // Execute an INSERT/UPDATE/DELETE query using prepared statements
    function executeQuery($sql, $params = []) {
        $this->sqlcounter++;
        $this->printsql($sql);

        $stmt = $this->mysqli->prepare($sql);
        if ($stmt === false) {
            $this->printerror("Prepare failed: (" . $this->mysqli->errno . ") " . $this->mysqli->error);
            return false;
        }

        if (!empty($params)) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $affected_rows = $stmt->affected_rows;
        $stmt->close();

        return $affected_rows;
    }

    // Error handling method
    private function printerror($error) {
        if ($this->showerror) {
            echo "<p><b>Error:</b> $error</p>";
        }
    }
    // Function to fetch a single row as an object
    public function queryObject($sql, $params = []) {
        $stmt = $this->mysqli->prepare($sql);
        if ($stmt === false) {
            // Handle prepare error
            $this->printerror("Prepare failed: (" . $this->mysqli->errno . ") " . $this->mysqli->error);
            return false;
        }

        if (!empty($params)) {
            $types = str_repeat('s', count($params)); // Assuming all params are strings
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        
        // Fetch a single row as an object
        $object = $result->fetch_object();

        $stmt->close();

        return $object;  // Return the single object (or null if no result)
    }

    // Debugging method for SQL statements
    private function printsql($sql) {
        if ($this->showsql) {
            echo "<p><b>SQL:</b> $sql</p>";
        }
    }

    // Other utility methods can be added here
    
}
// END of Class
$db = dbmsql::getInstance();
/////////////////////////////////////
