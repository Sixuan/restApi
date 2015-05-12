<?php
/**
 * Created by PhpStorm.
 * User: sixuan
 * Date: 5/11/15
 * Time: 10:20 PM
 */

namespace app\models;
use app\config\GlobalConfig;

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