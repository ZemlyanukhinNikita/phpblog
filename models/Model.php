<?php

namespace models;


use config\Database;


class Model
{
    /**
     * Метод получения соединения к бд
     * @return null|\PDO
     */
    protected function getDbConnection()
    {
        $db = new Database();
        return $db->getConnection();
    }
}