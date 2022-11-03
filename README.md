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

$client = Nextsms::create(username:  'YOUR_USERNAME',password:  'YOUR_PASSWORD');

$message = $client->message()->send(new Message(
    to: '2557123456789',
    text: 'Hello World',
));

$message = $client->message()->sendLater(
    new Message(to: '2557123456789', text: 'Hello World'), 
    new DateTime('2021-01-01 12:00:00')
);


// Customer
$customer = new Customer::create([
    "first_name": "Api",
    "last_name": "Customer",
    "username": "apicust",
    "email": "apicust@customer.com",
    "phone_number": "0738234339",
    "account_type": "Sub Customer (Reseller)", 
    "sms_price": 20
]);

$customer = $client->customer()->create($customer);
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
