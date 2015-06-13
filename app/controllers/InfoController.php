<?php
/**
 * Created by PhpStorm.
 * User: sixuan
 * Date: 5/11/15
 * Time: 10:17 PM
 */

namespace app\controllers;


use app\lib\contracts\ResponseInterface;
use app\lib\JsonResponse;
use app\models\InfoModel;

class InfoController extends BaseController{

    /**
     * @var InfoModel
     */
    private $infoModel = null;

    public function get() {

        echo "hello";
    }

    public function store($data) {

        $insert = $this->getInfoModel()->insertCountHeatmap($data);
        if(true == $insert){
            $response = $this->buildResponse(self::STATUS_CODE_SUCCESS, array(), array());
        }else{
            $response = $this->buildResponse(self::STATUS_CODE_BAD_REQUEST, array(), array());
        }

        return $response;
    }



    public function remove() {
        echo 'delete';
    }

    public function update() {
        echo 'put';
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