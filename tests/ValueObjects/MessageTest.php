<?php

use Nextsms\Nextsms\ValueObjects\Message;

test('tests/Value Objects/Message Test php', function () {
    $message = Message::make([
        'sender' => 'NextSMS',
        'recipient' => '0738234339',
        'message' => 'Hello World',
    ]);

    expect($message)
        ->toBeInstanceOf(Message::class)
        ->and((string) $message)->toBeJson();
});
