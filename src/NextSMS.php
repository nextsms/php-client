<?php

namespace NextSMS\SDK;

use GuzzleHttp\Client;
use InvalidArgumentException;

/**

 * @package NextSMS\SDK
 * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#intro}
 *
 * @version 0.1.0
 * @author Alpha Olomi <alphaolomi@gmail.com>
 */
class NextSMS
{
    /**
     * @var array|null
     */
    protected ?array $options;


    /**
     * @var Client|null
     */
    protected ?client $httpClient;

    /**
     * NextSMS constructor.
     * @param array|null $options
     * @param Client|null $httpClient
     * @throws InvalidArgumentException
     */
    public function __construct(?array $options = [], ?Client $httpClient = null)
    {
        if (! array_key_exists('username', $options)) {
            throw new InvalidArgumentException("Username is required.");
        }
        if (! array_key_exists('password', $options)) {
            throw new InvalidArgumentException("Password is required.");
        }

        if (! array_key_exists('environment', $options)) {
            $options['environment'] = 'testing';
        }
        $this->options = $options;
        $this->httpClient = $this->makeClient($options, $httpClient);
    }

    protected function makeClient(?array $options, ?Client $client = null): Client
    {
        return ($client instanceof Client) ? $client : new Client([
            'base_uri' => 'https://messaging-service.co.tz/api/',
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => "Basic " . $this->makeToken($options['username'], $options['password']),
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    /**
     * @param string $username
     * @param string $password
     * @return string
     */
    protected function makeToken(string $username, string $password): string
    {
        return base64_encode("{$username}:{$password}");
    }

    /**
     *
     * Send SMS to Single destination/recipient
     * Required fields
     * [
     *  'from' => 'NEXTSMS',
     *  'to' => '255716718040',
     *  'text' => 'Your message'
     * ]
     *
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#5e466440-829b-4b56-be32-b681e4f81227}
     * @returns mixed
     * @throws InvalidArgumentException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function singleDestination(array $data)
    {
        if (! array_key_exists('to', $data)) {
            throw new InvalidArgumentException("Recipient Number is required.");
        }
        if (! array_key_exists('text', $data)) {
            throw new InvalidArgumentException("Text Message is required.");
        }
        $url = "sms/v1/text/single";
        if ($this->options['environment'] == 'testing') {
            $url = "sms/v1/test/text/single";
        }
        $response = $this->httpClient->request("POST", $url, ['json' => $data]);

        return json_decode($response->getBody(), true);
    }

    /**
     *
     *  Multiple destinations
     *  For sending the single messages to multiple phone numbers,
     *
     *
     * [
     *  "from" => "NEXTSMS",
     *  "to" => ['255655912841', '255716718040'],
     *  "text" => "Your message"
     * ]
     *
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#2936eed4-6027-45e7-92c9-fe1cd7df140b}
     * @returns mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function multipleDestinations(array $data)
    {
        if (! array_key_exists('from', $data)) {
            throw new InvalidArgumentException("From field is required.");
        }
        if (! array_key_exists('text', $data)) {
            throw new InvalidArgumentException("Message text is required.");
        }
        if (! array_key_exists('to', $data)) {
            throw new InvalidArgumentException("Recipient Numbers are required.");
        }
        $url = "sms/v1/text/multi";
        if ($this->options['environment'] == 'testing') {
            $url = "sms/v1/test/text/multi";
        }

        $response = $this->httpClient->request("POST", $url, [
            'json' => $data,
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     *
     *   Multiple messages to Multiple different destinations (Format 1)
     *
     * {
     *     messages = [
     *         { from: 'NEXTSMS', to: '255716718040', text: 'Your message' },
     *         { from: 'NEXTSMS', to: '255655912841', text: 'Your other message' },
     *     ],
     * }
     * @param array $data
     *
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#b13825ab-8b49-45f5-a4cd-fb7d21aa975a }
     */
    public function multipleMessagesToMultipleDestinations(array $data)
    {
        if (! array_key_exists('messages', $data)) {
            throw new InvalidArgumentException("Messages are required.");
        }
        $response = $this->httpClient->request("POST", "sms/v1/text/multi", [
            'json' => $data,
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     *
     *  Multiple messages to Multiple destinations (Format 2)
     * For sending the multiple messages to multiple phone numbers,
     * {
     *     messages: [
     *         {
     *             from: 'NEXTSMS',
     *             to: ['255716718040', '255758483019'],
     *             text: 'Your message',
     *         },
     *         {
     *             from: 'NEXTSMS',
     *             to: ['255758483019', '255655912841', '255716718040'],
     *             text: 'Your other message',
     *         },
     *     ],
     * }
     *
     *
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#6916415a-4645-460d-bb3f-a6d6fbd60e4a}
     * @returns mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function multipleMessagesToMultipleDifferentDestinations($data)
    {
        if (! array_key_exists('messages', $data)) {
            throw new InvalidArgumentException("Messages are required.");
        }
        if (count($data['messages']) < 0) {
            throw new InvalidArgumentException("Invalid Messages. Expected atleast one message");
        }
        foreach ($data['messages'] as $key => $message) {
            if (! array_key_exists('from', $data)) {
                throw new InvalidArgumentException("From field is required. On message #" . $key);
            }
            if (! array_key_exists('text', $data)) {
                throw new InvalidArgumentException("Message text is required. On message #" . $key);
            }
            if (! array_key_exists('to', $data)) {
                throw new InvalidArgumentException("Recipient Numbers are required. On message #" . $key);
            }
        }



        $response = $this->httpClient->request("POST", "sms/v1/text/multi", [
            'json' => $data,
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     *  Schedule SMS
     *
     *   To send schedule sms you required to have the following parameters:
     *   from - your Sender ID
     *   to - recipient phone number with the format begin with 255
     *   text - your text message
     *   date - date of the day to which you want to send your sms, format of Year-month-date example:2020-10-01
     *   time - time of the day to which you want to send your sms, 24 hours format example:12:00
     *
     *   Optional parameters to the schedule sms
     *   repeat - you can add this parameter when you want your sms to be repeated. This must be with these values in order to work: hourly, daily, weekly or monthly
     *   start_date - this parameter defines the date from this your sms can start sending, format of Year-month-date exapmle:2020-10-01.
     *   end_date - this parameter defines the date from this your sms can end sending, format of Year-month-date exapmle:2021-01-01.
     *
     *
     *   [
     *     from: 'SENDER',
     *     to: '255716718040',
     *     text: 'Your message',
     *     date: '2020-10-01',
     *     time: '12:00',
     *   ]
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#59cc2941-482b-45ab-9721-a7abffc83bba}
     *
     * @param array $data
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function scheduleSms(array $data)
    {
        if (! array_key_exists('messages', $data)) {
            throw new InvalidArgumentException("Messages are required.");
        }
        if (! array_key_exists('to', $data)) {
            throw new InvalidArgumentException("Recipient is required.");
        }
        if (! array_key_exists('text', $data)) {
            throw new InvalidArgumentException("Message is required.");
        }
        if (! array_key_exists('date', $data)) {
            throw new InvalidArgumentException("Schedule date is required.");
        }
        if (! array_key_exists('time', $data)) {
            throw new InvalidArgumentException("Schedule time is required.");
        }

        $response = $this->httpClient->request("POST", "sms/v1/text/single", [
            'json' => $data,
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     *
     *  Get delivery reports with messageId
     *
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#5fc5b186-c4dc-4de0-9d0f-baee93d53c7d}
     * @returns mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getDeliveryReports()
    {
        $response = $this->httpClient->request("GET", "sms/v1/reports");

        return json_decode($response->getBody(), true);
    }

    /**
     * Get delivery reports with messageId
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#6402ce4e-d0d4-44ac-8606-a9d12a900974}
     *
     *
     * @param int $messageId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getDeliveryReportsWithMessageId(int $messageId)
    {
        if ($messageId < 0) {
            throw new InvalidArgumentException("Invalid Message ID. Message ID can not be negative.");
        }
        $response = $this->httpClient->request("GET", "sms/v1/reports?messageId={$messageId}");

        return json_decode($response->getBody(), true);
    }

    /**
     *
     * GET Get delivery reports with specific date range
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#46fc5c9c-0cd4-4356-8cab-1e326e54940a}
     *
     * [
     *  'sentSince' => '',
     *  'sentUntil' => '',
     * ]
     * @param array $data
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getDeliveryReportsWithSpecificDateRange(array $data)
    {
        if (! array_key_exists('sentSince', $data)) {
            throw new InvalidArgumentException("Sent since date is required.");
        }
        if (! array_key_exists('sentUntil', $data)) {
            throw new InvalidArgumentException("Sent until date is required.");
        }

        $response = $this->httpClient->get("sms/v1/reports?sentSince{$data['sentSince']}=&sentUntil={$data['sentUntil']}");

        return json_decode($response->getBody(), true);
    }

    /**
     * Get all sent SMS logs
     *
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#493fa3f2-c96d-44cc-892d-b6e166dd0683}
     * [
     *      'from' =>'2020-02-01',
     *      'limit' =>'10',
     *      'offset' =>'10'
     *  ]
     * @param array $data
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAllSentSmsLogs(array $data)
    {
        if (! array_key_exists('from', $data)) {
            throw new InvalidArgumentException("From field is required.");
        }
        if (! array_key_exists('limit', $data)) {
            throw new InvalidArgumentException("Limit count is required.");
        }
        if (! array_key_exists('offset', $data)) {
            throw new InvalidArgumentException("Offset count is required.");
        }
        $response = $this->httpClient->get("sms/v1/logs?from={$data['from']}&limit={$data['limit']}&offset={$data['offset']}");

        return json_decode($response->getBody(), true);
    }

    /**
     * Get all sent SMS logs with optional parameter
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#493fa3f2-c96d-44cc-892d-b6e166dd0683}
     *
     * [
     *  'from' => 'NEXTSMS',
     *  'to' => '255716718040',
     *  'sentSince' => '2020-02-01',
     *  'sentUntil' => '2020-02-20'
     * ]
     * @param array $data
     *
     * @returns mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAllSentSms(array $data)
    {
        if (! array_key_exists('from', $data)) {
            throw new InvalidArgumentException("From field is required.");
        }
        if (! array_key_exists('to', $data)) {
            throw new InvalidArgumentException("To  is required.");
        }
        if (! array_key_exists('sentSince', $data)) {
            throw new InvalidArgumentException("Sent since date is required.");
        }
        if (! array_key_exists('sentUntil', $data)) {
            throw new InvalidArgumentException("Sent until date is required.");
        }

        $response = $this->httpClient->get("sms/v1/logs?from={$data['from']}&to={$data['to']}&sentSince={$data['sentSince']}&sentUntil={$data['sentUntil']}");

        return json_decode($response->getBody(), true);
    }

    /**
     * Register Sub Customer
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#4d5c6a0a-9d16-45e2-ab8e-74211258ca00}
     * {
     *     first_name = 'Api',
     *     last_name = 'Customer',
     *     username = 'apicust',
     *     email = 'apicust@customer.com',
     *     phone_number = '0738234339',
     *     account_type = 'Sub Customer (Reseller)',
     *     sms_price = 20,
     * }
     *
     * @param array $data sub_customer
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function registerSubCustomer(array $data)
    {
        $response = $this->httpClient->request("POST", "sms/v1/sub_customer/create", [
            'json' => $data,
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Recharge customer
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#d3bd992c-08a8-400d-9b52-41fe6afecf44 }
     *
     *  [
     *      'email' => 'example@email.com',
     *      'smscount' => 5000
     *  ]
     *
     * @param array $data
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function rechargeCustomer(array $data)
    {
        if (! array_key_exists('email', $data)) {
            throw new InvalidArgumentException("Email is required.");
        }
        if (! array_key_exists('smscount', $data)) {
            throw new InvalidArgumentException("SMS count is required.");
        }

        $response = $this->httpClient->request("POST", "sms/v1/sub_customer/recharge", [
            'json' => $data,
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     *  Deduct customer
     *  To deduct your customer you are required to specify
     *  your customer email account which has been registered with the customer
     *  and smscount number of sms you want to deduct from a customer account.
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#570c9c63-4dc5-4ef5-aba5-1e4ba6d6d288}
     *
     *  [
     *    'email' => 'example@email.com',
     *    'smscount' => 2000
     *  ]
     *
     * @param array $data
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deductCustomer(array $data)
    {
        if (! array_key_exists('email', $data)) {
            throw new InvalidArgumentException("Email is required.");
        }
        if (! array_key_exists('smscount', $data)) {
            throw new InvalidArgumentException("SMS count is required.");
        }
        $response = $this->httpClient->request("POST", "sms/v1/sub_customer/deduct", [
            'json' => $data,
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Get sms balance
     *
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#570c9c63-4dc5-4ef5-aba5-1e4ba6d6d288}
     *
     * @returns mixed
     */
    public function getSmsBalance()
    {
        $response = $this->httpClient->request("GET", "sms/v1/balance");

        return json_decode($response->getBody(), true);
    }
}
