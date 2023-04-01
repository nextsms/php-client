<?php

declare(strict_types=1);

namespace Nextsms\Nextsms\Services;

use Nextsms\Nextsms\ValueObjects\Message;

class DeliveryReport
{
    protected $httpClient;

    private $sentSince;

    private $sentUntil;

    public function __construct($httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Get delivery reports with messageId
     * ```php
     * $reports = $client->reports()->all();
     * ```
     */
    public function all(): array
    {
        $response = $this->httpClient->request('GET', 'sms/v1/reports');

        return json_decode((string) $response->getBody(), true);
    }

    /**
     * Get delivery reports with messageId
     * ```php
     * $reports = $client->reports()->find('123123');
     * // Or
     * $reports = $client->reports()->find($messageId);
     * ```
     */
    public function find(int|string|Message $messageId): array
    {
        if ($messageId instanceof Message) {
            $messageId = $messageId->toArray()['messageId'];
        }

        if ($messageId < 0) {
            throw new \InvalidArgumentException('Invalid Message ID. Message ID can not be negative.');
        }

        $response = $this->httpClient->request('GET', "sms/v1/reports?messageId={$messageId}");

        return json_decode((string) $response->getBody(), true);
    }

    public function sendSince(string|\Datetime $date): static
    {
        if ($date instanceof \Datetime) {
            $date = $date->format('Y-m-d');
        }
        $this->sentSince = $date;

        return $this;
    }

    public function sentUntil(string|\Datetime $date): static
    {
        if ($date instanceof \Datetime) {
            $date = $date->format('Y-m-d');
        }
        $this->sentUntil = $date;

        return $this;
    }

    /**
     * Get delivery reports
     *
     * ```php
     * $reports = $client->reports()
     *   ->query()
     *   // Using date string
     *   ->sentFrom(date: '01-01-2022')
     *   // Or using date object
     *   ->sentUntil(date: \DateTime::create('now'))
     *   ->get();
     * ```
     */
    public function get(): array
    {
        $response = $this->httpClient->get(
            "sms/v1/reports?sentSince{$this->sentSince}=&sentUntil={$this->sentUntil}"
        );

        return json_decode((string) $response->getBody(), true);
    }

    /**
     * Get all sent SMS logs
     * Example
     * ```php
     * $client->reports()->logs(from :"2020-02-01");
     * ```
     */
    public function logs(string $from, int $limit = 10, int $offset = 10): array
    {
        $response = $this->httpClient->get(
            "sms/v1/logs?from={$from}&limit={$limit}&offset={$offset}"
        );

        return json_decode((string) $response->getBody(), true);
    }
}
