<?php

namespace AppBundle\Contracts;

interface CustomerRepositoryInterface
{
    public function findAll();

    public function save(array $data);

    public function delete(array $data = []);
}