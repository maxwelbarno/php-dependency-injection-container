<?php

require_once __DIR__ . "/../../vendor/autoload.php";


$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__ . "/../../.."));
$dotenv->load();

$container = new \App\Container();
$router = new \App\Router($container);
$router->registerRoutesFromControllerAttributes(
    [
    \App\Controllers\UserController::class,
    \App\Controllers\GeneratorController::class
    ]
);

echo "<pre>";
print_r($router->getRoutes());
echo "</pre>";


$config = new \App\Config($_ENV);
$request = ['uri' => $_SERVER['REQUEST_URI'],'method' => $_SERVER['REQUEST_METHOD']];
$app = new \App\App($container, $router, $request, $config);

$app->run();
