<?php

declare(strict_types=1);

namespace Nextsms\Nextsms\Enums;

enum StatusName :string
{

    case REJECTED_NETWORK = "REJECTED_NETWORK";
    case REJECTED_PREFIX_MISSING = "REJECTED_PREFIX_MISSING";
    case REJECTED_DND = "REJECTED_DND";
    case REJECTED_SOURCE = "REJECTED_SOURCE";
    case REJECTED_NOT_ENOUGH_CREDITS = "REJECTED_NOT_ENOUGH_CREDITS";
    case REJECTED_SENDER = "REJECTED_SENDER";
    case REJECTED_DESTINATION = "REJECTED_DESTINATION";
    case REJECTED_PREPAID_PACKAGE_EXPIRED = "REJECTED_PREPAID_PACKAGE_EXPIRED";
    case REJECTED_DESTINATION_NOT_REGISTERED = "REJECTED_DESTINATION_NOT_REGISTERED";
    case REJECTED_ROUTE_NOT_AVAILABLE = "REJECTED_ROUTE_NOT_AVAILABLE";
    case REJECTED_FLOODING_FILTER = "REJECTED_FLOODING_FILTER";
    case REJECTED_SYSTEM_ERROR = "REJECTED_SYSTEM_ERROR";
    case REJECTED_DUPLICATE_MESSAGE_ID = "REJECTED_DUPLICATE_MESSAGE_ID";
    case REJECTED_INVALID_UDH = "REJECTED_INVALID_UDH";
    case REJECTED_MESSAGE_TOO_LONG = "REJECTED_MESSAGE_TOO_LONG";
    case MISSING_TO = "MISSING_TO";
    case REJECTED_INVALID_DESTINATION = "REJECTED_INVALID_DESTINATION";



    public function code(): int
    {
        return match ($this) {
            StatusName::REJECTED_NETWORK => 6,
            StatusName::REJECTED_PREFIX_MISSING => 8,
            StatusName::REJECTED_DND => 10,
            StatusName::REJECTED_SOURCE => 11,
            StatusName::REJECTED_NOT_ENOUGH_CREDITS => 12,
            StatusName::REJECTED_SENDER => 13,
            StatusName::REJECTED_DESTINATION => 14,
            StatusName::REJECTED_PREPAID_PACKAGE_EXPIRED => 17,
            StatusName::REJECTED_DESTINATION_NOT_REGISTERED => 18,
            StatusName::REJECTED_ROUTE_NOT_AVAILABLE => 19,
            StatusName::REJECTED_FLOODING_FILTER => 20,
            StatusName::REJECTED_SYSTEM_ERROR => 21,
            StatusName::REJECTED_DUPLICATE_MESSAGE_ID => 23,
            StatusName::REJECTED_INVALID_UDH => 24,
            StatusName::REJECTED_MESSAGE_TOO_LONG => 25,
            StatusName::MISSING_TO => 51,
            StatusName::REJECTED_INVALID_DESTINATION => 52,
        };
    }
    public function message(): string
    {
        return match ($this) {
            StatusName::REJECTED_NETWORK => 'Message has been received, but the network is either out of our coverage or not setup on your account. Your account manager can inform you on the coverage status or setup the network in question.',
            StatusName::REJECTED_NETWORK => "Message has been received, but the network is either out of our coverage or not setup on your account. Your account manager can inform you on the coverage status or setup the network in question.",
            StatusName::REJECTED_PREFIX_MISSING => "Message has been received, but has been rejected as the number is not recognized due to either incorrect number prefix or number length. This information is different for each network and is regularly updated.",
            StatusName::REJECTED_DND => "Message has been received, and rejected due to the user being subscribed to DND (Do Not Disturb) services, disabling any service traffic to their number.",
            StatusName::REJECTED_SOURCE => "Your account is set to accept only registered sender ID-s while the sender ID defined in the request has not been registered on your account.",
            StatusName::REJECTED_NOT_ENOUGH_CREDITS => "Your account is out of credits for further submission - please top up your account. For further assistance in topping up or applying for online account topup service you may contact your account manager.",
            StatusName::REJECTED_SENDER => "The sender ID has been blacklisted on your account - please remove the blacklist on your account or contact Support for further assistance.",
            StatusName::REJECTED_DESTINATION => "The destination number has been blacklisted either at the operator request or on your account - please contact Support for more information.",
            StatusName::REJECTED_PREPAID_PACKAGE_EXPIRED => "Account credits have been expired past their validity period - please topup your subaccount with credits to extend the validity period.",
            StatusName::REJECTED_DESTINATION_NOT_REGISTERED => "Your account has been setup for submission only to a single number for testing purposes - kindly contact your manager to remove the limitation.",
            StatusName::REJECTED_ROUTE_NOT_AVAILABLE => "Mesage has been received on the system, however your account has not been setup to send messages i.e. no routes on your account are available for further submission. Your account manager will be able to setup your account based on your preference.",
            StatusName::REJECTED_FLOODING_FILTER => "Message has been rejected due to a anti-flooding mechanism. By default, a single number can only receive 20 varied messages and 6 identical messages per hour. If there is a requirement, the limitation can be extended per account on request to your account manager.",
            StatusName::REJECTED_SYSTEM_ERROR => "The request has been rejected due to an expected system system error, please retry submission or contact our technical support team for more details.",
            StatusName::REJECTED_DUPLICATE_MESSAGE_ID => "The request has been rejected due to a duplicate message ID specified in the submit request, while message ID-s should be a unique value",
            StatusName::REJECTED_INVALID_UDH => "Message has been received, while our system detected the message was formatted incorrectly because of either an invalid ESM class parameter (fully featured binary message API method) or an inaccurate amount of characters when using esmclass:64 (UDH). For more information feel free to visit the below articles or contact our Support team for clarification. https://en.wikipedia.org/wiki/User_Data_Header, https://en.wikipedia.org/wiki/Concatenated_SMS",
            StatusName::REJECTED_MESSAGE_TOO_LONG => "Message has been received, but the total message length is more than 25 parts or message text which exceeds 4000 bytes as per our system limitation.",
            StatusName::MISSING_TO => 'The request has been received, however the "to" parameter has not been set or it is empty, i.e. there must be valid recipients to send the message.',
            StatusName::REJECTED_INVALID_DESTINATION => "The request has been received, however the destination is invalid - the number prefix is not correct as it does not match a valid number prefix by any mobile operator. Number length is also taken into consideration in verifying number number validity.",
        };
    }
}
