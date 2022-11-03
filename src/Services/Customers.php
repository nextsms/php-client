<?php

declare(strict_types=1);

namespace Nextsms\Nextsms\Services;

use Nextsms\Nextsms\ValueObjects\Customer;

class Customers
{
    protected $httpClient;

    public function __construct($httpClient) {
        $this->httpClient = $httpClient;
    }
    /**
     * Register Sub Customer
     * ```php
     * $data = [
     *     "first_name" => "Api",
     *     "last_name" => "Customer",
     *     "username" => "api_customer",
     *     "email" => "apicust@customer.com",
     *     "phone_number" => "0738234339",
     *     "account_type" => "Sub Customer (Reseller)",
     *     "sms_price" => "20",
     * ];
     * ```
     *
     * @param array $data sub_customer
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function register(array|Customer $data)
    {
        if ($data instanceof Customer) {
            $data = $data->toArray();
        }
        $response = $this->httpClient->request(
            "POST",
            "sms/v1/sub_customer/create",
            ['json' => $data]
        );

        return json_decode((string)$response->getBody(), true);
    }

    /**
     * Recharge customer
     *
     * ```php
     * $data = [
     *      "email" => "example@email.com",
     *      "smscount" => 5000
     * ];
     * ```
     *
     * @param array $data
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function recharge(string|Customer $customer, int $smsCount)
    {
        if ($customer instanceof Customer) {
            $customer = $customer->email;
        }

        $response = $this->httpClient->request(
            "POST",
            "sms/v1/sub_customer/recharge",
            ["json" => ['email' => $customer,'smscount' => $smsCount]]
        );

        return json_decode((string)$response->getBody(), true);
    }

    /**
     * Deduct customer
     *
     * To deduct your customer you are required to specify
     * your customer email account which has been registered with the customer
     * and smscount number of sms you want to deduct from a customer account.
     *
     * Example
     * ```php
     *  $data = [
     *    'email' => 'example@email.com',
     *    'smscount' => 2000
     * ];
     * ```
     *
     * @param array $data
     * @return array
     */
    public function deduct(string|Customer $customer, int $smsCount)
    {
        if ($customer instanceof Customer) {
            $customer = $customer->email;
        }
        $response = $this->httpClient->request(
            "POST",
            "sms/v1/sub_customer/deduct",
            ["json" => [
                'email' => $customer,
                'smscount' => $smsCount
            ]]
        );

        return json_decode((string)$response->getBody(), true);
    }
}
