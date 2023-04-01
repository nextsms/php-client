<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Nextsms\Nextsms\Nextsms;

beforeEach(function () {
    /** @var MockHandler */
    $this->mock = new MockHandler([]);

    /** @var HandlerStack */
    $this->handlerStack = HandlerStack::create($this->mock);

    /** @var Client */
    $httpClient = new Client(['handler' => $this->handlerStack]);

    /** @var Nextsms */
    $this->nextsms = new Nextsms([
        'username' => 'city', // Fixture::$username,
        'password' => 'newrise', // Fixture::$password,
        'senderId' => 'NEXTSMS',
    ], $httpClient);
});

it('can nextsmsInstantiable', function () {
    $this->assertInstanceOf(NextSms::class, $this->nextsms);
});

it('can nextsmsHasTheseAttributes', function () {
    $this->assertClassHasAttribute('options', get_class($this->nextsms));
    $this->assertClassHasAttribute('httpClient', get_class($this->nextsms));
});

it('can canSendSingleDestination', function () {
    $this->mock->reset();
    $this->mock->append(new Response(200, [], json_encode(['messages' => [
        [
            'to' => '255716718040',
            'status' => [
                'groupId' => 1,
                'groupName' => 'PENDING',
                'id' => 7,
                'name' => 'PENDING_ENROUTE',
                'description' => 'Message sent to next instance',
            ],
            'smsCount' => 1,
        ],
    ]])));

    $result = $this->nextsms->messages()->send([
        'from' => 'NEXTSMS',
        'to' => '255716718040',
        'text' => 'Hello World',
    ]);
    $this->assertArrayHasKey('messages', $result);
});

it('can sendMany ie Multiple destinations', function () {
    $this->mock->reset();
    $this->mock->append(new Response(200, [], json_encode(
        [
            'messages' => [
                [
                    'to' => '255655912841',
                    'status' => [
                        'groupId' => 1,
                        'groupName' => 'PENDING',
                        'id' => 7,
                        'name' => 'PENDING_ENROUTE',
                        'description' => 'Message sent to next instance',
                    ],
                    'smsCount' => 1,
                ],
                [
                    'to' => '255716718040',
                    'status' => [
                        'groupId' => 1,
                        'groupName' => 'PENDING',
                        'id' => 7,
                        'name' => 'PENDING_ENROUTE',
                        'description' => 'Message sent to next instance',
                    ],
                    'smsCount' => 1,
                ],
            ],
        ]
    )));

    $result = $this->nextsms->messages()->sendMany([
        'from' => 'NEXTSMS',
        'to' => ['255655912841', '255716718040'],
        'text' => 'Your message',
    ]);

    $this->assertArrayHasKey('messages', $result);
});

it('can send many ie Multiple messages to multiple destinations', function () {
    $this->mock->reset();
    $this->mock->append(new Response(200, [], json_encode(
        [
            'messages' => [
                [
                    'to' => '255716718040',
                    'status' => [
                        'groupId' => 1,
                        'groupName' => 'PENDING',
                        'id' => 7,
                        'name' => 'PENDING_ENROUTE',
                        'description' => 'Message sent to next instance',
                    ],
                    'smsCount' => 1,
                ],
                [
                    'to' => '255655912841',
                    'status' => [
                        'groupId' => 1,
                        'groupName' => 'PENDING',
                        'id' => 7,
                        'name' => 'PENDING_ENROUTE',
                        'description' => 'Message sent to next instance',
                    ],
                    'smsCount' => 1,
                ],
            ],
        ]
    )));

    $result = $this->nextsms->messages()->sendMany([
        'messages' => [
            ['from' => 'NEXTSMS', 'to' => '255716718040', 'text' => 'Your message'],
            ['from' => 'NEXTSMS', 'to' => '255655912841', 'text' => 'Your other message'],
        ],
    ]);

    $this->assertArrayHasKey('messages', $result);
});

it('can sendMany ie Multiple messages to multiple different destinations', function () {
    $this->markTestSkipped();

    $this->mock->reset();
    $this->mock->append(new Response(200, [], json_encode(
        [
            'messages' => [
                [
                    'to' => '255716718040',
                    'status' => [
                        'groupId' => 1,
                        'groupName' => 'PENDING',
                        'id' => 7,
                        'name' => 'PENDING_ENROUTE',
                        'description' => 'Message sent to next instance',
                    ],
                    'smsCount' => 1,
                ],
                [
                    'to' => '255758483019',
                    'status' => [
                        'groupId' => 1,
                        'groupName' => 'PENDING',
                        'id' => 7,
                        'name' => 'PENDING_ENROUTE',
                        'description' => 'Message sent to next instance',
                    ],
                    'smsCount' => 1,
                ],
                [
                    'to' => '255758483019',
                    'status' => [
                        'groupId' => 1,
                        'groupName' => 'PENDING',
                        'id' => 7,
                        'name' => 'PENDING_ENROUTE',
                        'description' => 'Message sent to next instance',
                    ],
                    'smsCount' => 1,
                ],
                [
                    'to' => '255655912841',
                    'status' => [
                        'groupId' => 1,
                        'groupName' => 'PENDING',
                        'id' => 7,
                        'name' => 'PENDING_ENROUTE',
                        'description' => 'Message sent to next instance',
                    ],
                    'smsCount' => 1,
                ],
                [
                    'to' => '255716718040',
                    'status' => [
                        'groupId' => 1,
                        'groupName' => 'PENDING',
                        'id' => 7,
                        'name' => 'PENDING_ENROUTE',
                        'description' => 'Message sent to next instance',
                    ],
                    'smsCount' => 1,
                ],
            ],
        ]
    )));

    $result = $this->nextsms->messages()->sendMany([
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

    $this->assertArrayHasKey('messages', $result);
});

it('can scheduleSms', function () {
    $this->mock->reset();
    $this->mock->append(new Response(200, [], json_encode(
        [
            'messages' => [
                [
                    'to' => '255716718040',
                    'status' => [
                        'groupId' => 1,
                        'groupName' => 'PENDING',
                        'id' => 26,
                        'name' => 'PENDING_ACCEPTED',
                        'description' => 'Pending accepted , will be sent on scheduled time.',
                    ],
                    'smsCount' => 1,
                ],
            ],
        ]
    )));

    $result = $this->nextsms->messages()->sendLater([
        'from' => 'SENDER',
        'to' => '255716718040',
        'text' => 'Your message',
    ], new \DateTime('now'));

    $this->assertArrayHasKey('messages', $result);
});

it('can getAllSentSms', function () {
    $this->mock->reset();
    $this->mock->append(new Response(200, [], json_encode(
        [
            'results' => [
                [
                    'messageId' => '28695733526003536021',
                    'sentAt' => '2020-04-15 16=>09=>00',
                    'doneAt' => '2020-04-18 18=>23=>07',
                    'to' => '255716718040',
                    'from' => 'NEXTSMS',
                    'text' => 'test',
                    'smsCount' => 1,
                    'status' => [
                        'groupId' => 1,
                        'groupName' => 'PENDING',
                        'id' => 7,
                        'name' => 'PENDING_ENROUTE',
                        'description' => 'Message sent to next instance',
                    ],
                    'error' => null,
                ],
                [
                    'messageId' => '28255409354101630625',
                    'sentAt' => '2020-02-24 17=>21=>00',
                    'doneAt' => '2020-04-18 18=>23=>07',
                    'to' => '255716718040',
                    'from' => 'NEXTSMS',
                    'text' => 'test',
                    'smsCount' => 1,
                    'status' => [
                        'groupId' => 5,
                        'groupName' => 'REJECTED',
                        'id' => 12,
                        'name' => 'REJECTED_NOT_ENOUGH_CREDITS',
                        'description' => 'Not enough credits',
                    ],
                    'error' => null,
                ],
                [
                    'messageId' => '28089492984101631440',
                    'sentAt' => '2020-02-05 12=>28=>51',
                    'doneAt' => '2020-04-18 18=>23=>07',
                    'to' => '255716718040',
                    'from' => 'NEXTSMS',
                    'text' => 'Your message',
                    'smsCount' => 1,
                    'status' => [
                        'groupId' => 3,
                        'groupName' => 'DELIVERED',
                        'id' => 5,
                        'name' => 'DELIVERED_TO_HANDSET',
                        'description' => 'Message delivered to handset',
                    ],
                    'error' => [
                        'groupId' => 0,
                        'groupName' => 'OK',
                        'id' => 0,
                        'name' => 'NO_ERROR',
                        'description' => 'No Error',
                        'permanent' => false,
                    ],
                ],
            ],
        ]
    )));

    // Fixture::$getAllSentSms
    $result = $this->nextsms->reports()->all();

    $this->assertArrayHasKey('results', $result);
});

it('can getSmsBalance', function () {
    $this->mock->reset();
    $this->mock->append(new Response(200, [], json_encode(['sms_balance' => 5])));

    $result = $this->nextsms->messages()->balance();

    $this->assertArrayHasKey('sms_balance', $result);
});
