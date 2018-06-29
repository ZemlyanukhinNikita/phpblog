<?php

namespace config;

use PDO;
use PDOException;

class Database
{

    protected $db;

    public function __construct()
    {

        require 'config.php';

        $conn = null;

        $host = $connection['host'];
        $username = $connection['username'];
        $password = $connection['password'];
        $dbname = $connection['dbname'];
        $dsn = "mysql:host=$host;dbname=$dbname";

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