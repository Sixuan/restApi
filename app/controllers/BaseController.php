<?php
/**
 * Created by PhpStorm.
 * User: sixuan
 * Date: 5/11/15
 * Time: 10:17 PM
 */

namespace app\controllers;


class BaseController {



    const STATUS_CODE_SUCCESS = 200;
    const STATUS_CODE_BAD_REQUEST = 400;
    const STATUS_CODE_NOT_AUTHORIZED = 401;
    const STATUS_CODE_METHOD_NOT_ALLOWED = 405;
    const STATUS_CODE_ERROR = 500;

    protected function buildResponse($code, array $message) {

    }

}