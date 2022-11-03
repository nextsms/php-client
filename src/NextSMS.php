<?php

declare(strict_types=1);

namespace Nextsms\Nextsms;

use GuzzleHttp\Client as GuzzleClient;

/**

 * @package Nextsms\Nextsms
 * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#intro}
 *
 * @version 1.0.0
 * @author Alpha Olomi <alphaolomi@gmail.com>
 */
class Nextsms
{
    protected array $options;

    protected Client $client;

    /**
     * NextSMS constructor.
     * @param array $options
     * @param Client|null $httpClient
     * @throws InvalidArgumentException
     */
    public function __construct(array $options = [], ?GuzzleClient $httpClient = null)
    {
        foreach (['username', 'password', 'sender'] as $requiredOption) {
            if (! isset($options[$requiredOption])) {
                throw new \InvalidArgumentException(sprintf('The "%s" option must be set.', $requiredOption));
            }
        }

        if (! array_key_exists('environment', $options)) {
            $options['environment'] = 'testing';
        }

        $this->options = $options;
        $this->httpClient = Client::create($options, $httpClient);
    }
}
