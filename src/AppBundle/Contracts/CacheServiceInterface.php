<?php

namespace AppBundle\Contracts;

interface CacheServiceInterface
{
    public function set($key, $val);

    public function get($key);

    public function del($key);
}