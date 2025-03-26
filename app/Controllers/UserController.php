<?php

namespace App\Controllers;

use App\DB;
use App\Logger;

class UserController
{
    public function __construct(private Logger $logger, private DB $db)
    {
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
