<?php

use Nextsms\Nextsms\ValueObjects\Message;
use Nextsms\Nextsms\ValueObjects\MessageCollection;

test('MessageCollection', function () {
    // Arrange, Act
    $mc = new MessageCollection;
    // Assert
    expect($mc)->toBeInstanceOf(MessageCollection::class);
});

it('can instantiate MessageCollection', function () {
    // Arrange
    $mc = new MessageCollection;

    // Act
    $msg = Message::make(['message' => 'Hello ther', 'to' => '0747991498']);
    $mc->add($msg);
    // Assert
    expect($mc->getMessages())->toBeArray();
});

test('MessageCollection string to json', function () {
    // Arrange
    $mc = new MessageCollection;

    // Act
    $msg = Message::make(['message' => 'Hello ther', 'to' => '0747991498']);
    $mc->add($msg);
    // $mcArray = $mc->getMessages();
    // Assert
    expect((string) $mc)->toBeJson();
});
