<?php

namespace App\Controllers;

use App\Config;
use App\DB;
use App\Logger;

class UserController
{
    private DB $db;
    private Config $config;
    public function __construct(private Logger $logger)
    {
        $this->config = new Config();
        $this->db = new DB($this->config->db);
    }

    public function index()
    {

        return $this->logger->log("We are logged in");
    }

    public function getUsers()
    {
        $users = $this->db->query("SELECT * FROM users");
        foreach ($users as $user) {
            $this->logger->log('User: ' . $user['username'] . ' Password: ' . $user['password']);
        }
    }
}
