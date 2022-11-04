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
    public function __construct(array $messages)
    {
        $this->messages = $messages;
    }

    /**
     * @return array<Message>
     */
    public function getMessages()
    {
        return $this->messages;
    }

    public function add(Message $message)
    {
        $this->messages[] = $message;
    }

    public function toArray()
    {
        return [
            'messages' => array_map(fn ($message) => $message->toArray(), $this->messages),
        ];
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }

    public function __toString()
    {
        return $this->toJson();
    }
}
