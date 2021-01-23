# NextSMS for PHP


## Usage

### Quick Examples

```php

require 'vendor/autoload.php';

use NextSMS\SDK\Client;

// Intiate with credentials
$client = new Client([
            'api_key' => 'YOUR_API_KEY',
            'public_key' => 'PUBLIC_KEY',
            'client_options' => [],
        ]);

// Setup the transaction
$data = [
    'from'  => 'NEXTSMS',
    'to'    => '2557123456789',
    'text'  => 'Hello World',
];

// Execute
$result = $client->send_single($data);

// Print results
var_dump($result);

```

<!-- For more example check [client-demo-example](https://github.com/NextSMS/php-client/tree/develop/examples). -->

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
