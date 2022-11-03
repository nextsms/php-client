<?php

declare(strict_types=1);

namespace Nextsms\Nextsms\Services;

class Message
{
    /**
     *
     * Send SMS to Single destination/recipient
     * Example
     * ```php
     * $nextsms->singleDestination([
     *  'from' => 'NEXTSMS',
     *  'to' => '255716718040',
     *  'text' => 'Your message'
     * ]);
     * ```
     *
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#5e466440-829b-4b56-be32-b681e4f81227}
     * @return mixed
     * @throws InvalidArgumentException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function singleDestination(array $data)
    {
        foreach (['to', 'text'] as $key) {
            if (! array_key_exists($key, $data)) {
                throw new \InvalidArgumentException("{$key} is required.");
            }
        }

        $url = "sms/v1/text/single";
        if ($this->options['environment'] == 'testing') {
            $url = "sms/v1/test/text/single";
        }
        $response = $this->httpClient->request("POST", $url, ['json' => $data]);

        return json_decode((string)$response->getBody(), true);
    }

    /**
     *
     *  Multiple destinations
     *  For sending the single messages to multiple phone numbers,
     *
     * ```php
     * [
     *  "from" => "NEXTSMS",
     *  "to" => ['255655912841', '255716718040'],
     *  "text" => "Your message"
     * ]
     * ```
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#2936eed4-6027-45e7-92c9-fe1cd7df140b}
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function multipleDestinations(array $data)
    {
        if (! array_key_exists('from', $data)) {
            throw new \InvalidArgumentException("From field is required.");
        }
        if (! array_key_exists('text', $data)) {
            throw new \InvalidArgumentException("Message text is required.");
        }
        if (! array_key_exists('to', $data)) {
            throw new \InvalidArgumentException("Recipient Numbers are required.");
        }
        $url = "sms/v1/text/multi";
        if ($this->options['environment'] == 'testing') {
            $url = "sms/v1/test/text/multi";
        }

        $response = $this->httpClient->request("POST", $url, [
            'json' => $data,
        ]);

        return json_decode((string)$response->getBody(), true);
    }

    /**
     *
     *   Multiple messages to Multiple different destinations (Format 1)
     *```php
     * ([
     *     "messages" => [
     *         [ "from" => "NEXTSMS", "to" =>  "255716718040", "text" =>  "Your message" ],
     *         [ "from" => "NEXTSMS", "to" =>  "255655912841", "text" =>  "Your other message" ],
     *     ],
     * ]);
     * ```
     *
     * @param array $data
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#b13825ab-8b49-45f5-a4cd-fb7d21aa975a }
     */
    public function multipleMessagesToMultipleDestinations(array $data)
    {
        if (! array_key_exists('messages', $data)) {
            throw new \InvalidArgumentException("Messages are required.");
        }
        $response = $this->httpClient->request("POST", "sms/v1/text/multi", [
            'json' => $data,
        ]);

        return json_decode((string)$response->getBody(), true);
    }

    /**
     *
     * Multiple messages to Multiple destinations (Format 2)
     * For sending the multiple messages to multiple phone numbers,
     * ```php
     * $data = [
     *     "messages": [
     *         [
     *             "from" => "NEXTSMS",
     *             "to" =>  ["255716718040", "255758483019"],
     *             "text": "Your first message",
     *         ],
     *         [
     *             "from" => "NEXTSMS",
     *             "to" =>  ["255758483019", "255655912841", "255716718040"],
     *             "text": "Your other message",
     *         ],
     *     ],
     * ];
     * ```
     *
     *
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#6916415a-4645-460d-bb3f-a6d6fbd60e4a}
     * @param array $data
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function multipleMessagesToMultipleDifferentDestinations($data)
    {
        if (! array_key_exists('messages', $data)) {
            throw new \InvalidArgumentException("Messages are required.");
        }
        if (count($data['messages']) < 0) {
            throw new \InvalidArgumentException("Invalid Messages. Expected atleast one message");
        }
        foreach ($data['messages'] as $key => $message) {
            if (! array_key_exists('from', $message)) {
                throw new \InvalidArgumentException("From field is required. On message #" . $key);
            }
            if (! array_key_exists('text', $message)) {
                throw new \InvalidArgumentException("Message text is required. On message #" . $key);
            }
            if (! array_key_exists('to', $message)) {
                throw new \InvalidArgumentException("Recipient Numbers are required. On message #" . $key);
            }
        }

        $response = $this->httpClient->request("POST", "sms/v1/text/multi", [
            'json' => $data,
        ]);

        return json_decode((string)$response->getBody(), true);
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
     * Example
     *
     * ```php
     *  $data = [
     *     "from" =>  "SENDER",
     *     "to" =>  "255716718040",
     *     "text" =>  "Your message",
     *     "date" =>  "2020-10-01",
     *     "time" =>  "12:00",
     * ];
     * ```
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#59cc2941-482b-45ab-9721-a7abffc83bba}
     *
     * @param array $data
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function scheduleSms(array $data)
    {
        foreach (['messages', 'from', 'to', 'text', 'date','time'] as $key) {
            if (! array_key_exists($key, $data)) {
                throw new \InvalidArgumentException("{$key} is required.");
            }
        }

        $response = $this->httpClient->request(
            "POST",
            "sms/v1/text/single",
            ["json" => $data]
        );

        return json_decode((string)$response->getBody(), true);
    }

    /**
     *
     *  Get delivery reports with messageId
     *
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#5fc5b186-c4dc-4de0-9d0f-baee93d53c7d}
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getDeliveryReports()
    {
        $response = $this->httpClient->request("GET", "sms/v1/reports");

        return json_decode((string)$response->getBody(), true);
    }

    /**
     * Get delivery reports with messageId
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#6402ce4e-d0d4-44ac-8606-a9d12a900974}
     *
     *
     * @param int $messageId
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getDeliveryReportsWithMessageId(int $messageId)
    {
        if ($messageId < 0) {
            throw new \InvalidArgumentException("Invalid Message ID. Message ID can not be negative.");
        }
        $response = $this->httpClient->request("GET", "sms/v1/reports?messageId={$messageId}");

        return json_decode((string)$response->getBody(), true);
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
        foreach (['sentSince', 'sentUntil'] as $key) {
            if (! array_key_exists($key, $data)) {
                throw new \InvalidArgumentException("{$key} is required.");
            }
        }
        $response = $this->httpClient->get(
            "sms/v1/reports?sentSince{$data['sentSince']}=&sentUntil={$data['sentUntil']}"
        );

        return json_decode((string)$response->getBody(), true);
    }

    /**
     * Get all sent SMS logs
     *
     * ```php
     * $data = [
     *  "from" =>"2020-02-01",
     *  "limit" =>"10",
     *  "offset" =>"10"
     * ];
     * ```
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#493fa3f2-c96d-44cc-892d-b6e166dd0683}
     * @param array $data
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAllSentSmsLogs(array $data)
    {
        foreach (['from', 'limit', 'offset'] as $key) {
            if (! array_key_exists($key, $data)) {
                throw new \InvalidArgumentException("{$key} is required.");
            }
        }

        $response = $this->httpClient->get(
            "sms/v1/logs?from={$data['from']}&limit={$data['limit']}&offset={$data['offset']}"
        );

        return json_decode((string)$response->getBody(), true);
    }

    /**
     * Get all sent SMS logs with optional parameter
     *
     * ```php
     * $data = [
     *  "from" => "NEXTSMS",
     *  "to" => "255716718040",
     *  "sentSince" => "2020-02-01",
     *  "sentUntil" => "2020-02-20"
     * ];
     * ```
     *
     * @param array $data
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAllSentSms(array $data)
    {
        foreach (['from', 'to', 'sentSince', 'sentUntil'] as $key) {
            if (! array_key_exists($key, $data)) {
                throw new \InvalidArgumentException("{$key} is required.");
            }
        }

        $response = $this->httpClient->get(
            "sms/v1/logs?from={$data['from']}&to={$data['to']}&sentSince={$data['sentSince']}&sentUntil={$data['sentUntil']}"
        );

        return json_decode((string)$response->getBody(), true);
    }

        /**
     * Get current SMS balance
     *
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#570c9c63-4dc5-4ef5-aba5-1e4ba6d6d288}
     *
     * @return array
     */
    public function getSmsBalance()
    {
        $response = $this->httpClient->request("GET", "sms/v1/balance");

        return json_decode((string)$response->getBody(), true);
    }
}
