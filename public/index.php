<?php

use App\App;
use App\Config;

require_once __DIR__ . "/../vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$config = new Config($_ENV);
$app = new App($config);
$app->run();
