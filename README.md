# Nextsms for PHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/nextsms/php-client.svg?style=flat-square)](https://packagist.org/packages/nextsms/php-client)
[![Tests](https://img.shields.io/github/actions/workflow/status/nextsms/php-client/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/nextsms/php-client/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/nextsms/php-client.svg?style=flat-square)](https://packagist.org/packages/nextsms/php-client)
The `Nextsms for PHP` makes it easy for developers to access Nextsms services in their PHP code, and build robust applications and software using services like Bulk SMS delivery, Sub customers, and more.

## Installation

You can install the package via composer:

```bash
composer require nextsms/php-client
```

## Usage

```php
require 'vendor/autoload.php';

use Nextsms\Nextsms;

$client = Nextsms::create(
    username: 'YOUR_USERNAME',
    password:  'YOUR_PASSWORD',
    from: 'NEXTSMS'
);

$helloMessage = $client->messages()->send([
    "to": '2557123456789',
    "text": 'Hello World', 
    // from is optional if you have set it in the constructor
]);
// Or
$message = Message::create(text: 'Hello World',to: '2557123456789');

$helloMessage = $client->messages()->send($message);

// Send Later
$messageScheduled = $client->messages()->sendLater(
    new Message(to: '2557123456789', text: 'Hello World'), 
    \DateTime::createFromFormat('Y-m-d', '2020-12-31')
);

// Send to many
$manyMessages = $client->messages()->sendMany(
    MessageCollection::create([
        Message::text(to: '2557123456789', text: 'Hello World'),
        Message::text(to: '2557123456789', text: 'Hello World'),
    ])
);
// Or
$manyMessages = $client->messages()->sendMany(
    MessageCollection::create([
        Message::text(to: '2557123456789', text: 'Hello World'),
        Message::text(to: [ '2557123456789', '2557123456789' ], text: 'Hello World'),
    ]);    
);

// Delivery reports
$allReports = $client->reports()->all();

// Query
$reports = $client->reports()
    ->query()
    // Using date string
    ->sentFrom(date: '01-01-2022')
    // Or using date object
    ->sentUntil(date: \DateTime::create('now'))
    ->get();

$report = $client->reports()->get($messageId);
// 

// Customer
$customer = Customer::create([
    "first_name" => "Api",
    "last_name" => "Customer",
    "username" => "api_customer",
    "email" => "apicust@customer.com",
    "phone_number" => "0738234339",
    "account_type" => "Sub Customer (Reseller)", 
    "sms_price" => 200
]);

// Create
$customer = $client->customers()->create($customer);

// Recharge
$recharge = $client->customers()->recharge($customer, 1000);

// Deduct
$deduct = $client->customers()->deduct($customer, 1100);

```

## Testing

Using [Pest framework](http://pestphp.com).

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](./.github/CONTRIBUTING.md) for details.


## Star this repository

If you enjoy this package, please star this repository to encourage further development.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Alpha Olomi](https://github.com/nextsms)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
