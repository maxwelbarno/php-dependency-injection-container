<?php

namespace App\Controllers;

use App\Attributes\Get;
use App\Attributes\Post;
use App\Attributes\Put;
use App\Interfaces\UserServiceInterface;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

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

    #[Get("/users/create")]
    public function create()
    {
        return \App\View::make('users/register');
    }

    #[Post("/users")]
    public function register()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $firstname = explode(' ', $name)[0];

        $text = <<<Body
        Hello $firstname, 
        Thank you for signing up!
        Body;

        $email = new Email();
        $email->from('support@example.com')->to($_POST['email'])->subject('Welcome')->text($text);

        $dsn = 'smtp://mailhog:1025';

        $transport = Transport::fromDsn($dsn);

        $mailer = new Mailer($transport);


        return \App\View::make('users/register');
    }
}
