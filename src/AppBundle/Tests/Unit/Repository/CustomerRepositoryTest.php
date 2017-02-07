<?php

namespace AppBundle\Tests;

use AppBundle\Repository\CustomerRepository;
use AppBundle\Service\DatabaseService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use MongoDB;

class CustomerRepositoryTest extends KernelTestCase
{
    private $customerRepository;

    public function setUp()
    {
        $this->customerRepository = new CustomerRepository(
            new DatabaseService('127.0.0.1', '27017', 'easytaxi-symfony-cache-test')
        );
    }

    public function testCreateCustomerInDatabase()
    {
        $customer = ['name' => 'Leandro', 'age' => 31];

        $this->assertInstanceOf(MongoDB\InsertOneResult::class, $this->customerRepository->save($customer));
    }

    public function testFindAllCustomerInDatabase()
    {
        $this->assertInstanceOf(MongoDB\Driver\Cursor::class, $this->customerRepository->findAll());
    }

    public function testDeleteCustomerInDatabase()
    {
        $this->customerRepository->delete();

        $this->assertEquals('{}', json_encode($this->customerRepository->findAll()));
    }
}