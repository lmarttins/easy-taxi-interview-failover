<?php

namespace AppBundle\Service\Cache;

use AppBundle\Contracts\CacheServiceInterface;

class RedisCacheService implements CacheServiceInterface
{
    public function __construct($host, $port, $prefix = null)
    {

    }

    public function set($key, $val)
    {

    }

    public function get($key = 'EasyTaxi')
    {
        return $key;
    }

    public function del($key)
    {

    }
}