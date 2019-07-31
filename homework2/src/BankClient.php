<?php


namespace Banking;

class BankClient
{
    /**
     * @var Bank
     */
    private $bank;
    /**
     * @var integer
     */
    private $id;

    /**
     * BankClient constructor.
     * @param Bank $bank
     * @param int $id
     */
    public function __construct(Bank $bank, int $id)
    {
        $this->bank = $bank;
        $this->id = $id;
    }

    /**
     * @return Bank
     */
    public function getBank(): Bank
    {
        return $this->bank;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

}