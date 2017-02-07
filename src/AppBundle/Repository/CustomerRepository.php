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

    public function save($data)
    {
        return $this->database->customers->insertOne($data);
    }

    public function delete(array $data = [])
    {
        return $this->database->customers->drop();
    }
}