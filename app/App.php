<?php

namespace App;

class App
{
    private DB $db;
    public function __construct(private Config $config)
    {
        $this->db = new DB($config->db);
    }
    public function run()
    {
        $logger = new Logger();
        $controller = new \App\Controllers\UserController($logger, $this->db);

        echo $controller->getUsers();
    }
}
