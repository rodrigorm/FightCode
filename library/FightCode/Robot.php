<?php

namespace FightCode;

class Robot
{
    private $name;

    private $x;

    private $velocity = 1;

    private $brain;

    private $moves = array();

    public function __construct($name, Brain $brain)
    {
        $this->name = $name;
        $this->brain = $brain;

        $this->x = 0;
    }

    public function update()
    {
        $this->move();

        if (empty($this->moves)) {
            $this->brain->onIdle($this);
        }
    }

    private function move() {
        if (empty($this->moves)) {
            return;
        }

        $move = array_shift($this->moves);

        if ($move['distance'] > 0) {
            $this->x += ($move['direction'] * $this->velocity);
            $move['distance'] -= $this->velocity;
        }

        if ($move['distance'] > 0) {
            array_unshift($this->moves, $move);
        }
    }

    public function moveRight($distance)
    {
        $this->moves[] = array(
            'distance' => $distance,
            'direction' => 1
        );
    }

    public function moveLeft($distance)
    {
        $this->moves[] = array(
            'distance' => $distance,
            'direction' => -1
        );
    }

    public function getName()
    {
        return $this->name;
    }

    public function getX()
    {
        return $this->x;
    }
}
