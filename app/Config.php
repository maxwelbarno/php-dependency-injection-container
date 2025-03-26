<?php

namespace App;

class Config
{
    protected array $config;
    public function __construct()
    {
        $this->config = [
            'db' => [
                'host' => 'localhost',
                'driver' => 'mysql',
                'name' => 'auth',
                'user' => 'admin',
                'password' => 'admin123'
                ]
        ];
    }

    public function __get(string $name)
    {
        return $this->config[$name] ?? null;
    }
}
