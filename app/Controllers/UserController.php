<?php

namespace App\Controllers;

use App\Services\UserService;

class UserController
{
    public function __construct(private UserService $userService)
    {
    }

    public function index()
    {
        return $this->userService->getUsers();
    }
}
