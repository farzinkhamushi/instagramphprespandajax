<?php
require_once("config.php");
class Database
{
    public $connection;
    function __construct()
    {
        $this->open_db_connection();
    }
    public function open_db_connection()
    {
        //$this->connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        // if ($this->connection) {
        //     echo "true";
        // }
        //if (mysqli_connect_errno()) {
        if ($this->connection->connect_errno) {
            die("Database connection failed badly" . mysqli_error($this->connection));
        }
    }
    public function query($sql)
    {
        return mysqli_query($this->connection, $sql);
    }
    private function confirm_query($result)
    {
        if (!$result) {
            die("Query failed");
        }
    }
    public function escape_string($string)
    {
        return $this->connection->real_escape_string($string);
        //return $string;
    }
    public function the_insert_id()
    {
        return mysqli_insert_id($this->connection);
    }
}
$db = new Database();
?>