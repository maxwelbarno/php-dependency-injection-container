<?php

use App\Controllers\UserController;
use App\Logger;

require_once __DIR__ . "/../vendor/autoload.php";

$logger = new Logger();
$controller = new UserController($logger);

echo $controller->index();
