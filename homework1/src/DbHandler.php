<?php

namespace Routing;

use PDO;

class DbHandler
{
    private $link;

    /**
     * DbHandler constructor.
     * @param $pdo
     */
    public function __construct($pdo)
    {
        $this->link = $pdo;
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