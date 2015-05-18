<?php

require_once 'vendor/autoload.php';
use app\lib\RequestFactory;

//Create Request
$request = RequestFactory::getInstance($_SERVER, RequestFactory::TYPE_JSON);
$controller = $request->getController();
$method = $request->getMethod();

//Render the controller
$controllerObj = new $controller();
//Execute the request
$response = $controllerObj->$method($request->getData());

?>
