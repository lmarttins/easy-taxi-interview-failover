<?php

namespace AppBundle\Tests\Unit\Service\Cache;

use AppBundle\Service\Cache\RedisCacheService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RedisCacheServiceTest extends KernelTestCase
{
    private $redis;

    public function setUp()
    {
        /**
         * Escape the test when the cache server is shut down.
         * The tests have to pass, because now the database is accessed.'
         */
        /*$this->markTestSkipped(
            'Escaped to be able to test cache fail over.'
        );*/

        $this->redis = new RedisCacheService('127.0.0.1', '6379', 'tcp');
    }

    public function testSetKey()
    {
        $this->redis->set('foo', 'bar');

        $this->assertEquals('bar', $this->redis->get('foo'));
    }

    public function testGetKey()
    {
        $this->assertEquals('bar', $this->redis->get('foo'));
    }

    public function testDelKey()
    {
        $this->redis->del(['foo']);

        $this->assertNull($this->redis->get('foo'));
    }
}