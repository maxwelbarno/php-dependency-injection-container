<?php

namespace App\Services;

class DbService
{
    public function __construct(private \App\DB $db)
    {
    }

    public function fetchAll()
    {
        return $this->db->query("SELECT * FROM users");
    }
}
