<?php

namespace App\Commands;

use App\Database\DB;

class Command
{
    private $argv;

    public function __construct($argv)
    {
        $this->argv = $argv;
    }

    public function __invoke(): void
    {
        echo "Running...\n";

        require_once dirname(__DIR__) . '/boot.php';

        if (count($this->argv) < 2) {
            echo "Usage: php run.php db:create or db:load\n";
            exit(1);
        }

        $action = $this->argv[1];

        if (!in_array($action, ['db:create', 'db:load'])) {
            echo "Usage: php run.php db:create or db:load\n";
            exit(1);
        }

        $database = new DB();

        match ($action) {
            'db:create' => $database->create(),
            'db:load' => $database->load(),
            default => "Usage: php run.php db:create or db:load\n",
        };
    }
}

$command = new Command($argv);
$command();