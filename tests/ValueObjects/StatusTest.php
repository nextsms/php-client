<?php

test('tests/ValueObjects/StatusTest.php', function () {
    $status = \Nextsms\Nextsms\ValueObjects\Status::make([
        "groupId" => 1,
        "groupName" => "PENDING",
        "id" => 7,
        "name" => "PENDING_ENROUTE",
        "description" => "Message sent to next instance"
    ]);

    expect($status)->toBeInstanceOf(\Nextsms\Nextsms\ValueObjects\Status::class);
// expect((string)$status)->toBeString();
    // expect($status->id())->toBeNumeric();
    // expect($status->name())->toBeString();
    // expect($status->message())->toBeString();
    // expect($status->code())->toBeNumeric();

    // $this->assertEquals(\Nextsms\Nextsms\Enums\GroupName::PENDING_WAITING_DELIVERY, $status->group()->name());
    // $this->assertEquals(\Nextsms\Nextsms\Enums\GroupName::PENDING_ENROUTE, $status->group()->name());
    // $this->assertEquals(\Nextsms\Nextsms\Enums\GroupName::PENDING_ACCEPTED, $status->group()->name());
});
