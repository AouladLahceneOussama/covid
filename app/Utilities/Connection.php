<?php

namespace App\Utilities;

use MongoDB\Client;

class Connection
{
    public function __construct() {
        $this->db_host = $_ENV['DATABASE_HOST'];
        $this->db_port = $_ENV['DATABASE_PORT'];
        $this->db_name = $_ENV['DATABASE_NAME'];
        $this->db_user = $_ENV['DATABASE_USER'];
        $this->db_pass = $_ENV['DATABASE_PASSWORD'];
    }

    public function connection()
    {
        $client = new Client("mongodb://" . $this->db_host . ":" . $this->db_port);
        return $client->selectDatabase($this->db_name);
    }
}
