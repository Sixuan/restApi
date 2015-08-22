<?php
/**
 * Created by PhpStorm.
 * User: sixuan
 * Date: 8/21/15
 * Time: 12:09 AM
 */

namespace lib;

use \Exception;

class ApiException extends \Exception{

    /**
     * @var array
     */
    private $context;

    public function __construct($message, array $context, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return array
     */
    public function getContext()
    {
        return $this->context;
    }

    function __toString()
    {
        return "ApiException context: ".json_encode($this->context).
        parent::__toString();
    }


}