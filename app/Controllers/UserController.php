<?php

namespace App\Controllers;

use App\Interfaces\UserServiceInterface;

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
