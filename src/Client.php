<?php

declare(strict_types=1);

namespace Nextsms\Nextsms;

use GuzzleHttp\Client as GuzzleClient;

class Client
{
    public static function create(array $options, ?GuzzleClient $client = null)
    {
        if (($client instanceof GuzzleClient)) {
            return $client;
        }

        return  new GuzzleClient([
            'base_uri' => 'https://messaging-service.co.tz/api/',
            'auth' => [$options['username'], $options['password']],
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }
}
