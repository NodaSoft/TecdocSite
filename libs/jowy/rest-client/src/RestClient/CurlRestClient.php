<?php

namespace RestClient;

/**
 * Class CurlRestClient
 * @package RestClient
 */
class CurlRestClient extends RestClient
{
    /**
     * @var $url null
     */
    private $url;
    /**
     * @var $header array
     */
    private $header;
    /**
     * @var $auth array
     */
    private $auth;

    /**
     * @param null $url
     * @param array $header
     * @param array $auth
     */
    public function __construct($url = null, $header = array(), $auth = array())
    {
        $this->url = $url;
        $this->header = $header;
        $this->auth = $auth;
    }

    /**
     * function setHeader
     * @param array $header
     */
    public function setHeader($header)
    {
        $this->header = $header;
    }

    /**
     * function setAuth
     * @param array $auth
     */
    public function setAuth($auth)
    {
        $this->auth = $auth;
    }

    /**
     * function executeQuery
     * @param string $url
     * @param string $method
     * @param array $header
     * @param array $data
     * @param array $auth
     * @return mixed
     */
    public function executeQuery($url, $method = 'GET', $header = array(), $data = array(), $auth = array())
    {
        $curl = curl_init();

        if ($method == 'GET')
            $url = $url . '?' . http_build_query($data);

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        if (!empty($auth)) {
            curl_setopt($curl, CURLOPT_HTTPAUTH, $auth['CURLOPT_HTTPAUTH']);
            curl_setopt($curl, CURLOPT_USERPWD, $auth['username'] . ':' . $auth['password']);
        }

        if ($method == 'POST') {
            curl_setopt($curl, CURLOPT_POST, true);
            if (!empty($data)) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            } else {
                curl_setopt($curl, CURLOPT_POSTFIELDS, array());
            }
        } elseif ($method == 'PUT') {
            curl_setopt($curl, CURLOPT_PUT, true);
            if (!empty($data)) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            } else {
                curl_setopt($curl, CURLOPT_POSTFIELDS, array());
            }
        } elseif ($method == 'DELETE') {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            if (!empty($data)) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            } else {
                curl_setopt($curl, CURLOPT_POSTFIELDS, array());
            }
        }

        return curl_exec($curl);
    }

    /**
     * function call
     * @param string $method
     * @param string $segment
     * @param array $data
     * @return array
     */
    private function call($method, $segment, $data = array())
    {
        return $this->executeQuery($this->url . '/' . $segment, $method, $this->header, $data, $this->auth);
    }

    /**
     * function get
     * @param string $segment
     * @param array $data
     * @return array
     */
    public function get($segment, $data = array())
    {
        return $this->call('GET', $segment, $data);
    }

    /**
     * function post
     * @param string $segment
     * @param array $data
     * @return array
     */
    public function post($segment, $data)
    {
        return $this->call('POST', $segment, $data);
    }

    /**
     * function put
     * @param string $segment
     * @param array $data
     * @return array
     */
    public function put($segment, $data)
    {
        return $this->call('PUT', $segment, $data);
    }

    /**
     * function delete
     * @param string $segment
     * @param array $data
     * @return array
     */
    public function delete($segment, $data)
    {
        return $this->call('DELETE', $segment, $data);
    }

    /**
     * function getName
     * @return string
     */
    public function getName()
    {
        return 'curl';
    }
}
