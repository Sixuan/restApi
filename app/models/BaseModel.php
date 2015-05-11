<?php

namespace app\models;

abstract class BaseModel {

    protected $db;

    function __construct()
    {
        $dbConfig = GlobalConfig::getDatabaseConfig();
        $this->db = new PDO($dbConfig['mysql']['hostname'],
            $dbConfig['mysql']['user'],
            $dbConfig['mysql']['password']);
    }
}