<?php

namespace Nextsms\Nextsms\Tests;

class Fixture
{
    public static string $username = 'aladdin';

    public static string $password = 'opensesame123';

    public static string $env = 'testing';

    public static array $singleDestination = [
        'from' => 'NEXTSMS',
        'to' => '255716718040',
        'text' => 'Hello World',

    ];

    public static array $multipleDestinations =
    [
        'from' => 'NEXTSMS',
        'to' => ['255655912841', '255716718040'],
        'text' => 'Your message',
    ];

    public static array $multipleMessagesToMultipleDestinations =
    [
        'messages' => [
            ['from' => 'NEXTSMS', 'to' => '255716718040', 'text' => 'Your message'],
            ['from' => 'NEXTSMS', 'to' => '255655912841', 'text' => 'Your other message'],
        ],
    ];

    public static array $multipleMessagesToMultipleDifferentDestinations = [
        'messages' => [
            [
                'from' => 'NEXTSMS',
                'to' => ['255716718040', '255758483019'],
                'text' => 'Your message',
            ],
            [
                'from' => 'NEXTSMS',
                'to' => ['255758483019', '255655912841', '255716718040'],
                'text' => 'Your other message',
            ],
        ],
    ];

    public static array $scheduleSms =
    [
        'from' => 'SENDER',
        'to' => '255716718040',
        'text' => 'Your message',
        'date' => '2020-10-01',
        'time' => '12:00',
    ];

    public static array $getAllSentSmsLogs =
    [
        'from' => '2020-02-01',
        'limit' => '10',
        'offset' => '10',
    ];

    public static array $getAllSentSms = [
        'from' => 'NEXTSMS',
        'to' => '255716718040',
        'sentSince' => '2020-02-01',
        'sentUntil' => '2020-02-20',
    ];

    public static array  $registerSubCustomer =
    [
        'first_name' => 'Api',
        'last_name' => 'Customer',
        'username' => 'apicust',
        'email' => 'apicust@customer.com',
        'phone_number' => '0738234339',
        'account_type' => 'Sub Customer (Reseller)',
        'sms_price' => 20,
    ];

    public static array  $rechargeCustomer = [
        'email' => 'example@email.com',
        'smscount' => 5000,
    ];

    public static array  $deductCustomer = [
        'email' => 'example@email.com',
        'smscount' => 2000,
    ];
}
