<?php
/**
 * Created by PhpStorm.
 * User: sixuan
 * Date: 5/11/15
 * Time: 11:00 PM
 */

namespace app\lib;


use app\lib\contracts\ResponseInterface;

class JsonResponse implements ResponseInterface{

    private $code;

    private $message;

    public function getCode()
    {
        // TODO: Implement getCode() method.
    }

    public function getResponse()
    {
        // TODO: Implement getResponse() method.
    }

}