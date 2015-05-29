<?php
/**
 * Created by PhpStorm.
 * User: sixuan
 * Date: 5/11/15
 * Time: 11:00 PM
 */

namespace app\lib;
use app\lib\contracts\ResponseInterface;
require_once 'app/lib/contracts/ResponseInterface.php';

class JsonResponse implements \JsonSerializable, ResponseInterface{


    /**
     * @var int
     */
    private $code;

    /**
     * @var string
     */
    private $status;
    /**
     * @var array
     */
    private $message;

    /**
     * @var array
     */
    private $data;

    function __construct($code, $status, array $message, array $data)
    {
        $this->code = $code;
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return array
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    function jsonSerialize()
    {
        return array(
            'code' => $this->code,
            'status'    => $this->status,
            'message'   => $this->message,
            'data'  => $this->data
        );
    }


}