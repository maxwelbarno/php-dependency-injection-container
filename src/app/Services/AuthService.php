<?php

namespace App\Services;

use App\Interfaces\UserServiceInterface;
use App\Logger;

class AuthService implements UserServiceInterface
{
    public function __construct(private Logger $logger, private DbService $dbService)
    {
    }

    public function getUsers()
    {
        return $this->dbService->fetchAll();
    }
}
