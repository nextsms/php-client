<?php

declare(strict_types=1);

namespace Nextsms\Nextsms\Services;

use Nextsms\Nextsms\ValueObjects\Message;

class Messages
{
    protected $httpClient;

    public function __construct($httpClient)
    {
        $this->httpClient = $httpClient;
    }

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
    public function send(array|Message $data)
    {
        if (is_array($data)) {
            foreach (['to', 'text'] as $key) {
                if (! array_key_exists($key, $data)) {
                    throw new \InvalidArgumentException("{$key} is required.");
                }
            }
        }
        if ($data instanceof Message) {
            $data = $data->toArray();
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
    public function sendMany(array $data)
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
     * ```php
     * send([
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
    public function multipleMessagesToMultipleDifferentDestinations(array $data)
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
     * $client->messages()->sendLater(
     *      $message,
     *      \DateTime::createFromFormat('Y-m-d H:i:s', '2020-10-01 12:00:00'))
     * );
     * // Or
     * $client->messages()->sendLater([
     *     "to" =>  "255716718040",
     *     "text" =>  "Your message",
     * ], \DateTime::createFromFormat('Y-m-d H:i', '2020-10-01 12:00'));
     * ```
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#59cc2941-482b-45ab-9721-a7abffc83bba}
     *
     * @param array $data
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendLater(array|Message $data, string|\DateTime $date)
    {
        if ($data instanceof Message) {
            $data = $data->toArray();
        }

        foreach (['to', 'text'] as $key) {
            if (! array_key_exists($key, $data)) {
                throw new \InvalidArgumentException("{$key} is required.");
            }
        }

        $response = $this->httpClient->request(
            "POST",
            "sms/v1/text/single",
            ["json" => [
                "from" => $data['from'],
                "to" => $data['to'],
                "text" => $data['text'],
                "date" => $date instanceof \DateTime ? $date->format('Y-m-d') : $date,
                "time" => $date instanceof \DateTime ? $date->format('H:i') : $date,
            ]]
        );

        return json_decode((string)$response->getBody(), true);
    }

    /**
     * Get all sent SMS logs with optional parameter
     *
     * ```php
     * $client->messages()->getSent(
     *      query: ["from" => "NEXTSMS","to" => "255716718040"],
     *      sentSince: \DateTime::createFromFormat('Y-m-d H:i:s', '2020-10-01 12:00:00'),
     *      sentUntill: \DateTime::createFromFormat('Y-m-d H:i:s', '2020-10-01 12:00:00')
     * );
     * ```
     *
     * @param array $data
     * @return array
     */
    public function getSent(
        array $data,
        string|\DateTime $sentSince = null,
        string|\DateTime $sentUntill = null,
    ) {
        // todo: implement this
        foreach (['from', 'to'] as $key) {
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
    public function balance()
    {
        $response = $this->httpClient->request("GET", "sms/v1/balance");

        return json_decode((string)$response->getBody(), true);
    }
}
