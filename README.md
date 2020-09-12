Simple cURL client
===============================================
The simple cURL client use the cURL PHP extension

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist efremovp/simple-curl "*"
```

or add

```
"efremovp/simple-curl": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
use efremovP\curl\Curl;

//example send POST request with empty headers
$url = 'https://api.example.com/login/';

$params = [
    'api_key' => 'sfq324fszdfasdf',
    'username' => 'test',
    'password' => 'sekret'
];
$result = Curl::send($url, [], $params);

//example send POST request with header
$url = 'https://api.example.com/login/'

$header = ['Authorization: Bearer sfq324fszdfasdf123456'];

$params = [
    'api_key' => 'sfq324fszdfasdf',
    'email' => 'example@example.com'
];

$result = Curl::send($url, $header, $params);

//example send GET request
$url = 'https://api.example.com/get/'

$result = Curl::send($url, [], null, 'get');
```