<?php

namespace FightCode;

use \Ratchet\MessageComponentInterface;
use \Ratchet\ConnectionInterface;

class Server implements MessageComponentInterface {
    protected $games;

    public function __construct() {
        $this->games = array();
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $game = new Game(new Robot('Marvin', new IoBrain($conn)));
        $this->games[$conn->resourceId] = $game;

        echo "New connection! ({$conn->resourceId})\n";
        $game->run();
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        echo "Received message: " . $msg . "\n";
        $game = $this->games[$from->resourceId];
        $game->onMessage($msg);
        $from->send('OK');
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->games->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}
