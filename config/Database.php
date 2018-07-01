<?php

namespace config;

use PDO;
use PDOException;

class Database
{

    protected $db;

    public function __construct()
    {

        require_once 'config.php';

        $conn = null;

        $host = $connection['host'];
        $username = $connection['username'];
        $password = $connection['password'];
        $dbname = $connection['dbname'];
        $charset = $connection['charset'];
        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

        try {
            $conn = new PDO($dsn, $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            //todo wrote logs to log file
            echo 'ERROR: ' . $e->getMessage();
        }
        $this->db = $conn;
    }

    public function getConnection()
    {
        return $this->db;
    }

}