<?php

use Nextsms\Nextsms\ValueObjects\Status;

test('tests/ValueObjects/StatusTest.php', function () {
    $status = Status::make([
        'groupId' => 1,
        'groupName' => 'PENDING',
        'id' => 7,
        'name' => 'PENDING_ENROUTE',
        'description' => 'Message sent to next instance',
    ]);

    expect($status)->toBeInstanceOf(Status::class);
});
