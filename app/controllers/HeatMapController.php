<?php
/**
 * Created by PhpStorm.
 * User: sixuan
 * Date: 8/22/15
 * Time: 12:11 AM
 */

namespace app\controllers;

use app\models\InfoModel;

class HeatMapController extends BaseController{

    /**
     * @var InfoModel
     */
    private $infoModel = null;

    public function get() {

        if(!isset($_GET['timestamp'])){
            $response = $this->buildResponse(self::STATUS_CODE_BAD_REQUEST, array(), array());

        }else{
            $time = $_GET['timestamp'];
            $company_id = isset($_GET['company_id']) ? $_GET['company_id'] : 1;
            $heat_map = $this->getInfoModel()->getHeatMap($company_id, $time);
            $response = $this->buildResponse(self::STATUS_CODE_SUCCESS, array(), $heat_map);
        }
        return $response;
    }

    /**
     * @return InfoModel
     */
    private function getInfoModel() {
        if($this->infoModel == null){
            $this->infoModel = new InfoModel();
        }
        return $this->infoModel;
    }

}