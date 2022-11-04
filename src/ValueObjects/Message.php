<?php

declare(strict_types=1);

namespace Nextsms\Nextsms\ValueObjects;

/**
 * @author Alphs Olomi
 * @version 2.0
 */
class Message
{

    protected int $id;
    protected string $messageId;
    protected string $from = 'NEXTSMS';
    protected array|string $to;
    protected string $message;
    protected \DateTime $date;
    protected \Datetime $time;
    protected Status $status;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? 0;
        $this->messageId = $data['messageId'] ?? '';
        $this->from = $data['from'] ?? 'NEXTSMS';
        $this->to = $data['to'] ?? '';
        $this->message = $data['message'] ?? '';
        $this->date = \DateTime::createFromFormat('Y:m:d', $data['date']) ?? new \DateTime();
        $this->time = \DateTime::createFromFormat('H:i', $data['time']) ?? new \DateTime();
        if (isset($data['status'])) {
            $this->status = Status::create($data['status']);
        } else {
            $this->status = Status::create([]);
        }
    }

    public static function create(string|array $text): self
    {
        return new self([
            'text' => $text
        ]);
    }

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

    public function __toString()
    {
        return json_encode($this->toArray());
    }
}
