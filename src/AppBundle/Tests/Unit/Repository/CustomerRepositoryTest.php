<?php

namespace AppBundle\Tests\Unit\Repository;

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

        $save = $this->customerRepository->save($customer);

        $this->assertInstanceOf(MongoDB\InsertOneResult::class, $save);
    }

    public function testFindAllCustomerInDatabase()
    {
        $result = $this->customerRepository->findAll();

        $this->assertInstanceOf(MongoDB\Driver\Cursor::class, $result);
    }

    public function testDeleteCustomerInDatabase()
    {
        $this->customerRepository->delete();

        $deleted = json_encode($this->customerRepository->findAll());

        $this->assertEquals('{}', $deleted);
    }
}