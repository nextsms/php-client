<?php

declare(strict_types=1);

namespace Nextsms\Nextsms\Services;

class Message
{


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
    public function register(array $data)
    {
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
    public function recharge(string $email, int $smsCount)
    {
        $response = $this->httpClient->request(
            "POST",
            "sms/v1/sub_customer/recharge",
            ["json" => [
                'email' => $email,
                'smscount' => $smsCount
            ]]
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
    public function deduct(string $email, int $smsCount)
    {

        $response = $this->httpClient->request(
            "POST",
            "sms/v1/sub_customer/deduct",
            ["json" => [
                'email' => $email,
                'smscount' => $smsCount
            ]]
        );

        return json_decode((string)$response->getBody(), true);
    }
}
