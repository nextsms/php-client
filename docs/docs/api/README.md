# API

NextSMS is an interface that provides access to the NextSMS API service .

## Available Functions

## New NextSMS Instance

```php
new NextSMS(?array $options, ?Client $httpClient = null)
```

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
    'enviroment' => 'production',
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
    'enviroment' => 'production',
]);
$result = $client->getDeliveryReportsWithSpecificDateRange( [
    'sentSince' => '',
    'sentUntil' => '',
]);
```

## getAllSentSmsLogs(array $data)

Example

```php
use NextSMS\SDK\Client;
$client = new Client([
    'username' => 'YOUR_USERNAME',
    'password' => 'YOUR_PASSWORD',
    'enviroment' => 'production', 
]);
$result = $client->getAllSentSmsLogs([
    'from' =>'2020-02-01',
    'limit' =>'10',
    'offset' =>'10'
]);
```

## getAllSentSms(array $data)

Example

```php
use NextSMS\SDK\Client;
$client = new Client([
    'username' => 'YOUR_USERNAME',
    'password' => 'YOUR_PASSWORD',
    'enviroment' => 'production',
]);
$result = $client->getAllSentSms([
    'from' => 'NEXTSMS',
    'to' => '255716718040',
    'sentSince' => '2020-02-01',
    'sentUntil' => '2020-02-20'
]);
```

## registerSubCustomer(array $data)

Example

```php
use NextSMS\SDK\Client;
$client = new Client([
    'username' => 'YOUR_USERNAME',
    'password' => 'YOUR_PASSWORD',
    'enviroment' => 'production'
]);
$result = $client->registerSubCustomer([
    first_name => 'Api',
    last_name => 'Customer',
    username => 'apicust',
    email => 'apicust@customer.com',
    phone_number => '0738234339',
    account_type => 'Sub Customer (Reseller)',
    sms_price => 20,
]);
```

## rechargeCustomer(array $data)

Example

```php
use NextSMS\SDK\Client;
$client = new Client([
    'username' => 'YOUR_USERNAME',
    'password' => 'YOUR_PASSWORD',
    'enviroment' => 'production',
]);
$result = $client->rechargeCustomer([
    'email' => 'example@email.com',
    'smscount' => 5000
]);
```

## deductCustomer(array $data)

Example

```php
use NextSMS\SDK\Client;
$client = new Client([
    'username' => 'YOUR_USERNAME',
    'password' => 'YOUR_PASSWORD',
    'enviroment' => 'production',
]);
$result = $client->deductCustomer([
    'email' => 'example@email.com',
    'smscount' => 2000
]);
```

## getSmsBalance()

Example

```php

use NextSMS\SDK\Client;
$client = new Client([
    'username' => 'YOUR_USERNAME',
    'password' => 'YOUR_PASSWORD',
    'enviroment' => 'production',
]);
$result = $client->getSmsBalance();
```
