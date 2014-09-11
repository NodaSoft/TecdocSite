<?php

namespace RestClient;

/**
 * Class RestClientInterface
 * @package RestClient
 */
interface RestClientInterface
{
    /**
     * function executeQuery
     * @param string $url
     * @param string $adapter
     * @param string $method
     * @param string $data
     * @return mixed
     */
    public function executeQuery($url, $adapter = 'curl', $method = 'GET', $data = '');

    /**
     * function getName
     * @return mixed
     */
    public function getName();
}
