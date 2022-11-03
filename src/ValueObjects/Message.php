<?php

declare(strict_types=1);

namespace Nextsms\Nextsms\ValueObjects;

/**
 * @author Alphs Olomi
 * @version 2.0
 */
class Message
{

    private int $id;
    private string $messageId;
    private string $from = 'NEXTSMS';
    private array|string $to;
    private string $message;
    private \DateTime $date;
    private \Datetime $time;
    private Status $status;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->messageId = $data['messageId'];
        $this->from = $data['from'];
        $this->to = $data['to'];
        $this->message = $data['message'];
        $this->date = \DateTime::createFromFormat('Y:m:d', $data['date']);
        $this->time = \DateTime::createFromFormat('H:i', $data['time']);
        if (isset($data['status'])) {
            $this->status = Status::create($data['status']);
        }
    }

    // text
    public static function text(string|array $text): self
    {
        return new self(['text' => $text]);
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
            'status' => (string) $this->status,
        ];
    }

    // tostring
    public function __toString()
    {
        return json_encode($this->toArray());
    }
}
