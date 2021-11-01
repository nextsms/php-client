# NextSMS for PHP

[![Check & fix styling](https://github.com/nextsms/php-client/actions/workflows/php-cs-fixer.yml/badge.svg)](https://github.com/nextsms/php-client/actions/workflows/php-cs-fixer.yml)
[![Psalm](https://github.com/nextsms/php-client/actions/workflows/psalm.yml/badge.svg)](https://github.com/nextsms/php-client/actions/workflows/psalm.yml)
[![Tests](https://github.com/nextsms/php-client/actions/workflows/run-tests.yml/badge.svg)](https://github.com/nextsms/php-client/actions/workflows/run-tests.yml)
[![Maintenance](https://img.shields.io/badge/Maintained%3F-yes-green.svg)](https://GitHub.com/Naereen/StrapDown.js/graphs/commit-activity)

The NextSMS SDK for PHP makes it easy for developers to access NextSMS Services in their PHP code, and build robust applications and software using services like Bulk SMS delivery, Sub customers, and more.

## For more see [documentation](https://nextsms-php.netlify.app/).

## Usage

### Quick Examples

```php
require 'vendor/autoload.php';

use NextSMS\SDK\Client;

// Intiate with credentials
$client = new Client([
    'username' => 'YOUR_USERNAME',
    'password' => 'YOUR_PASSWORD',
    'enviroment' => 'testing', // or production
]);

// Setup the transaction
$data = [
    'from'  => 'NEXTSMS',
    'to'    => '2557123456789',
    'text'  => 'Hello World',
];

// Execute
$result = $client->singleDestination($data);

// Print results
var_dump($result);
```



### Testing

```bash
composer test
```

## Opening Issues

If you have a feature requrest or you encounter a bug, please file an issue on [our issue tracker on GitHub](https://github.com/NextSMS/php-client/issues).

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please review our [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email [alphaolomi@gmail.com](mailto:alphaolomi@gmail.com) instead of using the issue tracker.

## Credits

-   [Alpha Olomi](https://github.com/alphaolomi)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
