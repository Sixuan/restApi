<?php

require_once 'vendor/autoload.php';
use app\lib\RequestFactory;


$controller =  new \app\controllers\InfoController();
$controller->get();



$request = RequestFactory::getInstance($_SERVER, RequestFactory::TYPE_JSON);


?>
