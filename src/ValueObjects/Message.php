<?php

declare(strict_types=1);

namespace Nextsms\Nextsms\ValueObjects;

/**
 * @author Alpha Olomi
 *
 * @version 2.0
 */
class Message
{
    protected ?int $id = null;

    protected ?string $messageId = null;

    protected ?string $from = null;

    protected null|array|string $to = null;

    protected ?string $message = null;

    protected ?\DateTime $date = null;

    protected ?\Datetime $time = null;

    protected ?Status $status = null;

    public function __construct() {}

    public static function make(string|array $text): self
    {
        if (is_string($text)) {
            $message = new self();
            $message->message = $text;

            return $message;
        }

        if (is_array($text)) {
            $message = new self();
            $message->message = $text['message'] ?? null;
            $message->from = $text['from'] ?? null;
            $message->to = $text['to'] ?? null;

            return $message;
        }

        return new self();
    }

    // isbulk
    public function isBulk(): bool
    {
        return is_array($this->to);
    }

    public function toArray(): array
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
