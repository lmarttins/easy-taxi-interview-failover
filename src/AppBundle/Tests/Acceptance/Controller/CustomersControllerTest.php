<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Tests\TestAppCaseTrait;
use MongoDB\BSON\ObjectID;
use Symfony\Component\BrowserKit\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CustomersControllerTest extends WebTestCase
{
    use TestAppCaseTrait;

    /**
     * @var Client instance
     */
    protected $client;

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
            ['name' => 'Alex', 'age' => 18]
        ];

        $this->post('/customers/', json_encode($customers));

        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function testDeleteCustomers()
    {
        $this->delete('/customers/');

        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function testGetCustomers()
    {
        $customers = [
            ['_id' => '589a01fd3d6cfc4a01132475', 'name' => 'Leandro', 'age' => 26],
            ['_id' => '589a01fd3d6cfc4a01132476', 'name' => 'Marcelo', 'age' => 30],
            ['_id' => '589a01fd3d6cfc4a01132477', 'name' => 'Alex', 'age' => 18]
        ];

        $this->post('/customers/', json_encode($customers));

        $this->get('/customers/');

        $response = $this->client->getResponse();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals(json_encode($customers), $response->getContent());
    }
}
