<?php

namespace AppBundle\Repository;

use AppBundle\Contracts\CustomerRepositoryInterface;
use AppBundle\Service\DatabaseService;

class CustomerRepository implements CustomerRepositoryInterface
{
    private $database;

    public function __construct(DatabaseService $database)
    {
        $this->database = $database->getDatabase();
    }

    public function findAll()
    {
        return $this->database->customers->find();
    }

    public function save(array $data)
    {
        $this->database->customers->insertOne($data);
    }

    public function delete(array $data = [])
    {
        $this->database->customers->drop();
    }
}