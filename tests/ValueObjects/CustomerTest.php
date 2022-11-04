<?php

use Nextsms\Nextsms\ValueObjects\Customer;

test('tests/ValueObjects/CustomerTest.php', function () {
    $customer = Customer::create([
        "first_name" => "Api",
        "last_name" => "Customer",
        "username" => "apicust",
        "email" => "apicust@customer.com",
        "phone_number" => "0738234339",
        "account_type" => "Sub Customer (Reseller)",
        "sms_price" => 200,
    ]);

    expect($customer)->toBeInstanceOf(Customer::class);

    expect((string)$customer)->toBeJson();
});
