<?php


namespace Banking;


class Bank
{
    /**
     * @var integer
     */
    private $id;

    //Some other fields...

    /**
     * Bank constructor.
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}