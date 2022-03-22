<?php

namespace Vrnvgasu\PhpRabbitHandler\Connection;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

interface ConnectionInterface
{
    public function getConnection(): AMQPStreamConnection;

    public function getChannel(): AMQPChannel;

    /**
     *
     */
    public function closeConnection(): void;
}
