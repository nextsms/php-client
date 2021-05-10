<?php
require 'vendor/autoload.php';

use \NextSMS\SDK\NextSMS;

// Intiate with credentials
$client = new NextSMS([
    'username' => '',
    'password' => '',
    'environment' => 'production', // or testing
]);

// Setup
$data = [
    'from'  => 'NEXTSMS',
    'to'    => '2557',
    'text'  => 'Hello World',
];

// attempt send
try {
    // $result = $client->getSmsBalance();
    $result = $client->singleDestination($data);
    // Print results
    var_dump($result);
} catch (\Throwable $th) {
    //throw $th;

}
