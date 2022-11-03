<?php

namespace Nextsms\Nextsms\Enum;

enum GroupName
{
    // 3	PENDING_WAITING_DELIVERY - Message has been processed and sent to the next instance i.e. mobile operator with request acknowledgment from their platform. Delivery report has not yet been received, and is awaited thus the status is still pending.
    // 7	PENDING_ENROUTE - Message has been processed and sent to the next instance i.e. mobile operator.
    // 26	PENDING_ACCEPTED - Message has been accepted and processed, and is ready to be sent to the next instance i.e. operator.

}
