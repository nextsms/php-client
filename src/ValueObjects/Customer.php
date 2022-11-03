<?php

namespace Nextsms\Nextsms\ValueObjects;

class Customer
{
    protected string $firstName;

    protected string $lastName;

    protected string $username;

    protected string $email;

    protected string $phoneNumber;

    protected string $accountType;

    protected string $smsPrice;


    public function __construct(string $firstName, string $lastName, string $username, string $email, string $phoneNumber, string $accountType, string $smsPrice)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->username = $username;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->accountType = $accountType;
        $this->smsPrice = $smsPrice;
    }

    // create
    public static function create(array $data)
    {
        return new self(
            $data['first_name'],
            $data['last_name'],
            $data['username'],
            $data['email'],
            $data['phone_number'],
            $data['account_type'],
            $data['sms_price']
        );
    }

    // tostring
    public function __toString()
    {
        return json_encode([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'username' => $this->username,
            'email' => $this->email,
            'phone_number' => $this->phoneNumber,
            'account_type' => $this->accountType,
            'sms_price' => $this->smsPrice
        ], JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}
