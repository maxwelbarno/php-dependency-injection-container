<?php

namespace App;

use App\Controllers\UserController;
use App\Services\DbService;
use App\Services\UserService;

class App
{
    public static Container $container;

    public function __construct(private Config $config)
    {
        static::$container = new Container();
        static::$container->set(Logger::class, fn()=>new Logger());

        static::$container->set(Config::class, function () {
            return $this->config;
        });

        static::$container->set(DB::class, function () {
            return new DB($this->config->db);
        });

        static::$container->set(DbService::class, function (Container $c) {
            $db = $c->get(DB::class);
            return new DbService($db);
        });

        static::$container->set(UserService::class, function (Container $c) {
            $logger = $c->get(Logger::class);
            $dbService = $c->get(DbService::class);
            return new UserService($logger, $dbService);
        });
    }

    public function run()
    {
        $controller = static::$container->get(UserController::class);
        echo $controller->index();
    }
}
