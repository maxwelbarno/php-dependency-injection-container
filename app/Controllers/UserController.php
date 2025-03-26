<?php

namespace App\Controllers;

use App\Logger;

class UserController
{
    // private $logger;
    public function __construct(private Logger $logger)
    {
        // $this->logger = $logger;
    }

    public function index()
    {
        return $this->logger->log("We are logged in");
    }
}
