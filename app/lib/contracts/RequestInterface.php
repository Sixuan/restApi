<?php
/**
 * Created by PhpStorm.
 * User: sixuan
 * Date: 5/11/15
 * Time: 10:47 PM
 */
namespace app\lib;

interface RequestInterface
{
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
}