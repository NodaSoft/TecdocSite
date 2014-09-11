<?php

namespace Test\RestClient;

use RestClient\CurlRestClient;

/**
 * Class CurlRestClientTest
 * @package Test\RestClient
 */
class CurlRestClientTest extends \PHPUnit_Framework_TestCase
{
    protected $curl;

    protected function setUp()
    {
        $this->curl = new CurlRestClient();
    }

    public function testGetWebsite()
    {
        $this->assertEquals('<!doctype html>', substr($this->curl->executeQuery('http://www.google.com'), 0, 15));
    }

    public function testGetName()
    {
        $this->assertEquals('curl', $this->curl->getName());
    }
}
