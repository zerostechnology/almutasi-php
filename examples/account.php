<?php

require '../vendor/autoload.php';

use Almutasi\Main;
use Almutasi\Support\Helper;
use Almutasi\Support\Constant;

$mode = Constant::SANDBOX;
$apiKey = 'your api key is here';
$privateKey = 'your private key here';

$almutasi = new Main($mode, $apiKey, $privateKey);

// Enable debugging, optional
// $almutasi->debug();

// Load Account service
$account = $almutasi->account();

// Get balance
$balance = $account->balance();
print_r($balance);
