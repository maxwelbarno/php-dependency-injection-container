<?php

namespace App;

class Config
{
    protected array $config;
    public function __construct(array $env)
    {
        $this->config = [
            'db' => [
                'host' => $env['DB_HOST'],
                'driver' => $env['DB_DRIVER'] ?? 'mysql',
                'name' => $env['DB_NAME'],
                'user' => $env['DB_USER'],
                'password' => $env['DB_PASSWORD'],
                ]
        ];
    }

    public function __get(string $name)
    {
        return $this->config[$name] ?? null;
    }
}
