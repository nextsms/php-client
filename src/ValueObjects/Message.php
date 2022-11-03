<?php

namespace Nextsms\Nextsms\ValueObjects;

use Nextsms\Nextsms\Traits\HasErrors;
use Nextsms\Nextsms\Traits\HasStatus;

/**
 * @author Alphs Olomi
 * @version 2.0
 */
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

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->messageId = $data['messageId'];
        $this->from = $data['from'];
        $this->to = $data['to'];
        $this->message = $data['message'];
        $this->date = $data['date'];
        $this->time = $data['time'];
        $this->status = $data['status'];
    }

    // toArray
    public function toArray()
    {
        return [
            'id' => $this->id,
            'messageId' => $this->messageId,
            'from' => $this->from,
            'to' => $this->to,
            'message' => $this->message,
            'date' => $this->date,
            'time' => $this->time,
            'status' => $this->status,
        ];
    }
}
