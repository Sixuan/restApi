<?php
/**
 * DeviceController takes scene photo from device and saves it into db
 * User: sixuan
 * Date: 8/29/15
 * Time: 1:33 PM
 */

namespace app\controllers;

use app\models\InfoModel;
use lib\ApiException;

class DeviceController extends BaseController{

    /**
     * @var InfoModel
     */
    private $infoModel = null;

    public function store($data) {
        try{
            $store = $this->getInfoModel()->storeDeviceScene($_FILES, $data);
            if(true == $store){
                $response = $this->buildResponse(self::STATUS_CODE_SUCCESS, array(), array());
            }else{
                $response = $this->buildResponse(self::STATUS_CODE_BAD_REQUEST, array(), array());
            }
        }catch (ApiException $e){
            $response = $this->buildResponse(self::STATUS_CODE_BAD_REQUEST, array('exception' => (string)$e), array());
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