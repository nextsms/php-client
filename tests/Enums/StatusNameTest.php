<?php

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Nextsms\Nextsms\Enums\StatusName;

test('tests/Enums/Status Name Test php', function () {
    //     $mock = new MockHandler([
    //         new Response(200, [
    //             'data' => [
    //                 'text' => 'Hello World',
    //                 'to' => '255714000000',
    //                 'from' => 'NextSMS',
    //             ],
    //         ], 'Hello, World'),
    //         new Response(200, [
    //             'data' => [
    //                 'text' => 'Hello World',
    //                 'to' => '255714000000',
    //                 'from' => 'NextSMS',
    //             ],
    //         ], 'Hello, World'),
    //     ]);

    //     $handlerStack = HandlerStack::create($mock);

    // //    $response = $client->request('GET', '/');
    // //    echo $response->getStatusCode();

    //     $http = new GuzzleClient([
    //         'handler' => $handlerStack,
    //         'base_uri' => 'https://messaging-service.co.tz/api/',
    //         'auth' => ['username', 'password'],
    //         'headers' => [
    //             'Accept' => 'application/json',
    //             'Content-Type' => 'application/json',
    //         ],
    //     ]);

    //     $client = new \Nextsms\Nextsms\Nextsms([
    //         'username' => 'username',
    //         'password' => 'password',
    //         'senderId' => 'NextSMS',
    //     ], $http);

    //     $message = \Nextsms\Nextsms\ValueObjects\Message::make([
    //         'text' => 'Hello World',
    //         'to' => '255714000000',
    //         'from' => 'NextSMS',
    //     ]);

    //     $response = $client->messages()->send($message);

    //     expect($response)->toBeArray();

    //    $this->assertEquals(GroupName::PENDING_WAITING_DELIVERY, $response->status()->group()->name());
    //    $this->assertEquals(GroupName::PENDING_ENROUTE, $response->status()->group()->name());
    //    $this->assertEquals(GroupName::PENDING_ACCEPTED, $response->status()->group()->name());

    $value = StatusName::REJECTED_NETWORK;
    expect($value->message())->toBeString();
    expect($value->code())->toBeNumeric();
});
