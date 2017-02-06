<?php

namespace AppBundle\Service\Cache;

use AppBundle\Contracts\CacheServiceInterface;
use Predis;

class RedisCacheService implements CacheServiceInterface
{
    private $redis;

    public function __construct($host, $port, $prefix = 'tcp')
    {
        $this->redis = new Predis\Client($prefix . '://' . $host . ':' . $port);
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