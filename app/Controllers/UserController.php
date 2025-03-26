<?php

namespace App\Controllers;

use App\Logger;

class UserController
{
    public function __construct(private Logger $logger)
    {
    }

    public function index()
    {
        return $this->logger->log("We are logged in");
    }
}
