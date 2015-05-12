<?php
/**
 * Created by PhpStorm.
 * User: sixuan
 * Date: 5/11/15
 * Time: 10:45 PM
 */

namespace app\lib;


use app\lib\contracts\RequestInterface;

class RequestFactory {

    const TYPE_JSON = 'json';
    const TYPE_OBJECT = 'object';

    /**
     * @param array $data
     * @param $type
     * @return RequestInterface
     */
    public static function getInstance(array $data, $type) {
        switch($type){
            case self::TYPE_OBJECT:
                return new ObjectRequest($data);
                break;
            case self::TYPE_JSON:
            default:
                return new JsonRequest($data);
                break;
        }
    }
}