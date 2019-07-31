<?php


namespace Banking\Tests;


use Banking\Bank;
use Banking\BankAccount;
use Banking\BankClient;
use Banking\BankTransfer;
use Banking\enum\Currency;
use PHPUnit\Framework\TestCase;

class BankTransferTest extends TestCase
{
     /**
     * @dataProvider interbankTransactionProvider
     */
    public function testTransaction(BankAccount $sender, BankAccount $receiver, $value, $expected): void
    {
        $transfer = new BankTransfer($sender, $receiver, $value);
        $this->assertEquals($expected, $transfer->doTransfer());
    }
    /**
     * @dataProvider senderBalanceProvider
     */
    public function testSenderBalance(BankAccount $sender, BankAccount $receiver, $value, $expected): void
    {
        $transfer = new BankTransfer($sender, $receiver, $value);
        $transfer->doTransfer();
        $senderBalance = $sender->getBalance();
        $this->assertEquals($expected, $senderBalance);
    }
    /**
     * @dataProvider receiverBalanceProvider
     */
    public function testReceiverBalance(BankAccount $sender, BankAccount $receiver, $value): void
    {
        $transfer = new BankTransfer($sender, $receiver, $value);
        $expected = $receiver->getBalance() + $value;
        $transfer->doTransfer();
        $receiverBalance = $receiver->getBalance();
        $this->assertEquals($expected, $receiverBalance);
    }

    //public function testReceiverbalance()

    public function interbankTransactionProvider()
    {
        $bankClient1 = new BankClient(new Bank(1), 1);
        $bankClient2 = new BankClient(new Bank(2), 2);

        $account1 = new BankAccount($bankClient1, Currency::RUB);
        $account2 = new BankAccount($bankClient1, Currency::RUB);
        $account3 = new BankAccount($bankClient2, Currency::RUB);
        $account4 = new BankAccount($bankClient1, Currency::EUR);
        $account5 = new BankAccount($bankClient1, Currency::RUB);

        $account5->addToBalance(10000);

        return [
            [$account1, $account2, 200, false], //одноного банка, нет на счету
            [$account1, $account3, 201, false], //разных банков, нет на счету
            [$account1, $account4, 202, false], //нет на счету и разные валюты
            [$account5, $account1, 204, true], //одного банка, счет не пустой
            [$account5, $account3, 205, true], //разных банков, счет не пустой
            [$account5, $account4, 206, false], //счет не пустой и разные валюты
        ];
    }

    public function senderBalanceProvider()
    {
        $bankClient1 = new BankClient(new Bank(1), 1);
        $bankClient2 = new BankClient(new Bank(2), 2);

        $account1 = new BankAccount($bankClient1, Currency::RUB);
        $account3 = new BankAccount($bankClient1, Currency::RUB);
        $account4 = new BankAccount($bankClient1, Currency::RUB);
        $account5 = new BankAccount($bankClient1, Currency::RUB);

        $account2 = new BankAccount($bankClient2, Currency::RUB);

        $account1->addToBalance(200);
        $account4->addToBalance(200);
        $account5->addToBalance(200);

        return [
            [$account1, $account2, 100, 95], //перевод с процентами
            [$account4, $account3, 100, 100], // перевод без процентов
            [$account5, $account3, 200, 0] //перевод всех средств
        ];
    }

    public function receiverBalanceProvider()
    {
        $bankClient1 = new BankClient(new Bank(1), 1);
        $bankClient2 = new BankClient(new Bank(2), 2);

        $account1 = new BankAccount($bankClient1, Currency::RUB);
        $account2 = new BankAccount($bankClient2, Currency::RUB);
        $account3 = new BankAccount($bankClient2, Currency::RUB);

        $account1->addToBalance(200);
        $account3->addToBalance(200);

        return [
            [$account1, $account2, 100],
            [$account3, $account2, 50]
        ];
    }
}