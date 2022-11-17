<?php

use Nextsms\Nextsms\Enums\GroupName;

test('tests/Enums/GroupNameTest.php', function () {
    $value = GroupName::PENDING_WAITING_DELIVERY;

    expect($value->message())->toBeString();
    expect($value->code())->toBeNumeric();
    // expect((string)$value)->toBeString();

    $this->assertEquals(GroupName::PENDING_WAITING_DELIVERY, GroupName::PENDING_WAITING_DELIVERY);
    $this->assertEquals(GroupName::PENDING_ENROUTE, GroupName::PENDING_ENROUTE);
    $this->assertEquals(GroupName::PENDING_ACCEPTED, GroupName::PENDING_ACCEPTED);
});
