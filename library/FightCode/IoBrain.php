<?php

namespace FightCode;

use \Ratchet\ConnectionInterface;

class IoBrain extends Brain
{
    private $conn;

    public function __construct(ConnectionInterface $conn)
    {
        $this->conn = $conn;
    }

    public function onIdle(Robot $robot)
    {
    }
}
