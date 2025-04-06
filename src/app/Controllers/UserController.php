<?php

namespace App\Controllers;

use App\Attributes\Get;
use App\Attributes\Post;
use App\Attributes\Put;
use App\Interfaces\UserServiceInterface;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

class UserController
{
    public function __construct(private UserServiceInterface $userService, protected MailerInterface $mailer)
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
        $mail = $_POST['email'];
        $firstname = explode(' ', $name)[0];

        $html = <<<HTML
        <h1 style='text-align:center; color:blue;'>Welcome</h1>
        Hello $firstname, 
        <br/>
        Thank you for signing up!
        HTML;

        $email = new Email();
        $email->from('support@example.com')->to($mail)->subject('Welcome!')->html($html);
        $this->mailer->send($email);


        return \App\View::make('users/register');
    }
}
