<?php

namespace Banking;
class BankTransfer
{
    /**
     * @var BankAccount
     */
    private $senderAccount;
    /**
     * @var BankAccount
     */
    private $receiverAccount;
    /**
     * @var float
     */
    private $value; //кста деньги во float это плохо :(
    /**
     * @var float
     */
    private $total; //кста деньги во float это плохо :(

    public function __construct(BankAccount $senderAccount, BankAccount $receiverAccount, float $value)
    {
        $this->senderAccount = $senderAccount;
        $this->receiverAccount = $receiverAccount;
        $this->value = $value;
    }

    public function doTransfer(): bool
    {
        if ($this->checkTransfer()) {
            $this->completeTransfer();
            return true;
        }
        return false;
    }

    private function checkTransfer(): bool
    {
        $this->total = $this->checkInterbank() ? $this->value * 1.05 : $this->value;

        return !$this->checkIntercurrency() && ($this->senderAccount->getBalance() >= $this->total
            && $this->senderAccount->getBalance() > 0);
    }

    private function checkInterbank(): bool
    {
        return $this->senderAccount->getBankClient()->getBank()->getId()
            != $this->receiverAccount->getBankClient()->getBank()->getId();
    }

    private function checkIntercurrency(): bool
    {
        if (strcasecmp($this->senderAccount->getCurrency(), $this->receiverAccount->getCurrency()) == 0)
            return false;
        return true;
    }

    private function completeTransfer(): void
    {
        $this->senderAccount->subtractFromBalance($this->total);
        $this->receiverAccount->addToBalance($this->value);
    }
}