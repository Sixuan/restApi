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

    /**
     * @var \mysqli
     */
    protected $db;

    /**
     * @var \MysqliDb
     */
    protected $sql;


    function __construct()
    {
        $dbConfig = GlobalConfig::getDatabaseConfig();
        try{
            //$this->db = new \mysqli($dbConfig['mysql']['hostname'],$dbConfig['mysql']['user'],$dbConfig['mysql']['password'],$dbConfig['mysql']['database']);
            $this->db = new \MysqliDb ($dbConfig['mysql']['hostname'], $dbConfig['mysql']['user'], $dbConfig['mysql']['password'], $dbConfig['mysql']['database']);
        }catch (\Exception $e){
            print (string)$e;
        }

    }

    /**
     * @return \mysqli
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @return \MysqliDb
     */
    public function getSql() {
        $dbConfig = GlobalConfig::getDatabaseConfig();
        if($this->sql == null){
            $this->sql = new \MysqliDb ($dbConfig['mysql']['hostname'], $dbConfig['mysql']['user'], $dbConfig['mysql']['password'], $dbConfig['mysql']['database']);
        }
        return $this->sql;
    }
}