<?php
/**
 * Created by PhpStorm.
 * User: sixuan
 * Date: 5/11/15
 * Time: 10:17 PM
 */

namespace app\controllers;
use app\lib\JsonResponse;

class BaseController {



    const STATUS_CODE_SUCCESS = 200;
    const STATUS_CODE_BAD_REQUEST = 400;
    const STATUS_CODE_NOT_AUTHORIZED = 401;
    const STATUS_CODE_METHOD_NOT_ALLOWED = 405;
    const STATUS_CODE_ERROR = 500;


    /**
     * @param $code
     * @param array $message
     * @param array $data
     * @return JsonResponse
     */
    protected function buildResponse($code, array $message, array $data) {
        if(sizeof($message) == 0 && $code == self::STATUS_CODE_SUCCESS){
            $status = 'request_success';

        }else{
            $status = 'request_failed';
        }
        return new JsonResponse($code, $status, $message, $data);
    }

}