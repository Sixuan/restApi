<?php
/**
 * Created by PhpStorm.
 * User: sixuan
 * Date: 5/11/15
 * Time: 10:59 PM
 */

namespace app\lib\contracts;


interface ResponseInterface {
    public function getCode();
    public function getResponse();
}