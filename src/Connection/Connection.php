<?php

namespace Vrnvgasu\PhpRabbitHandler\Connection;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class Connection implements ConnectionInterface
{
    /**
     * @var
     */
    protected $connection;
    /**
     * @var
     */
    protected $channel;

    /**
     * Connection constructor.
     */
    public function __construct(protected string $host, protected string $port, protected string $user, protected string $password)
    {
        $this->openConnection();
    }

    /**
     *
     */
    protected function openConnection(): void
    {
        $this->connection = new AMQPStreamConnection(
            $this->host,
            $this->port,
            $this->user,
            $this->password
        );

        $this->channel = $this->connection->channel();
    }

    public function getConnection(): AMQPStreamConnection
    {
        return $this->connection;
    }

    public function getChannel(): AMQPChannel
    {
        return $this->channel;
    }

    /**
     *
     */
    public function closeConnection(): void
    {
        $this->channel->close();
        $this->connection->close();
    }

    /**
     *
     */
    public function __destruct()
    {
        $this->closeConnection();
    }
}
