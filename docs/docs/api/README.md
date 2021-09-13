# API

NextSMS is an interface that provides access to the NextSMS API service .

## Available Functions

## \_\_construct(?array $options, ?Client $httpClient = null)

## singleDestination(array $data)
Example

```php
use NextSMS\SDK\Client;
$client = new Client([
    'username' => 'YOUR_USERNAME',
    'password' => 'YOUR_PASSWORD',
    'enviroment' => 'testing', // or production
]);
$result = $client->singleDestination([
        'from' => 'NEXTSMS',
        'to' => '255716718040',
        'text' => 'Hello World',

    ]);
```

## multipleDestinations(array $data)
Example

```php
use NextSMS\SDK\Client;
$client = new Client([
    'username' => 'YOUR_USERNAME',
    'password' => 'YOUR_PASSWORD',
    'enviroment' => 'testing', // or production
]);
$result = $client->multipleDestinations([
        "from" => "NEXTSMS",
        "to" => ['255655912841', '255716718040'],
        "text" => "Your message",
    ]);
```


## multipleMessagesToMultipleDestinations(array $data)
Example

```php
use NextSMS\SDK\Client;
$client = new Client([
    'username' => 'YOUR_USERNAME',
    'password' => 'YOUR_PASSWORD',
    'enviroment' => 'testing', // or production
]);
$result = $client->multipleMessagesToMultipleDestinations( [
        'messages' => [
            ['from' => 'NEXTSMS', 'to' => '255716718040', 'text' => 'Your message'],
            ['from' => 'NEXTSMS', 'to' => '255655912841', 'text' => 'Your other message'],
        ],
    ]);
```


## multipleMessagesToMultipleDifferentDestinations($data)
Example

```php
use NextSMS\SDK\Client;
$client = new Client([
    'username' => 'YOUR_USERNAME',
    'password' => 'YOUR_PASSWORD',
    'enviroment' => 'testing', // or production
]);
$result = $client->multipleMessagesToMultipleDifferentDestinations([
        'messages' => [
            [
                'from' => 'NEXTSMS',
                'to' => ['255716718040', '255758483019'],
                'text' => 'Your message',
            ],
            [
                'from' => 'NEXTSMS',
                'to' => ['255758483019', '255655912841', '255716718040'],
                'text' => 'Your other message',
            ],
        ],
    ]);
```

## scheduleSms(array $data)
Example

```php
use NextSMS\SDK\Client;
$client = new Client([
    'username' => 'YOUR_USERNAME',
    'password' => 'YOUR_PASSWORD',
    'enviroment' => 'testing', // or production
]);
$result = $client->scheduleSms(  [
        'from' => 'SENDER',
        'to' => '255716718040',
        'text' => 'Your message',
        'date' => '2020-10-01',
        'time' => '12:00',
    ]);
```

## getDeliveryReports()
Example

```php
use NextSMS\SDK\Client;
$client = new Client([
    'username' => 'YOUR_USERNAME',
    'password' => 'YOUR_PASSWORD',
    'enviroment' => 'testing', // or production
]);
$result = $client->getDeliveryReports($data);
```


## getDeliveryReportsWithMessageId(int $messageId)
Example

```php
use NextSMS\SDK\Client;
$client = new Client([
    'username' => 'YOUR_USERNAME',
    'password' => 'YOUR_PASSWORD',
    'enviroment' => 'testing', // or production
]);
$result = $client->getDeliveryReportsWithMessageId("MESSAGE_ID");
```


## getDeliveryReportsWithSpecificDateRange(array $data)
Example

```php
use NextSMS\SDK\Client;
$client = new Client([
    'username' => 'YOUR_USERNAME',
    'password' => 'YOUR_PASSWORD',
    'enviroment' => 'testing', // or production
]);
$result = $client->getDeliveryReportsWithSpecificDateRange($data);
```

<!-- 
## getAllSentSmsLogs(array $data)
Example

```php
use NextSMS\SDK\Client;
$client = new Client([
    'username' => 'YOUR_USERNAME',
    'password' => 'YOUR_PASSWORD',
    'enviroment' => 'testing', // or production
]);
$result = $client->singleDestination($data);
```
## getAllSentSms(array $data)
Example

```php
use NextSMS\SDK\Client;
$client = new Client([
    'username' => 'YOUR_USERNAME',
    'password' => 'YOUR_PASSWORD',
    'enviroment' => 'testing', // or production
]);
$result = $client->singleDestination($data);
```
## registerSubCustomer(array $data)
Example

```php
use NextSMS\SDK\Client;
$client = new Client([
    'username' => 'YOUR_USERNAME',
    'password' => 'YOUR_PASSWORD',
    'enviroment' => 'testing', // or production
]);
$result = $client->singleDestination($data);
```
## rechargeCustomer(array $data)
Example

```php
use NextSMS\SDK\Client;
$client = new Client([
    'username' => 'YOUR_USERNAME',
    'password' => 'YOUR_PASSWORD',
    'enviroment' => 'testing', // or production
]);
$result = $client->singleDestination($data);
```
## deductCustomer(array $data)
Example

```php
use NextSMS\SDK\Client;
$client = new Client([
    'username' => 'YOUR_USERNAME',
    'password' => 'YOUR_PASSWORD',
    'enviroment' => 'testing', // or production
]);
$result = $client->singleDestination($data);
```
## getSmsBalance()
Example

```php

use NextSMS\SDK\Client;
$client = new Client([
    'username' => 'YOUR_USERNAME',
    'password' => 'YOUR_PASSWORD',
    'enviroment' => 'testing', // or production
]);
$result = $client->singleDestination($data);``` -->
