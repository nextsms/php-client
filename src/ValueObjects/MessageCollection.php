<?php

namespace Nextsms\Nextsms\ValueObjects;

/**
 * Class MessageCollection
 * @package Nextsms\Nextsms\ValueObjects
 * @property Message[] $messages
 * @author Alphs Olomi
 * @version 2.0
 */
class MessageCollection
{
    /**
     * @var array<Message>
     */
    private $messages;

    /**
     * MessageCollection constructor.
     * @param array $messages
     */
    public function __construct(array $messages = [])
    {
        $this->messages = $messages;
    }

    /**
     * @return array<Message>
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    public function add(Message $message): void
    {
        $this->messages[] = $message;
    }

    public function toArray(): array
    {
        return [
            'messages' => array_map(fn (Message $message) => $message->toArray(), $this->messages),
        ];
    }

    public function toJson(): bool|string
    {
        return json_encode($this->toArray());
    }

    public function __toString()
    {
        return $this->toJson();
    }
}
