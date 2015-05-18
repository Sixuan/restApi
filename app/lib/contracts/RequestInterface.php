<?php
/**
 * Created by PhpStorm.
 * User: sixuan
 * Date: 5/11/15
 * Time: 11:16 PM
 */

namespace app\lib\contracts;


interface RequestInterface {
    /**
     * @return mixed
     */
    public function getController();

    /**
     * @return string
     */
    public function getMethod();

    /**
     * @return array
     */
    public function getUrlElements();

    /**
     * @return string
     */
    public function getRequestMethod();

    /**
     * @return mixed
     */
    public function getParameters();

    /**
     * @return mixed
     */
    public function getData();

}