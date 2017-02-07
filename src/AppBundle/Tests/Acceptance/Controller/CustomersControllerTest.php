<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Tests\TestAppCaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CustomersControllerTest extends WebTestCase
{
    protected $client;

    use TestAppCaseTrait;

    public function setUp()
    {
        $this->client = static::createClient();
        $this->client->followRedirects();
    }

    public function testCreateCustomers()
    {
        $customers = [
            ['name' => 'Leandro', 'age' => 26],
            ['name' => 'Marcelo', 'age' => 30],
            ['name' => 'Alex', 'age' => 18],
        ];
        $customers = json_encode($customers);

        $this->post('/customers/', $customers);

        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function testDeleteCustomers()
    {
        $this->delete('/customers/');

        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function testReturnCustomers()
    {
        
    }
}
