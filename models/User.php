<?php

namespace models;


use config\Database;
use PDO;

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

    public function getUserByLogin($login)
    {
        $stmt = $this->conn->prepare("select * from users where login = ?");
        $stmt->bindParam(1, $login);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function isAdmin()
    {
        session_start();
        if ($_SESSION['logged_user']['isAdmin'] == 1) {
            return true;
        }
        return false;
    }
}