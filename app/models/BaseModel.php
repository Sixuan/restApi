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


    function __construct()
    {
        $dbConfig = GlobalConfig::getDatabaseConfig();
        try{
            $this->db = new \mysqli($dbConfig['mysql']['hostname'],$dbConfig['mysql']['user'],$dbConfig['mysql']['password'],$dbConfig['mysql']['databse']);
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


}