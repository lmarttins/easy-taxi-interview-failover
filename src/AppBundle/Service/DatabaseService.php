<?php

namespace AppBundle\Service;

use \MongoDB;

class DatabaseService
{
    protected $database;

    public function __construct($host, $port, $database)
    {
        $mongoClient = new MongoDB\Client("mongodb://$host:$port/");

        $this->setDatabase(
            $mongoClient->selectDatabase($database)
        );
    }

    public function setDatabase(MongoDB\Database $database)
    {
        $this->database = $database;
    }

    public function getDatabase()
    {
        return $this->database;
    }
}
