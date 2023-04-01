<?php

declare(strict_types=1);

namespace Nextsms\Nextsms\Services;

use Nextsms\Nextsms\ValueObjects\Customer;

class Customers
{
    protected $httpClient;

    public function __construct($httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Register Sub Customer
     *
     * ```php
     * $customer = $client->customers()->create($customer);
     * // Or
     * $client->customers()->create([
     *     "first_name" => "Api",
     *     "last_name" => "Customer",
     *     "username" => "api_customer",
     *     "email" => "apicust@customer.com",
     *     "phone_number" => "0738234339",
     *     "account_type" => "Sub Customer (Reseller)",
     *     "sms_price" => "20",
     * ]);
     * ```
     */
    public function create(array|Customer $data): array
    {
        if ($data instanceof Customer) {
            $data = $data->toArray();
        }
        $response = $this->httpClient->request(
            'POST',
            'sms/v1/sub_customer/create',
            ['json' => $data]
        );

        return json_decode((string) $response->getBody(), true);
    }

    /**
     * Recharge customer
     * Example
     * ```php
     * $client->customers()->recharge("example@email.com", 300);
     * ```
     */
    public function recharge(string|Customer $customer, int $smsCount): array
    {
        if ($customer instanceof Customer) {
            $customer = $customer->email;
        }

        $response = $this->httpClient->request(
            'POST',
            'sms/v1/sub_customer/recharge',
            ['json' => ['email' => $customer, 'smscount' => $smsCount]]
        );

        return json_decode((string) $response->getBody(), true);
    }

    /**
     * Deduct customer
     *
     * To deduct your customer you are required to specify
     * your customer email account which has been registered with the customer
     * and sms count number of sms you want to deduct from a customer account.
     *
     * Example
     * ```php
     * $client->customers()->deduct("example@email.com", 300);
     * ```
     */
    public function deduct(string|Customer $customer, int $smsCount): array
    {
        if ($customer instanceof Customer) {
            $customer = $customer->email;
        }
        $response = $this->httpClient->request(
            'POST',
            'sms/v1/sub_customer/deduct',
            ['json' => [
                'email' => $customer,
                'smscount' => $smsCount,
            ]]
        );

        return json_decode((string) $response->getBody(), true);
    }
}
