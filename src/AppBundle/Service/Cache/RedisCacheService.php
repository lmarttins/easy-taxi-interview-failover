<?php

namespace AppBundle\Service\Cache;

use AppBundle\Contracts\CacheServiceInterface;
use AppBundle\Exception\CacheFailOverException;
use Predis;

class RedisCacheService implements CacheServiceInterface
{
    private $redis;

    public function __construct($host, $port, $prefix = 'tcp')
    {
        try {
            $this->redis = new Predis\Client($prefix . '://' . $host . ':' . $port);
        } catch (\Exception $e) {
            throw new CacheFailOverException($e->getMessage());
        }
    }

    public function set($key, $value)
    {
        $this->redis->set($key, $value);
    }

    public function get($key)
    {
        return $this->redis->get($key);
    }

    public function del(array $keys = [])
    {
        $this->redis->del($keys);
    }
}