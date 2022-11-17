<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

use Nextsms\Nextsms\Nextsms;
use Nextsms\Nextsms\Services\DeliveryReport;

beforeEach(function () {
    /** @var MockHandler */
    $this->mock = new MockHandler([]);

    /** @var  HandlerStack */
    $this->handlerStack = HandlerStack::create($this->mock);

    /** @var Client */
    $httpClient = new Client(['handler' => $this->handlerStack]);

    /** @var Nextsms */
    $this->nextsms = new Nextsms([
        'username' => 'city', // Fixture::$username,
        'password' => 'newrise', // Fixture::$password,
        'senderId' => "NEXTSMS"
    ], $httpClient);
});

it('can use DeliveryReportTest sevice', function () {
    expect($this->nextsms->reports())->toBeInstanceOf(DeliveryReport::class);
});
it(' can getDeliveryReports', function () {
    $this->mock->reset();
    $this->mock->append(new Response(200, [], json_encode('')));
    $result = $this->nextsms->reports()->all();
    $this->assertArrayHasKey('messages', $result);
})->markTestIncomplete();

it(' can getDeliveryReportsWithMessageId', function () {
    $this->mock->reset();
    $this->mock->append(new Response(200, [], json_encode('')));
    $result = $this->nextsms->reports()->find('msgID');
    $this->assertArrayHasKey('messages', $result);
})->markTestIncomplete();
it(' can getDeliveryReportsWithSpecificDateRange', function () {
    $this->mock->reset();
    $this->mock->append(new Response(200, [], json_encode('')));
    $result = $this->nextsms
        ->reports()
        ->sendSince('')
        ->sentUntil()
        ->get();
    $this->assertArrayHasKey('messages', $result);
})->markTestIncomplete();
