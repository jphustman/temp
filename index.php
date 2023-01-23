<?php
require __DIR__ . "/inc/bootstrap.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

function dieGracefully() {
    header("HTTP/2 404 Not Found");
    exit();
}

if (!isset($uri[1])) dieGracefully();

if ($_SERVER['REQUEST_METHOD'] == 'POST'
    && $_SERVER['HTTP_USER_AGENT'] !== 'PostmanRuntime/7.30.0') {
    // Postman is for testing
    // React Axios does not send as typical post variables
    // so we have to catch it through php://input
    $_REQUEST = json_decode(file_get_contents("php://input"), true);
}

require PROJECT_ROOT_PATH . "/Controller/Api/ConstController.php";
require PROJECT_ROOT_PATH . "/Controller/Api/AuthController.php";
require PROJECT_ROOT_PATH . "/Controller/Api/UserController.php";

switch ($uri[1]) {
    case "auth":
       $objController = new AuthController();;
       break;
    case "user";
        $objController = new UserController();
        break;
    default:
        dieGracefully();
}

$strMethodName = $uri[2] . 'Action';

// Set Constants
$objConstController = new ConstController();

// run request!
$objController->{$strMethodName}();

