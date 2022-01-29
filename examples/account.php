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

// Load Account service
$account = $almutasi->account();

// Get balance
$balance = $account->balance();
echo $balance;