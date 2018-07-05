<?php

namespace models;

use PDO;

class User extends Model
{
    private $conn;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->conn = parent::getDbConnection();
    }

    /**
     * Получить пользователя по логину
     * @param $login
     * @return mixed
     */
    public function getUserByLogin($login)
    {
        $stmt = $this->conn->prepare("select * from users where login = ?");
        $stmt->bindParam(1, $login);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        if ($_SESSION['logged_user']['isAdmin'] == 1) {
            return true;
        }
        return false;
    }
}