<?php

namespace models;


use config\Database;

class Model
{
    protected function getDbConnection()
    {
        $db = new Database();
        return $db->getConnection();
    }
}