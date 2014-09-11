<?php

namespace RestClient;

/**
 * Class RestClient
 * @package RestClient
 */
abstract class RestClient implements RestClientInterface
{
    /**
     * function executeQuery
     * @param string $url
     * @param string $method
     * @param array $header
     * @param string $data
     * @return mixed
     */
    abstract public function executeQuery($url, $method = 'GET', $header = array(), $data = '');

    /**
     * function getName
     * @return mixed
     */
    abstract public function getName();
}
