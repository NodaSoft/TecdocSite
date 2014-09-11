PHP Rest Client
===
[![Build Status](https://travis-ci.org/Atriedes/rest-client.png?branch=master)](https://travis-ci.org/Atriedes/rest-client)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/801873ad-6136-48e1-8cd5-bed4d4fdd6c1/mini.png)](https://insight.sensiolabs.com/projects/801873ad-6136-48e1-8cd5-bed4d4fdd6c1)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/Atriedes/rest-client/badges/quality-score.png?s=54e6bdd4a59463c1d523a20a0668c60ddd6972a4)](https://scrutinizer-ci.com/g/Atriedes/rest-client/)

Simple cURL PHP Rest Client library for PHP 5.3+

### Feature
---
* Set `HTTP Authentication`
* Set `HTTP Header`
* `GET`, `POST`, `PUT`, `DELETE` Method

### Installation
---
This library can installed through [compose](http://getcomposer.org/)

```
$ php composer.phar require jowy/rest-client:@stable
```

### Usage
---

```php
<?php

include 'vendor/autoload.php';

use RestClient\CurlRestClient;

$curl = new CurlRestClient();

var_dump($curl->executeQuery('http://www.google.com'));

// OR....

$curl = new CurlRestClient('http://www.google.com',
    array( // Header data
        'X-API-KEY: 16251821972',
        'OUTPUT: JSON'
    ),
    array( // AUTH (curl)
        'CURLOPT_HTTPAUTH' =>  CURLAUTH_DIGEST,
        'username'  =>  'root',
        'password'  =>  'toor'
    )
);


```

### Parameter
---

* `url`describe target url
* `method` define HTTP method can be `GET`, `POST`, `PUT`, `DELETE`. Default value is `DELETE`
* `header` contain array list of header
* `data` contain array list of data
* `auth` contain array list of auth

Example fullset usage

```php
$curl->executeQuery('http://api.somewebsite.com',
    'POST',
    array(
        'X-API-KEY: 16251821972',
        'OUTPUT: JSON'
    ),
    array(
        'USERNAME' => 'jowy',
        'SERVERID'  => '192882'
    ),
    array(
        'CURLOPT_HTTPAUTH' => CURL_AUTH_DIGEST,
        'username'  =>  'jowy',
        'password'  =>  '123456'
    )
);

// OR USE CONVENIENT METHODS

// GET
$res = $curl->get('customer/details', array(
    'customerId' => 55
));

// POST
$res = $curl->post('customer', array(
    'name' => 'Ole Nordmann',
    'age' => 49,
    'address' => 'Stortingsveien 5',
    'zip' => '0120',
    'city' => 'Oslo'
));
```