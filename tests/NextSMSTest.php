<?php

namespace Nextsms\Nextsms\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
// use Nextsms\Nextsms;
use Nextsms\Nextsms\Nextsms;
use PHPUnit\Framework\TestCase;

class NextSMSTest extends TestCase
{
    protected MockHandler $mock;
    protected HandlerStack $handlerStack;

    /** @var Nextsms */
    private $nextsms;

    public function setup(): void
    {
        $this->mock = new MockHandler([]);

        $this->handlerStack = HandlerStack::create($this->mock);

        $httpClient = new Client(['handler' => $this->handlerStack]);

        $this->nextsms = new Nextsms([
            'username' => 'city', // Fixture::$username,
            'password' => 'newrise', // Fixture::$password,
            'senderId' => "NEXTSMS"
        ], $httpClient);
    }

    /** @test */
    public function nextsmsInstantiable()
    {
        $this->assertInstanceOf(NextSms::class, $this->nextsms);
    }

    /** @test */
    public function nextsmsHasTheseAttributes()
    {
        $this->assertClassHasAttribute('options', get_class($this->nextsms));
        $this->assertClassHasAttribute('httpClient', get_class($this->nextsms));
    }

    /** @test */
    public function canSendSingleDestination()
    {
        // Arrange
        // Reset the queue and queue up a new response
        $this->mock->reset();
        $this->mock->append(new Response(200, [], json_encode(["messages" => [
            [
                "to" => "255716718040",
                "status" => [
                    "groupId" => 1,
                    "groupName" => "PENDING",
                    "id" => 7,
                    "name" => "PENDING_ENROUTE",
                    "description" => "Message sent to next instance",
                ],
                "smsCount" => 1,
            ],
        ]])));

        // Act
        $result = $this->nextsms->messages()->send(Fixture::$singleDestination);

        // Assert
        $this->assertArrayHasKey('messages', $result);
    }

    /** @test */
    public function multipleDestinations()
    {
        // Arrange
        // Reset the queue and queue up a new response
        $this->mock->reset();
        $this->mock->append(new Response(200, [], json_encode(
            [
                "messages" => [
                    [
                        "to" => "255655912841",
                        "status" => [
                            "groupId" => 1,
                            "groupName" => "PENDING",
                            "id" => 7,
                            "name" => "PENDING_ENROUTE",
                            "description" => "Message sent to next instance",
                        ],
                        "smsCount" => 1,
                    ],
                    [
                        "to" => "255716718040",
                        "status" => [
                            "groupId" => 1,
                            "groupName" => "PENDING",
                            "id" => 7,
                            "name" => "PENDING_ENROUTE",
                            "description" => "Message sent to next instance",
                        ],
                        "smsCount" => 1,
                    ],
                ],
            ]
        )));

        // Act
        $result = $this->nextsms->messages()->sendMany(Fixture::$multipleDestinations);

        // Assert
        $this->assertArrayHasKey('messages', $result);
    }

    /** @test */
    public function multipleMessagesToMultipleDestinations()
    {
        // Arrange
        // Reset the queue and queue up a new response
        $this->mock->reset();
        $this->mock->append(new Response(200, [], json_encode(
            [
                "messages" => [
                    [
                        "to" => "255716718040",
                        "status" => [
                            "groupId" => 1,
                            "groupName" => "PENDING",
                            "id" => 7,
                            "name" => "PENDING_ENROUTE",
                            "description" => "Message sent to next instance",
                        ],
                        "smsCount" => 1,
                    ],
                    [
                        "to" => "255655912841",
                        "status" => [
                            "groupId" => 1,
                            "groupName" => "PENDING",
                            "id" => 7,
                            "name" => "PENDING_ENROUTE",
                            "description" => "Message sent to next instance",
                        ],
                        "smsCount" => 1,
                    ],
                ],
            ]
        )));

        // Act
        $result = $this->nextsms->messages()->sendMany(Fixture::$singleDestination);

        // Assert
        $this->assertArrayHasKey('messages', $result);
    }

    /** @test */
    public function multipleMessagesToMultipleDifferentDestinations()
    {
        $this->markTestSkipped();
        // Arrange
        // Reset the queue and queue up a new response
        $this->mock->reset();
        $this->mock->append(new Response(200, [], json_encode(
            [
                "messages" => [
                    [
                        "to" => "255716718040",
                        "status" => [
                            "groupId" => 1,
                            "groupName" => "PENDING",
                            "id" => 7,
                            "name" => "PENDING_ENROUTE",
                            "description" => "Message sent to next instance",
                        ],
                        "smsCount" => 1,
                    ],
                    [
                        "to" => "255758483019",
                        "status" => [
                            "groupId" => 1,
                            "groupName" => "PENDING",
                            "id" => 7,
                            "name" => "PENDING_ENROUTE",
                            "description" => "Message sent to next instance",
                        ],
                        "smsCount" => 1,
                    ],
                    [
                        "to" => "255758483019",
                        "status" => [
                            "groupId" => 1,
                            "groupName" => "PENDING",
                            "id" => 7,
                            "name" => "PENDING_ENROUTE",
                            "description" => "Message sent to next instance",
                        ],
                        "smsCount" => 1,
                    ],
                    [
                        "to" => "255655912841",
                        "status" => [
                            "groupId" => 1,
                            "groupName" => "PENDING",
                            "id" => 7,
                            "name" => "PENDING_ENROUTE",
                            "description" => "Message sent to next instance",
                        ],
                        "smsCount" => 1,
                    ],
                    [
                        "to" => "255716718040",
                        "status" => [
                            "groupId" => 1,
                            "groupName" => "PENDING",
                            "id" => 7,
                            "name" => "PENDING_ENROUTE",
                            "description" => "Message sent to next instance",
                        ],
                        "smsCount" => 1,
                    ],
                ],
            ]
        )));

        // Act
        $result = $this->nextsms->messages()->sendMany(Fixture::$multipleMessagesToMultipleDifferentDestinations);

        // Assert
        $this->assertArrayHasKey('messages', $result);
    }

    /** @test */
    public function scheduleSms()
    {
        // Arrange
        // Reset the queue and queue up a new response
        $this->mock->reset();
        $this->mock->append(new Response(200, [], json_encode(
            [
                "messages" => [
                    [
                        "to" => "255716718040",
                        "status" => [
                            "groupId" => 1,
                            "groupName" => "PENDING",
                            "id" => 26,
                            "name" => "PENDING_ACCEPTED",
                            "description" => "Pending accepted , will be sent on scheduled time.",
                        ],
                        "smsCount" => 1,
                    ],
                ],
            ]
        )));

        // Act
        $result = $this->nextsms->messages()->sendLater(Fixture::$scheduleSms, new \DateTime('now'));

        // Assert
        $this->assertArrayHasKey('messages', $result);
    }


    public function getAllSentSms()
    {
        // Arrange
        // Reset the queue and queue up a new response
        $this->mock->reset();
        $this->mock->append(new Response(200, [], json_encode(
            [
                "results" => [
                    [
                        "messageId" => "28695733526003536021",
                        "sentAt" => "2020-04-15 16=>09=>00",
                        "doneAt" => "2020-04-18 18=>23=>07",
                        "to" => "255716718040",
                        "from" => "NEXTSMS",
                        "text" => "test",
                        "smsCount" => 1,
                        "status" => [
                            "groupId" => 1,
                            "groupName" => "PENDING",
                            "id" => 7,
                            "name" => "PENDING_ENROUTE",
                            "description" => "Message sent to next instance",
                        ],
                        "error" => null,
                    ],
                    [
                        "messageId" => "28255409354101630625",
                        "sentAt" => "2020-02-24 17=>21=>00",
                        "doneAt" => "2020-04-18 18=>23=>07",
                        "to" => "255716718040",
                        "from" => "NEXTSMS",
                        "text" => "test",
                        "smsCount" => 1,
                        "status" => [
                            "groupId" => 5,
                            "groupName" => "REJECTED",
                            "id" => 12,
                            "name" => "REJECTED_NOT_ENOUGH_CREDITS",
                            "description" => "Not enough credits",
                        ],
                        "error" => null,
                    ],
                    [
                        "messageId" => "28089492984101631440",
                        "sentAt" => "2020-02-05 12=>28=>51",
                        "doneAt" => "2020-04-18 18=>23=>07",
                        "to" => "255716718040",
                        "from" => "NEXTSMS",
                        "text" => "Your message",
                        "smsCount" => 1,
                        "status" => [
                            "groupId" => 3,
                            "groupName" => "DELIVERED",
                            "id" => 5,
                            "name" => "DELIVERED_TO_HANDSET",
                            "description" => "Message delivered to handset",
                        ],
                        "error" => [
                            "groupId" => 0,
                            "groupName" => "OK",
                            "id" => 0,
                            "name" => "NO_ERROR",
                            "description" => "No Error",
                            "permanent" => false,
                        ],
                    ],
                ],
            ]
        )));

        // Act
        // Fixture::$getAllSentSms
        $result = $this->nextsms->reports()->all();

        // Assert
        $this->assertArrayHasKey('results', $result);
    }

    /** @test */
    public function registerSubCustomer()
    {
        // Arrange
        // Reset the queue and queue up a new response
        $this->mock->reset();
        $this->mock->append(new Response(200, [], json_encode(
            [
                "success" => true,
                "status" => 200,
                "message" => "Customer created successfully. Email is sent to your customer email address for confirmation.",
                "result" => [
                    "name" => "Api Customer",
                    "username" => "apicust",
                    "phone_number" => "+255738234339",
                    "email" => "apicust@customer.com",
                    "account_type" => "Sub Customer (Reseller)",
                    "sms_price" => "20.00 TSH",
                ],
            ]
        )));

        // Act
        $result = $this->nextsms->customers()->create(Fixture::$registerSubCustomer);

        // Assert
        $this->assertArrayHasKey('success', $result);
        $this->assertArrayHasKey('status', $result);
    }

    public function rechargeCustomer()
    {
        // Arrange
        // Reset the queue and queue up a new response
        $this->mock->reset();
        $this->mock->append(new Response(200, [], json_encode(
            [
                "success" => true,
                "status" => 200,
                "message" => "Transaction completed successfully",
                "result" => [
                    "Customer" => "example@email.com",
                    "Sms transferred" => 5000,
                    "Your sms balance" => 450000,
                ],
            ]
        )));

        // Act
        $result = $this->nextsms
            ->customers()
            ->recharge(
                customer: Fixture::$rechargeCustomer['email'],
                smsCount: Fixture::$rechargeCustomer['smscount']
            );

        // Assert
        $this->assertArrayHasKey('success', $result);
        $this->assertArrayHasKey('status', $result);
    }

    public function deductCustomer()
    {
        // Arrange
        // Reset the queue and queue up a new response
        $this->mock->reset();
        $this->mock->append(new Response(200, [], json_encode(
            [
                "success" => true,
                "status" => 200,
                "message" => "Transaction completed successfully",
                "result" => [
                    "Customer" => "example@email.com",
                    "Sms deducted" => 2000,
                    "Your sms balance" => 470000,
                    "Customer sms balance" => 3000,
                ],
            ]
        )));

        // Act
        $result = $this->nextsms->customers()->deduct(Fixture::$deductCustomer['email'], 2000);

        // Assert
        $this->assertArrayHasKey('success', $result);
        $this->assertArrayHasKey('status', $result);
    }

    public function getSmsBalance()
    {
        // Arrange
        // Reset the queue and queue up a new response
        $this->mock->reset();
        $this->mock->append(new Response(200, [], json_encode(["sms_balance" => 5,])));

        // Act
        $result = $this->nextsms->messages()->balance();

        // Assert
        $this->assertArrayHasKey('sms_balance', $result);
    }
}
