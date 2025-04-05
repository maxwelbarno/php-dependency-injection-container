<?php

namespace App\Controllers;

use App\Attributes\Route;

class GeneratorController
{
    #[Route("/generators")]
    public function index()
    {
        echo "Hello from Generator Controller!";
    }
}
