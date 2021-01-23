<?php

namespace NextSMS\SDK\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use NextSMS\SDK\NextSMS;
use PHPUnit\Framework\TestCase;

/**
 * @property NextSMS $nextsms
 * @version 1.0.0
 *
 */
class NextSMSTest extends TestCase
{
    public function setup()
    {
        // Create a mock and queue two responses.
        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], json_encode([
                'messages' =>  [
                    [
                      "to"=> "255716718040",
                      "status"=> [
                        "groupId"=> 1,
                        "groupName"=> "PENDING",
                        "id"=> 7,
                        "name"=> "PENDING_ENROUTE",
                        "description"=> "Message sent to next instance"
                      ],
                      "smsCount"=> 1
                    ]
                  ]

            ])),
            new Response(202, ['Content-Length' => 0]),
            new RequestException('Error Communicating with Server', new Request('GET', 'test'))
        ]);

        $handlerStack = HandlerStack::create($mock);

        $httpClient = new Client(['handler' => $handlerStack]);

        $this->nextsms = new NextSMS([
            'username'=>Fixture::$username,
            'password'=>Fixture::$password
        ], $httpClient);
    }

    /** @test */
    public function nextsms_instantiable()
    {
        $this->assertInstanceOf(NextSMS::class, $this->nextsms);
        $this->assertInstanceOf(NextSMS::class, new NextSMS([
            'username' => Fixture::$username,
            'password' => Fixture::$password,
        ]));
    }

    /** @test */
    public function nextsms_has_these_attributes()
    {
        $this->assertClassHasAttribute('options', get_class($this->nextsms));
        $this->assertClassHasAttribute('client', get_class($this->nextsms));
    }



    /**
     * @test
     * @throws GuzzleException
     */
    public function nextsms_transact_c2b()
    {
        // Arrange - Done in the set up method

        $result = $this->nextsms->single_destination(Fixture::$data_single);
        // Act
        // Assert
        $this->assertArrayHasKey('output_ResponseCode', $result);

    }



}
