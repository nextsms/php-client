<?php

namespace Nextsms\Nextsms\ValueObjects;

/**
 * @author Alphs Olomi
 *
 * @version 2.0
 */
class Customer
{
    public ?string $firstName = null;

    public ?string $lastName = null;

    public ?string $username = null;

    public ?string $email = null;

    public ?string $phoneNumber = null;

    public ?string $accountType = null;

    public ?string $smsPrice = null;

    public function __construct()
    {
    }

    public static function make(array $data): Customer
    {
        $customer = new self();
        $customer->firstName = $data['first_name'] ?? null;
        $customer->lastName = $data['last_name'] ?? null;
        $customer->username = $data['username'] ?? null;
        $customer->email = $data['email'] ?? null;
        $customer->phoneNumber = $data['phone_number'] ?? null;
        $customer->accountType = $data['account_type'] ?? null;
        $customer->smsPrice = $data['sms_price'] ?? null;

        return $customer;
    }

    public function __toString()
    {
        return json_encode([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'username' => $this->username,
            'email' => $this->email,
            'phone_number' => $this->phoneNumber,
            'account_type' => $this->accountType,
            'sms_price' => $this->smsPrice,
        ], JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    public function toArray(): array
    {
        return [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'username' => $this->username,
            'email' => $this->email,
            'phone_number' => $this->phoneNumber,
            'account_type' => $this->accountType,
            'sms_price' => $this->smsPrice,
        ];
    }
}
