<?php

namespace FightCode;

class Game
{
    const MS_PER_UPDATE = 16; # 1000.0 / 60

    private $robot;

    public function __construct(Robot $robot)
    {
        $this->robot = $robot;
    }

    public function run()
    {
        $previous = microtime(true) * 1000.0;
        $lag = 0.0;

        while (true) {
            $current = microtime(true) * 1000.0;
            $elapsed = $current - $previous;
            $previous = $current;
            $lag += $elapsed;

            $this->processInput();

            while ($lag >= self::MS_PER_UPDATE) {
                $this->update();
                $lag -= self::MS_PER_UPDATE;
            }

            $this->render();
        }
    }

    private function processInput()
    {
        # $this->log('Process input');
    }

    private function update()
    {
        $this->robot->update();
    }

    private function render()
    {
        # $this->log($this->robot->getName() . ' updated to ' . $this->robot->getX());
    }

    private function log($message)
    {
        echo date('H:i:s'), ' ', $message, "\n";
    }

    public function onMessage($message)
    {
    }
}

