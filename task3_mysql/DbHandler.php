<?php

class DbHandler
{
    private $link;

    /**
     * DbHandler constructor.
     */
    public function __construct()
    {
        $this->connect();
    }

    /**
     * @return $this
     */
    private function connect()
    {
        $properties = require_once 'properties.php';
        $this->link = new PDO($properties['url'], $properties['user'], $properties['password']);
        return $this;
    }

    /**
     * @param $sql
     * @return mixed
     */
    public function execute($sql)
    {
        $stmt = $this->link->prepare($sql);
        return $stmt->execute();
    }

    /**
     * @param $sql
     * @return array
     */
    public function query($sql)
    {
        $stmt = $this->link->prepare($sql);
        $stmt->execute();

        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($rs === false) {
            return [];
        }
        return $rs;
    }
}