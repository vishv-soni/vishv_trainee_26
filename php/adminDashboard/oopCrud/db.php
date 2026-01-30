<?php
// include_once 'classes/Register.php';

define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', 'admin123');
define('DBNAME', 'oopCrud');

class db
{
    public $host = HOST;
    public $user = USER;
    public $password = PASSWORD;
    public $dbname = DBNAME;

    public $conn;
    public $error;

    public function __construct()
    {
        $this->dbConnect();
    }

    public function dbConnect()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);
        if (!$this->conn) {
            $this->error = "Connection failed: " . $this->conn->connect_error;
            return false;
        }
    }

    //Insert Query
    public function insert($query)
    {
        $result = mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    //Select Query
    public function select($query)
    {
        $result = mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));

        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

}
