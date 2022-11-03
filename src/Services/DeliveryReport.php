<?php

declare(strict_types=1);

namespace Nextsms\Nextsms\Services;

use Nextsms\Nextsms\ValueObjects\Message;

class DeliveryReports
{
    protected $httpClient;

    public function __construct($httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     *
     *  Get delivery reports with messageId
     *
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#5fc5b186-c4dc-4de0-9d0f-baee93d53c7d}
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function all()
    {
        $response = $this->httpClient->request("GET", "sms/v1/reports");

        return json_decode((string)$response->getBody(), true);
    }

    /**
     * Get delivery reports with messageId
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#6402ce4e-d0d4-44ac-8606-a9d12a900974}
     *
     *
     * @param int|string|Message $messageId
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function find(int|string|Message $messageId)
    {
        if ($messageId instanceof Message) {
            $messageId = $messageId->toArray()['messageId'];
        }

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
    public function range(array $data)
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


}
