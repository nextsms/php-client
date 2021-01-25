<?php

namespace NextSMS\SDK;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * @package NextSMS\SDK
 * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#intro}
 *
 * @version 0.1.0
 * @author Alpha Olomi
 */
class NextSMS
{

    /**
     * enviroment
     */
    private string $enviroment; // 'testing' | 'production';

    /**
     * key
     */
    private string $key;

    /**
     * header
     */
    private mixed $header;

    /**
     * root
     */
    private $ROOT_URL = 'https://messaging-service.co.tz/';

    /**
     * base url
     */
    private string $base_url;

    /**
     * HTTP client
     */
    private  $client;

    /**
     * 'testing' | 'production'
     * @param options mixed
     * @param client
     * @return void
     */
    public function  __constructor($options, $client)
    {
        $this->key = base64_encode("{$options['username']}:{$options['password']}");
        $this->enviroment = $options['enviroment'];
        $this->client = ($client instanceof Client) ? $client : new Client([
            'headers' => [
                'Accept' => 'application/json',
                'http_errors' => false,
                'Authorization' => `Basic ${this . key}`,
                'Content-Type' => 'application/json'
            ]
        ]);
        $this->base_url = '';
    }

    /**
     *
     * Send Sms to Single destination
     *
     *
     * {
     *  from = 'NEXTSMS',
     *  to = '255716718040',
     *  text = 'Your message'
     * }
     *
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#5e466440-829b-4b56-be32-b681e4f81227}
     * @returns {Promise}
     */
    public function  single_destination($data)
    {
        $response = $this->client->post("https://messaging-service.co.tz/api/sms/v1/test/text/single", [
            'json' => $data,
        ]);
        return json_decode($response->getBody(), true);
    }

    /**
     *
     *  Multiple destinations
     * For sending the single messages to multiple phone numbers,
     *
     * {
     *  from = 'NEXTSMS',
     *  to = ['255655912841', '255716718040'],
     *  text = 'Your message'
     * }
     *
     * * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#2936eed4-6027-45e7-92c9-fe1cd7df140b}
     * @returns {Promise}
     */
    public function  multiple_destinations($data)
    {

        $response = $this->client->post("https://messaging-service.co.tz/api/sms/v1/test/text/multi", [
            'json' => $data,
        ]);
        return json_decode($response->getBody(), true);
    }
    /**
     *
     *   Multiple messages to Multiple destinations (Format 1)
     *
     * {
     *     messages = [
     *         { from: 'NEXTSMS', to: '255716718040', text: 'Your message' },
     *         { from: 'NEXTSMS', to: '255655912841', text: 'Your other message' },
     *     ],
     * }
     * @param data
     *
     *
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#b13825ab-8b49-45f5-a4cd-fb7d21aa975a }
     * @returns {Promise}
     */
    public function   multiple_messages_to_multiple_destinations_example1($data)
    {
        $response = $this->client->post("https://messaging-service.co.tz/api/sms/v1/text/multi", [
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
     * @returns {Promise}
     */
    public function  multiple_messages_to_multiple_destinations($data)
    {
        $response = $this->client->post("https://messaging-service.co.tz/api/sms/v1/text/multi", [
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
     *   date - date of the day to which you want to send your sms, format of Year-month-date exapmle:2020-10-01
     *   time - time of the day to which you want to send your sms, 24 hours format exapmle:12:00
     *
     *   Optional parameters to the schedule sms
     *   repeat - you can add this parameter when you want your sms to be repeated. This must be with these values in order to work: hourly, daily, weekly or monthly
     *   start_date - this parameter defines the date from this your sms can start sending, format of Year-month-date exapmle:2020-10-01.
     *   end_date - this parameter defines the date from this your sms can end sending, format of Year-month-date exapmle:2021-01-01.
     *
     *
     *   {
     *     from: 'SENDER',
     *     to: '255716718040',
     *     text: 'Your message',
     *     date: '2020-10-01',
     *     time: '12:00',
     *   }
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#59cc2941-482b-45ab-9721-a7abffc83bba}
     *
     * @param data
     *
     * @returns {Promise}
     *
     */
    public function  schedule_sms($data)
    {

        $response = $this->client->post("https://messaging-service.co.tz/api/sms/v1/text/single", [
            'json' => $data,
        ]);
        return json_decode($response->getBody(), true);
    }

    // - Sms Delivery Reports

    /**
     *
     * GET Get delivery reports with messageId
     *
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#5fc5b186-c4dc-4de0-9d0f-baee93d53c7d}
     * @returns {Promise}
     */
    public function  get_delivery_reports()
    {
        $response = $this->client->get("https://messaging-service.co.tz/api/sms/v1/reports", [
            'json' => $data,
        ]);
        return json_decode($response->getBody(), true);
    }

    /**
     * Get delivery reports with messageId
     *
     *
     * @param int messageId
     *
     *
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#6402ce4e-d0d4-44ac-8606-a9d12a900974}
     * @returns {Promise}
     */
    public function   get_delivery_reports_with_message_id(int $messageId)
    {
        $response = $this->client->get("https://messaging-service.co.tz/api/sms/v1/reports?messageId={$messageId}");
        return json_decode($response->getBody(), true);
    }

    /**
     *
     * GET Get delivery reports with specific date range
     * @param sentSince
     * @param sentUntil
     *
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#46fc5c9c-0cd4-4356-8cab-1e326e54940a}
     * @returns {Promise}
     */
    public function   get_delivery_reports_with_specific_date_range(string $sentSince, string $sentUntil)
    {
        $response = $this->client->get("https://messaging-service.co.tz/api/sms/v1/reports?sentSince{$sentSince}=&sentUntil={$sentUntil}");
        return json_decode($response->getBody(), true);
    }

    // - Sent Sms Logs

    /**
     *
     * GET Get all sent SMS logs
     * @param from
     * @param limit
     * @param offset
     *
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#493fa3f2-c96d-44cc-892d-b6e166dd0683}
     * @returns {Promise}
     */
    public function  get_all_sent_sms_logs(string $from, int $limit, int $offset)
    {
        $response = $this->client->get("https://messaging-service.co.tz/api/sms/v1/logs?from={$from}&limit={$limit}&offset={$offset}");
        return json_decode($response->getBody(), true);
    }

    /**
     *  GET Get all sent SMS logs with optional parameter
     *
     *
     * from=NEXTSMS
     * to=255716718040
     * sentSince=2020-02-01
     * sentUntil=2020-02-20
     *
     * @param from  string
     * @param to string
     * @param sentSince string
     * @param sentUntil string
     *
     *
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#493fa3f2-c96d-44cc-892d-b6e166dd0683}
     * @returns {Promise}
     */
    public function  get_all_sent_sms(string $from, string $to, string $sentSince, string $sentUntil)
    {
        $response = $this->client->get("https://messaging-service.co.tz/api/sms/v1/logs?from={$from}&to={$to}&sentSince={$sentSince}&sentUntil={$sentUntil}", [
            'json' => $data,
        ]);
        return json_decode($response->getBody(), true);
    }

    /**
     *
     * - Sub Customer
     *   - POST Register Sub Customer
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
     * @param data sub_customer
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#4d5c6a0a-9d16-45e2-ab8e-74211258ca00}
     * @returns {Promise}
     */
    public function  register_sub_customer($data)
    {
        $response = $this->client->post("https://messaging-service.co.tz/api/sms/v1/sub_customer/create", [
            'json' => $data,
        ]);
        return json_decode($response->getBody(), true);
    }

    /**
     *  Recharge customer
     *
     *  {
     *      email = 'example@email.com',
     *      smscount = 5000
     *  }
     *
     * @param data recharge_customer
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#d3bd992c-08a8-400d-9b52-41fe6afecf44 }
     * @returns {Promise}
     */
    public function recharge_customer($data)
    {
        $response = $this->client->post("https://messaging-service.co.tz/api/sms/v1/sub_customer/recharge", [
            'json' => $data,
        ]);
        return json_decode($response->getBody(), true);
    }

    /**
     *  Deduct customer
     *  To deduct your customer you are required to specify
     *  your customer email account which has been registered with the customer
     *  and smscount number of sms you want to deduct from a customer account.
     *
     *  {
     *      email = 'example@email.com',
     *      smscount = 2000
     *  }
     *
     *  @param data deduct_customer
     *  @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#570c9c63-4dc5-4ef5-aba5-1e4ba6d6d288}
     *  @returns {Promise}
     */
    public function deduct_customer($data)
    {
        $response = $this->client->post("https://messaging-service.co.tz/api/sms/v1/sub_customer/deduct", [
            'json' => $data,
        ]);
        return json_decode($response->getBody(), true);
    }

    /**
     *
     * Get sms balance
     *
     * @see {@link https://documenter.getpostman.com/view/4680389/SW7dX7JL#570c9c63-4dc5-4ef5-aba5-1e4ba6d6d288}
     *
     * @returns {Promise}
     */
    public function get_sms_balance()
    {
        $response = $this->client->get("https://messaging-service.co.tz/api/sms/v1/balance", [
            'json' => $data,
        ]);
        return json_decode($response->getBody(), true);
    }
}
