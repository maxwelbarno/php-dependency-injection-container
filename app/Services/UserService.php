<?php

namespace App\Services;

use App\Logger;

class UserService implements UserServiceInterface
{
    public function __construct(private Logger $logger, private DbService $dbService)
    {
    }

    public function getUsers()
    {
        $users = $this->dbService->fetchAll();
        foreach ($users as $user) {
            $this->logger->log('User: ' . $user['username'] . ' Password: ' . $user['password']);
        }
    }
}
