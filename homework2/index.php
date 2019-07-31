<?php

use Banking\Bank;
use Banking\BankAccount;
use Banking\BankClient;
use Banking\BankTransfer;
use Banking\enum\Currency;

require_once __DIR__ . '/vendor/autoload.php';

$bank1 = new Bank(1);
$bank2 = new Bank(2);

$client1 = new BankClient($bank1, 1);
$client2 = new BankClient($bank2, 2);

$account1 = new BankAccount($client1, Currency::RUB);
$account2 = new BankAccount($client2, Currency::RUB);

$account1->addToBalance(100);

$transfer = new BankTransfer($account1, $account2, 100);

if ($transfer->doTransfer()) {
    echo 'transfer has been done successfully. account1 balance is: ' . $account1->getBalance() . PHP_EOL;
} else {
    echo 'ehh' . PHP_EOL;
};


