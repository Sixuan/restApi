<?php
/**
 * Created by PhpStorm.
 * User: sixuan
 * Date: 5/11/15
 * Time: 10:48 PM
 */

namespace app\lib;


class ObjectRequest implements RequestInterface{


    private $requestArray;


    function __construct(array $requestArray)
    {
        $this->requestArray = $requestArray;
    }


    /**
     * @return mixed
     */
    public function getController()
    {
        // TODO: Implement getController() method.
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        // TODO: Implement getMethod() method.
    }

    /**
     * @return array
     */
    public function getUrlElements()
    {
        // TODO: Implement getUrlElements() method.
    }

    /**
     * @return string
     */
    public function getRequestMethod()
    {
        // TODO: Implement getRequestMethod() method.
    }

    /**
     * @return mixed
     */
    public function getParameters()
    {
        // TODO: Implement getParameters() method.
    }

}