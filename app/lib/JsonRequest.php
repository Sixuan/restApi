<?php
/**
 * Created by PhpStorm.
 * User: sixuan
 * Date: 5/10/15
 * Time: 9:50 PM
 */

namespace app\lib;


class JsonRequest implements RequestInterface
{

    private $requestMethod;

    private $parameters;

    private $controller;

    private $method;
    
    private $requestArray;

    function __construct(array $requestArray)
    {
        $this->requestArray = $requestArray;
        
        if (isset($requestArray['REQUEST_URI'])) {
            $this->url_elements = explode('/', trim($requestArray['REQUEST_URI'], '/'));
            print_r($this->url_elements);
            $this->controller = $this->url_elements[1];
        }

        $this->requestMethod = strtoupper($requestArray['REQUEST_METHOD']);

        switch ($this->requestMethod) {
            case 'GET':
                $this->parameters = $_GET;
                $this->method = 'get';
                break;
            case 'POST':
                $this->parameters = $_POST;
                $this->method = 'store';
                break;
            case 'DELETE':
                $this->parameters = $_POST;
                $this->method = 'remove';
                break;
            case 'PUT':
                parse_str(file_get_contents('php://input'), $this->parameters);
                $this->method = 'update';
                break;
        }
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return array
     */
    public function getUrlElements()
    {
        return $this->url_elements;
    }

    /**
     * @return string
     */
    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    /**
     * @return mixed
     */
    public function getParameters()
    {
        return $this->parameters;
    }


}