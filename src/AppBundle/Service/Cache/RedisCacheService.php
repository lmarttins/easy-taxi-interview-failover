<?php

namespace AppBundle\Service\Cache;

use AppBundle\Contracts\CacheServiceInterface;
use Predis;
use AppBundle\Exception\CacheFailOverException;
use Predis\Connection\ConnectionException;

class RedisCacheService implements CacheServiceInterface
{
    /**
     * @var Predis\Client
     */
    private $redis;

    public function __construct($host, $port, $prefix = 'tcp')
    {
        $this->redis = new Predis\Client($prefix . '://' . $host . ':' . $port);
    }

    public function set($key, $value)
    {
        try {
            $this->redis->set($key, $value);
        } catch (ConnectionException $e) {
            throw new CacheFailOverException($e->getMessage());
        }
    }

    public function get($key)
    {
        try {
            return $this->redis->get($key);
        } catch (ConnectionException $e) {
            throw new CacheFailOverException($e->getMessage());
        }
    }

    public function del(array $keys = [])
    {
        try {
            $this->redis->del($keys);
        } catch (ConnectionException $e) {
            throw new CacheFailOverException($e->getMessage());
        }
    }
}