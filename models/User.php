<?php

namespace models;


use config\Database;

class User
{

    private $conn;
    /**
     * User constructor.
     */
    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }
}