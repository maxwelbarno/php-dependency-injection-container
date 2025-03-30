<?php

namespace App;

use App\Controllers\UserController;
use App\Interfaces\UserServiceInterface;
use App\Services\AuthService;
use App\Services\DbService;
use App\Services\UserService;

class App
{
    public function __construct(protected Container $container, private Config $config)
    {
        $this->container->set(Logger::class, fn()=>new Logger());
        $this->container->set(DB::class, fn()=> new DB($this->config->db));
        $this->container->set(Config::class, function () {
            return $this->config;
        });

        $this->container->set(DbService::class, function (Container $c) {
            $db = $c->get(DB::class);
            return new DbService($db);
        });

        $this->container->set(UserServiceInterface::class, AuthService::class);

        $this->container->set(UserService::class, function (Container $c) {
            $logger = $c->get(Logger::class);
            $dbService = $c->get(DbService::class);
            return new UserService($logger, $dbService);
        });
    }

    public function run()
    {
        $controller = $this->container->get(UserController::class);
        echo $controller->index();
    }
}
