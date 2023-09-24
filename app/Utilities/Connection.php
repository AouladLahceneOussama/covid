<?php

namespace App\Utilities;

use MongoDB\Client;

class Connection
{
    private $db_host;
    private $db_port;
    private $db_name;
    private $db_user;
    private $db_pass;

    public function __construct(
        $db_host = "localhost",
        $db_port = "27017",
        $db_name = "",
        $db_user = "",
        $db_pass = ""
    ) {
        $this->db_host = $db_host;
        $this->db_port = $db_port;
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
    }

    public function connection()
    {
        $client = new Client("mongodb://" . $this->db_host . ":" . $this->db_port);
        return $client->selectDatabase($this->db_name);
    }
}
