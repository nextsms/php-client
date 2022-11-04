<?php

use Nextsms\Nextsms\ValueObjects\Message;

test('tests/ValueObjects/MessageTest.php', function () {

    $message = Message::create([
        "sender" => "NextSMS",
        "recipient" => "0738234339",
        "message" => "Hello World"
    ]);

    expect($message)->toBeInstanceOf(Message::class);

    expect((string)$message)->toBeJson();
});
