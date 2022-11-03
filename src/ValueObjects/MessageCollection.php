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
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }
}
