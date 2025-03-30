<?php

namespace App\Controllers;

use App\Attributes\Get;
use App\Attributes\Post;
use App\Attributes\Put;
use App\Interfaces\UserServiceInterface;

class UserController
{
    public function __construct(private UserServiceInterface $userService)
    {
    }

    #[Get("/")]
    public function index()
    {
        return \App\View::make('index', ['users' => $this->userService->getUsers()]);
    }

    #[Post("/")]
    public function save()
    {
        echo "User saved";
    }

    #[Put("/")]
    public function update()
    {
        echo "User update";
    }
}
