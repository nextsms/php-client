<?php

declare(strict_types=1);

namespace Nextsms\Nextsms\Enums;

enum GroupName: string
{
    case PENDING_WAITING_DELIVERY = 'PENDING_WAITING_DELIVERY';
    case PENDING_ENROUTE = 'PENDING_ENROUTE';
    case PENDING_ACCEPTED = 'PENDING_ACCEPTED';
    case PENDING = 'PENDING';

    public function code(): int
    {
        return match ($this) {
            GroupName::PENDING_WAITING_DELIVERY => 3,
            GroupName::PENDING_ENROUTE => 7,
            GroupName::PENDING_ACCEPTED => 25,
            GroupName::PENDING => 1,
        };
    }

    public function message(): string
    {
        return match ($this) {
            GroupName::PENDING_WAITING_DELIVERY => 'Message has been processed and sent to the next instance i.e. mobile operator with request acknowledgment from their platform. Delivery report has not yet been received, and is awaited thus the status is still pending.',
            GroupName::PENDING_ENROUTE => 'Message has been processed and sent to the next instance i.e. mobile operator.',
            GroupName::PENDING_ACCEPTED => 'Message has been accepted and processed, and is ready to be sent to the next instance i.e. operator.',
            GroupName::PENDING => 'Message sent to next instance',
        };
    }
}
