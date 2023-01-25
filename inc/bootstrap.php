<?php
define("PROJECT_ROOT_PATH", __DIR__ . "/../");

// include Firebase JWT library
require_once PROJECT_ROOT_PATH . "inc/php-jwt/JWT.php";

// include PDO Configuration for Database Connection
require_once PROJECT_ROOT_PATH . "/inc/config.php";

// include the base controller file
require_once PROJECT_ROOT_PATH . "/Controller/BaseController.php";

// include factories
require_once PROJECT_ROOT_PATH . "/Controller/Factories/UserFactory.php";
require_once PROJECT_ROOT_PATH . "/Controller/Factories/UserRoleFactory.php";

// include the database models files
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
require_once PROJECT_ROOT_PATH . "/Model/User.php";
require_once PROJECT_ROOT_PATH . "/Model/Role.php";

