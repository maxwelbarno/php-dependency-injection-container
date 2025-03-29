<?php

use App\App;
use App\Config;
use App\Container;

require_once __DIR__ . "/../vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$config = new Config($_ENV);
$container = new Container();
$app = new App($container, $config);
$app->run();
