<?php
/**
 * Created by PhpStorm.
 * User: sixuan
 * Date: 5/10/15
 * Time: 9:25 PM
 */

namespace app\controllers;

class BaseController {

    const STATUS_CODE_SUCCESS = 200;
    const STATUS_CODE_BAD_REQUEST = 400;
    const STATUS_CODE_NOT_AUTHORIZED = 401;
    const STATUS_CODE_METHOD_NOT_ALLOWED = 405;
    const STATUS_CODE_ERROR = 500;
}