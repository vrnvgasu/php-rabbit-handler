<?php

namespace Vrnvgasu\PhpRabbitHandler\AMQPHelper;

use Vrnvgasu\PhpRabbitHandler\Connection\ConnectionInterface;
use Vrnvgasu\PhpRabbitHandler\Consumer\Binding\BindingInterface;
use Vrnvgasu\PhpRabbitHandler\Exchange\ExchangeInterface;
use Vrnvgasu\PhpRabbitHandler\Queue\QueueInterface;

class AMQPHelper
{
    /**
     * @var array
     */
    protected $bindings;

    /**
     * AMQPHelper constructor.
     * @param $bindings
     */
    public function __construct(
        protected ConnectionInterface $connection,
        protected QueueInterface $queue,
        protected ExchangeInterface $exchange,
        $bindings
    ) {
        $this->bindings = is_array($bindings) ? $bindings : [$bindings];

        if ($this->exchange->getName()) {
            $this->connection->getChannel()->exchange_declare(
                $this->exchange->getName(),
                $this->exchange->getType(),
                $this->exchange->getPassive(),
                $this->exchange->getDurable(),
                $this->exchange->getAutoDelete(),
                $this->exchange->getInternal(),
                $this->exchange->getNowait(),
                $this->exchange->getArguments(),
                $this->exchange->getTicket()
            );
        }

        [$queue_name, , ] = $this->connection->getChannel()->queue_declare(
            $this->queue->getName(),
            $this->queue->getPassive(),
            $this->queue->getDurable(),
            $this->queue->getExclusive(),
            $this->queue->getAutoDelete(),
            $this->queue->getNowait(),
            $this->queue->getArguments(),
            $this->queue->getTicket()
        );

        $this->queue->setName($queue_name);

        if ($this->exchange->getName()) {
            foreach ($this->bindings as $binding) {
                $this->bind($binding);
            }
        }

        $this->registerShutdown();
    }

    protected function bind(BindingInterface $binding): void
    {
        $this->connection->getChannel()->queue_bind(
            $this->queue->getName() ?? $this->randomQueue,
            $this->exchange->getName(),
            $binding->getRoutingKey(),
            $binding->getNowait(),
            $binding->getArguments(),
            $binding->getTicket()
        );
    }

    /**
     *
     */
    public function registerShutdown(): void
    {
        $channel = $this->connection->getChannel();
        $connection = $this->connection->getConnection();
        register_shutdown_function(function ($channel, $connection) {
            $channel->close();
            $connection->close();
        }, $channel, $connection);
    }

    public function getConnection(): ConnectionInterface
    {
        return $this->connection;
    }

    public function getQueue(): QueueInterface
    {
        return $this->queue;
    }

    public function getExchange(): ExchangeInterface
    {
        return $this->exchange;
    }
}
