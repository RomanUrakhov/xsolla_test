<?php

namespace Banking;
use Banking\enum\Currency;
use phpDocumentor\Reflection\Types\Integer;

class BankAccount
{
    /**
     * @var BankClient
     */
    private $bankClient;
    /**
     * @var float
     */
    private $balance = 0; //кста деньги во float это плохо :(
    /**
     * @var integer
     */
    private $currency;

    public function __construct(BankClient $bankClient, int $currency)
    {
        $this->bankClient = $bankClient;
        $this->currency = $currency;
    }

    public function getBankClient(): BankClient
    {
        return $this->bankClient;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function addToBalance(float $value): float
    {
        $this->balance += $value;
        return $this->balance;
    }

    public function subtractFromBalance(float $value): float
    {
        $this->balance -= $value;
        return $this->balance;
    }
}