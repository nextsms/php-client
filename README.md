# Nextsms for PHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/nextsms/php-client.svg?style=flat-square)](https://packagist.org/packages/nextsms/php-client)
[![Tests](https://github.com/nextsms/php-client/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/nextsms/php-client/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/nextsms/php-client.svg?style=flat-square)](https://packagist.org/packages/nextsms/php-client)
[![Check & fix styling](https://github.com/nextsms/php-client/actions/workflows/php-cs-fixer.yml/badge.svg)](https://github.com/nextsms/php-client/actions/workflows/php-cs-fixer.yml)

The `Nextsms for PHP` makes it easy for developers to access Nextsms services in their PHP code, and build robust applications and software using services like Bulk SMS delivery, Sub customers, and more.

> **V2:** You are currently viewing the documentation for the NextSMS PHP SDK V2. If you are looking for the documentation for the V1 SDK, you can find it [here](#).


## Installation

> **Requirement:** PHP 8.0 or higher is required.

You can install the package via Composer:

```bash
composer require nextsms/php-client
```

## Usage

```php
require 'vendor/autoload.php';

use Nextsms\Nextsms;

$client = Nextsms::create(username: 'YOUR_USERNAME', password:  'YOUR_PASSWORD');

$helloMessage = $client->messages()->send([
    "to": '2557123456789',
    "text": 'Hello World',
]);
// Or
$message = Message::create(text: 'Hello World',to: '2557123456789');
$helloMessage = $client->messages()->send($message);

// Send Later
$messageSchduled = $client->messages()->sendLater(
    new Message(to: '2557123456789', text: 'Hello World'), 
    new DateTime('2021-01-01 12:00:00')
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
    ->sentUntill(date: \DateTime::create('now'))
    ->get();

$report = $client->reports()->get($messageId);
// 

// Customer
$customer = Customer::create([
    "first_name": "Api",
    "last_name": "Customer",
    "username": "apicust",
    "email": "apicust@customer.com",
    "phone_number": "0738234339",
    "account_type": "Sub Customer (Reseller)", 
    "sms_price": 200
]);

// Create
$customer = $client->customers()->create($customer);

// Recharge
$recharge = $client->customers()->recharge($customer, 1000);

// Deduct
$deduct = $client->customers()->deduct($customer, 1100);
```

## Testing

Using [Pest](http://pestphp.com).

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
