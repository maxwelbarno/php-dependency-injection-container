<?php

namespace App\Controllers;

use App\Services\UserService;
use App\Services\UserServiceInterface;

class UserController
{
    public function __construct(private UserServiceInterface $userService)
    {
    }

    public function index()
    {
        return $this->userService->getUsers();
    }
}
