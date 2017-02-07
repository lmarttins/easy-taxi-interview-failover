<?php

namespace AppBundle\Tests;

trait TestAppCaseTrait
{
    /**
     * @param $endpoint
     * @param array $payload
     * @param string $contentType
     *
     * @return mixed
     */
    public function get($endpoint, $payload = [], $contentType = 'application/json')
    {
        $this->client->request('GET', $endpoint, [], [], ['CONTENT_TYPE' => $contentType], $payload);
    }

    /**
     * @param string $endpoint
     * @param array  $payload
     * @param string $contentType
     */
    public function post($endpoint, $payload = [], $contentType = 'application/json')
    {
        $this->client->request('POST', $endpoint, [], [], ['CONTENT_TYPE' => $contentType], $payload);
    }

    /**
     * @param string $endpoint
     * @param string $contentType
     */
    public function delete($endpoint, $contentType = 'application/json')
    {
        $this->client->request('DELETE', $endpoint, [], [], ['CONTENT_TYPE' => $contentType], []);
    }
}