<?php

namespace Banking\Tests;

use Banking\Bank;
use Banking\BankAccount;
use Banking\BankClient;
use Banking\BankTransfer;
use Banking\enum\Currency;
use PHPUnit\Framework\TestCase;

class BankAccountTest extends TestCase
{
    /**
     * @var BankAccount
     */
    private $bankAccount;

    public function setUp(): void
    {
        $clientMock = new BankClient(new Bank(1), 1);
        $this->bankAccount = new BankAccount($clientMock, Currency::RUB);
    }

    public function tearDown(): void
    {
        $this->bankAccount = null;
    }

    /**
     * @dataProvider balanceAddedProvider
     */
    public function testBalanceAdded(float $toBeAdded): void
    {
        $startBalance = $this->bankAccount->getBalance();
        $expectedBalance = $startBalance + $toBeAdded;
        $newBalance = $this->bankAccount->addToBalance($toBeAdded);
        $this->assertEquals($expectedBalance, $newBalance);
    }

    /**
     * @dataProvider balanceSubtractedProvider
     */
    public function testBalanceSubtracted(float $toBeSubtracted): void
    {
        $startBalance = $this->bankAccount->getBalance();
        $expectedBalance = $startBalance - $toBeSubtracted;
        $newBalance = $this->bankAccount->subtractFromBalance($toBeSubtracted);
        $this->assertEquals($expectedBalance, $newBalance);
    }

    public function balanceAddedProvider(): array
    {
        return [
            [20],
            [100000000000],
            [-123],
            [0]
        ];
    }

    public function balanceSubtractedProvider(): array
    {
        return [
            [52],
            [1000000000],
            [-56],
            [0]
        ];
    }
}