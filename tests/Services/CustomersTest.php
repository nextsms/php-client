<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Nextsms\Nextsms\Nextsms;
use Nextsms\Nextsms\Services\Customers;

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

it('customer sevice', function () {
    expect($this->nextsms->customers())->toBeInstanceOf(Customers::class);
});

it('registerSubCustomer', function () {
    // Arrange
    // Reset the queue and queue up a new response
    $this->mock->reset();
    $this->mock->append(new Response(200, [], json_encode(
        [
            'success' => true,
            'status' => 200,
            'message' => 'Customer created successfully. Email is sent to your customer email address for confirmation.',
            'result' => [
                'name' => 'Api Customer',
                'username' => 'apicust',
                'phone_number' => '+255738234339',
                'email' => 'apicust@customer.com',
                'account_type' => 'Sub Customer (Reseller)',
                'sms_price' => '20.00 TSH',
            ],
        ]
    )));

    // Act
    $result = $this->nextsms->customers()->create([
        'first_name' => 'Api',
        'last_name' => 'Customer',
        'username' => 'apicust',
        'email' => 'apicust@customer.com',
        'phone_number' => '0738234339',
        'account_type' => 'Sub Customer (Reseller)',
        'sms_price' => 20,
    ]);

    // Assert
    $this->assertArrayHasKey('success', $result);
    $this->assertArrayHasKey('status', $result);
});
it('rechargeCustomer', function () {
    // Arrange
    // Reset the queue and queue up a new response
    $this->mock->reset();
    $this->mock->append(new Response(200, [], json_encode(
        [
            'success' => true,
            'status' => 200,
            'message' => 'Transaction completed successfully',
            'result' => [
                'Customer' => 'example@email.com',
                'Sms transferred' => 5000,
                'Your sms balance' => 450000,
            ],
        ]
    )));

    // Act
    $result = $this->nextsms
        ->customers()
        ->recharge('example@email.com', 5000);

    // Assert
    $this->assertArrayHasKey('success', $result);
    $this->assertArrayHasKey('status', $result);
});
it('deductCustomer', function () {
    // Arrange
    // Reset the queue and queue up a new response
    $this->mock->reset();
    $this->mock->append(new Response(200, [], json_encode(
        [
            'success' => true,
            'status' => 200,
            'message' => 'Transaction completed successfully',
            'result' => [
                'Customer' => 'example@email.com',
                'Sms deducted' => 2000,
                'Your sms balance' => 470000,
                'Customer sms balance' => 3000,
            ],
        ]
    )));

    // Act
    $result = $this->nextsms->customers()->deduct('example@email.com', 2000);

    // Assert
    $this->assertArrayHasKey('success', $result);
    $this->assertArrayHasKey('status', $result);
});
