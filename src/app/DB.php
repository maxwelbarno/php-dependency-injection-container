<?php

namespace App;

class DB
{
    private \Doctrine\DBAL\Connection $connection;
    public function __construct(array $config)
    {
        $this->connection = \Doctrine\DBAL\DriverManager::getConnection($config);
    }

    public function query($sql)
    {
        $result = $this->connection->executeQuery($sql);
        return $result->fetchAllAssociative();
    }

    public function __call(string $name, array $arguments)
    {
        return call_user_func_array([$this->connection, $name], $arguments);
    }
}
