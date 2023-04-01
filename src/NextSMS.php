<?php

declare(strict_types=1);

namespace Nextsms\Nextsms;

use GuzzleHttp\Client as GuzzleClient;

/**
 * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#intro}
 *
 * @version 1.0.0
 *
 * @author Alpha Olomi <alphaolomi@gmail.com>
 */
class Nextsms
{
    protected array $options;

    private GuzzleClient $httpClient;

    /**
     * NextSMS constructor.
     */
    public function __construct(array $options = [], ?GuzzleClient $httpClient = null)
    {
        foreach (['username', 'password', 'senderId'] as $requiredOption) {
            if (! isset($options[$requiredOption])) {
                throw new \InvalidArgumentException(sprintf('The "%s" option must be set.', $requiredOption));
            }
        }

        if (! array_key_exists('environment', $options)) {
            $options['environment'] = 'testing';
        }

        $this->options = $options;

        $this->httpClient = ($httpClient instanceof GuzzleClient) ? $httpClient : new GuzzleClient([
            'base_uri' => 'https://messaging-service.co.tz/api/',
            'auth' => [$options['username'], $options['password']],
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function messages(): Services\Messages
    {
        return new Services\Messages($this->httpClient, $this->options);
    }

    public function customers(): Services\Customers
    {
        return new Services\Customers($this->httpClient, $this->options);
    }

    public function reports(): Services\DeliveryReport
    {
        return new Services\DeliveryReport($this->httpClient, $this->options);
    }
}
