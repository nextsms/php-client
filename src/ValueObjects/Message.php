<?php

namespace Nextsms\Nextsms\ValueObjects;

use Nextsms\Nextsms\Traits\HasErrors;
use Nextsms\Nextsms\Traits\HasStatus;

class Message
{
    use HasStatus;
    use HasErrors;

    protected $id;
    protected $messageId;
    protected $from = 'NEXTSMS';
    protected $to;
    protected $message;
    protected $date;
    protected $time;
    protected $status;

    // "groupId": 1,
    // "groupName": "PENDING",
    // "id": 7,
    // "name": "PENDING_ENROUTE",
    // "description": "Message sent to next instance"

}
