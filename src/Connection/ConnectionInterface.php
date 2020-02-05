<?php

namespace Vrnvgasu\PhpRabbitHandler\Connection;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

interface ConnectionInterface
{
    /**
     * @return AMQPStreamConnection
     */
    public function getConnection(): AMQPStreamConnection;

    /**
     * @return AMQPChannel
     */
    public function getChannel(): AMQPChannel;

    /**
     *
     */
    public function closeConnection(): void;
}
