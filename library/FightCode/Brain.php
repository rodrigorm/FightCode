<?php

namespace FightCode;

class Brain
{
    public function onIdle(Robot $robot)
    {
        $robot->moveRight(100);
        $robot->moveLeft(100);
    }
}
