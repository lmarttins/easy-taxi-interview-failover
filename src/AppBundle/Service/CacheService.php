<?php

namespace AppBundle\Service;

use AppBundle\Contracts\CacheServiceInterface;
use Predis;

/**
* Here you have to implement a CacheService with the operations above.
* It should contain a failover, which means that if you cannot retrieve
* data you have to hit the Database.
**/
class CacheService
{
    /**
     * @var CacheServiceInterface
     */
    private $cacheService;
    
    public function __construct(CacheServiceInterface $cacheService)
    {
        $this->cacheService = $cacheService;
    }

    public function set($key, $value)
    {
        $this->cacheService->set($key, $value);
    }

    public function get($key)
    {
        return $this->cacheService->get($key);
    }

    public function del(array $keys = [])
    {
        $this->cacheService->del($keys);
    }
}
