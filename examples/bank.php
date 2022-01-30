<?php

require '../vendor/autoload.php';

use Almutasi\Main;
use Almutasi\Support\Helper;
use Almutasi\Support\Constant;

$mode = Constant::SANDBOX;
$apiToken = 'your api token is here';
$privateKey = 'your private key here';

$almutasi = new Main($mode, $apiToken, $privateKey);

// Initialize the library
$almutasi->init();

// Enable debugging, optional
// $almutasi->debug();

// Load Bank service
$bank = $almutasi->bank();

// Get bank logins
$logins = $bank->logins([
    'status' => 'active'
]);
print_r($logins);

// Get bank accounts
$accounts = $bank->accounts([
    'status' => 'active'
]);
print_r($accounts);

// Get bank mutations
$mutations = $bank->mutations([
    'service_code' => 'bri',
    'account_number' => '1234567890',
    'credit' => "10000.00"
]);
print_r($mutations);
