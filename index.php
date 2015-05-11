<?php

require_once '/var/www/wikkitApi/app/controllers/InfoController.php';
print __DIR__;

die();
/*namespace app\test;
use app\lib\Request;
require_once 'vendor/autoload.php';
require_once 'app/contollers/InfoController.php';*/

//echo 'Welcome to wikkitApi!';


/*$request = new Request($_SERVER);

$controller = $request->getController();
$method = $request->getMethod();
print $controller;

die();

$class = "app\controllers\\".$controller;

$response = new $class;
$response->$method;*/

/*$controller =  new \app\controllers\InfoController();

$controller->get();*/



/*$request = new Request();
if (isset($_SERVER['PATH_INFO'])) {
    $request->url_elements = explode('/', trim($_SERVER['PATH_INFO'], '/'));
}
$request->method = strtoupper($_SERVER['REQUEST_METHOD']);
switch ($request->method) {
    case 'GET':
        $request->parameters = $_GET;
        break;
    case 'POST':
        $request->parameters = $_POST;
        break;
    case 'PUT':
        parse_str(file_get_contents('php://input'), $request->parameters);
        break;
}*/

?>
